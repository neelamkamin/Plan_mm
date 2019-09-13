<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charrshet="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Projects Lists</title>
	
		<link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/mm.css") ?>">
</head>
<body>
 <button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Admin/show_cost") ?>">Home</a></button>
<!--
<button class="btn btn-default" style="float:right">		
  			<?php  //HERE WE LINK FOR PDF CONVERTER //
  					//echo '<a href="'.base_url().'Admin/pdfdetails/'.$art_id->id.'">Print Report</a>' 
  			?> 
  	</button>  !-->
 <h2 style="color:green;" align="center">GOVERNMENT OF ARUNACHAL PRADESH <br> DEPARTMENT OF PLANNING & INVESTMENT<br>ITANAGAR-791111</h2>
 <hr>
<div class="container">
	<div class="row">
		<div class="col-lg-6">
			<h3 style="color:blue;"> <?= "<b>NAME OF SCHEME</b>:-   . $art_id->name_scheme ." ?> </h3>
		 </div>

	<div class="col-lg-6"> 
			<span class="pull-right">
			<h3 style="color:blue;">	
				<?=  //WE RECEIVED THIS "$art_id" OBJECT FROM "public function article( $id )" FUNCTION OF "User.php" FILE OF CONTROLLERS FOLDER//
				 "<b>DEPT. NAME</b> :-" . $art_id->user_id 
				 ?> 
			</h3>
			</span>
			<h3 style="color:blue;">	
				<?=  
				 "<b>SADA Financial Year</b> :-" . $art_id->FY 
				 ?> 
			</h3>

			<h3 style="color:blue;">	
		<?=  "<b>CATEGORY OF FUND</b> :-" . $art_id->fund_cat ?> 
			</h3>

		</div>

<div class="col-lg-6"> 
	<span class="pull-right">
		<h3 style="color:blue;"><?= "<b>PREVIOUS YEAR BUDGET ESTIMATE :- Rs.</b>" . $art_id->pre_budget_est ?> Lakhs </h3>

		<h3 style="color:blue;">	<?= "<b>PREVIOUS YEAR REVISED ESTIMATE :- Rs.</b>" . $art_id->pre_revised_est ?> Lakhs </h3>

		<h1 style="color:red;"><?= "<b>BUDGET ESTIMATE :- Rs.</b>" . $art_id->budget_est ?> Lakhs </h1>
	</span>
</div>



	
</div></div></div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?> > </script>
</body>
</html> 
