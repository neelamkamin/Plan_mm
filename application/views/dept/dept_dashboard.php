<?php include_once 'dept_header.php'; ?>
<div class="container">
<?php
	echo "THIS IS ONLY FOR DEPARTMENT USERs<br>";
	echo "Welcome :- " . $_SESSION['user_id'];
 ?>
</div>
<div class="container-fluid">
	<table>
	<div class="row">
		<div class="col-lg-6">
		<td>
		<a href="<?php echo site_url("Dept/store_scheme") ?>" class="btn btn-lg btn-primary">SUBMIT SCHEME</a>
		</td>
		</div>
	</div>
	</div>

<?php if($feedback = $this->session->flashdata('feedback')): 
		$feedback_class = $this->session->flashdata('feedback_class'); //**WORKS ONLY IF BOOTSTRAP.MIN.CSS WORK CORRECTLY
?>
    <div class="row">
    	<div class="col-lg-6 col-lg-offset-3">
    
        <div class="alert alert-dismissible alert-danger">
          <?= $feedback ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

        <?php 
			if(count($schemes)): 
	           $count = $this->uri->segment(3,0);
		  ?>

	<table border="1" class="table table-hover">
		<thead style="color:green;">
			<th>Sl.no</th>
			<th>NAME  OF  THE  SCHEMES</th>
			<th>BUDGET ESTIMATE (in Lakhs)</th>		
			<th>SCHEME CATEGORY</th>
			<th>FUND CATEGORY</th>
			<th>FINANCIAL YEAR</th>
			<th>PREVIOUS BUDGET ESTIMATE</th>
			<th>PREVIOUS REVISED ESTIMATE</th>
			<th>EDIT/DELETE</th>
		</thead>
		<tbody>

		<?php foreach($schemes as $project): ?>
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
			<td> <?= $project->FY ; ?></td>
			<td> Rs. <?= $project->pre_budget_est ; ?> Lakhs </td>
			<td> Rs. <?= $project->pre_revised_est ; ?> Lakhs </td>
			<td>
			<?=      //GET METHOD FOR EDITING//
 				anchor("Dept/edit_scheme/{$project->id}",'Edit',['class'=>'btn btn-primary']); 
 //{$article->id} FROM THIS '$article' IS TAKEN FROM ABOVE SYNTEX AT NO.41, i.e=<?php foreach($articles as $article): 
 			?> 
 	
 				<?=  //PHP STARTS HERE
 					//POST METHOD FOR DELETE//
 					form_open('Dept/delete_scheme'),
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
            
				</tr>
				
				<?php endif;   ?>
		</tbody>
	</table>
	<br><br><br>
<h2 style="color:red;" align="center"> Please Do Not Use Mozilla Firefox <br><br> Use Chrome/Opera/UC Browser only </h2>
	<?= $this->pagination->create_links(); ?>
</div></td></tr></tbody></table></div></div></div></nav></body></html>


