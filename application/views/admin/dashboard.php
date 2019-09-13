
<?php include 'sum.php'; ?>
<?php include_once 'admin_header.php'; ?>

<div class="container">
	<table>
	<div class="row">
		<div class="col-lg-6">
			 <td>
            <a href="<?php echo site_url("Admin/show_category") ?>" class="btn btn-lg btn-primary">Category of Fund</a>
        </td>
	<td>
			<a href="<?php echo site_url("Admin") ?>" class="btn btn-lg btn-primary">DEPT-WISE LIST</a>
		</td>
		<td>
            <a href="<?php echo site_url("User/extra") ?>" class="btn btn-lg btn-primary">Dept. Wise Project</a>
        </td>
		<td>
		<a href="<?php echo site_url('user') ?>" class="btn btn-lg btn-primary">SHOW ALL PROJECTS</a>
		</td>
		<td>
			<a href="<?php echo site_url("Login/updatePwd") ?>" class="btn btn-lg btn-primary">A/C Setting</a>
		</td>
		</div>
	</div>
	</div>

	<?php echo dash(); ?>
	
</table>

<?php if($feedback = $this->session->flashdata('feedback')): 
		$feedback_class = $this->session->flashdata('feedback_class'); 
?>
    <div class="row">
    	<div class="col-lg-6 col-lg-offset-3">
    
        <div class="alert alert-dismissible alert-danger">
          <?= $feedback ?> <!-- FOR DISPLAY OF FEEDBACK MSG AFTER SUBMITTING SCHEME !-->
        </div>
      </div>
    </div>
  <?php endif; ?>

        <?php 
			if(count($articles)): 
	           $count = $this->uri->segment(3,0);
		  ?>
<!-- IF ADMIN USER HAVE SUBMITTED ANY SCHEME EARLIER !-->
	<table border="1" class="table table-hover">
		<thead style="color:green;">
			<th>Sl.no</th>
			<th>NAME  OF  THE  SCHEMES</th>
			<th>BUDGET ESTIMATE (in Lakhs)</th>		
			<th>SCHEME CATEGORY</th>
			<th>FUND CATEGORY</th>
			<th>EDIT/DELETE</th>
		</thead>
		<tbody>

		<?php foreach($articles as $project): ?>
			<tr align="center">
				<td >
					<?= ++$count ?>
				</td>
				<td>
					<?=
					 $project->name_scheme                         
					//anchor ("user/article/{$project->id}",$project->title) //$pro is taken from above syntex at line 46// 
					  ?>
 				</td>

			<td><b> Rs. <?= $project->budget_est ; ?> Lakhs </b></td>
			<td> <?= $project->category ; ?></td>
			<td> <?= $project->fund_cat ; ?></td>
			<td>
			<?=      //GET METHOD FOR EDITING//
 				anchor("Admin/edit_scheme/{$project->id}",'Edit',['class'=>'btn btn-primary']); 
 
 			?> 
 	
 				<?=  
 					//POST METHOD FOR DELETE//
 					form_open('Admin/delete_scheme'),
 					form_hidden('mm_id',$project->id),
 					//form_submit(['name'=>'submit','value'=>'Delete','class'=>'btn btn-danger']),
 					 form_submit('submit','Delete',array('onclick' => "return confirm('WARNING :- Do you really want to Delete : $project->name_scheme -Project.')",'class'=>'btn btn-danger float-center')),
 					form_close();
 				?>		
	
				</td>

			</tr>
			<?php endforeach;  ?>
				
				<?php else:  ?>
				<tr> 
		<div class="container">
    <table class="table">
        <thead>
            <tr>
        <!-- IF NO RECORDS FOUND IN DATABASE !-->
                 <?php echo dash(); ?>
        </tr>
				</tr>
				
				<?php endif;   ?>
		</tbody>
	</table>
	<br><br><br>
<h2 style="color:red;" align="center"> Please Do Not Use Mozilla Firefox <br><br> Use Chrome/Opera/UC Browser only </h2>
	<?= $this->pagination->create_links(); ?>
</div></td></tr></tbody></table></div></div></div></nav></body></html>


