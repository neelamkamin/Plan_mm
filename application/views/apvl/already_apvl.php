<?php include_once 'header.php'; ?>
<div class="container">
<?php
	//$this->load->model('Approval_model');
	$rr = $this->Approval_model->get_role();
	$name = $rr->name;
	//print_r($name); exit;
	echo "THIS IS ONLY FOR DEPARTMENT USERs<br>";
	echo "Welcome :- <b>".$name. " , " . $_SESSION['dept_id'] . "</b>";
 ?>
</div>
<div class="container-fluid">
  <table>
	<div class="row">
	  <div class="col-lg-6">
		<td>
			<a href="<?php echo site_url("DeptAdmin") ?>" class="btn btn-lg btn-primary">NON-APPROVED SCHEME</a>
		</td>
	   </div>
	</div>
</div>

<?php if($feedback = $this->session->flashdata('feedback')): 
		$feedback_class = $this->session->flashdata('feedback_class'); //**WORKS ONLY IF BOOTSTRAP.MIN.CSS WORK CORRECTLY
?>
    <div class="row">
    	<div class="col-lg-6 col-lg-offset-3">
    
        <div class="alert alert-success">
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
			<th>STATUS</th>
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

				<td><b> Rs. <?= $project->budget_est ; ?> (In Lakhs) </b></td>
				<td> <?= $project->category ; ?></td>
				<td> <?= $project->fund_cat ; ?></td>
				<td> <?= $project->FY ; ?></td>
				<td> Rs. <?= $project->pre_budget_est ; ?> (In Lakhs) </td>
				<td> Rs. <?= $project->pre_revised_est ; ?> (In Lakhs) </td>
				<td> <h2 style="color:red;">Already Approve </h2></td>

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


