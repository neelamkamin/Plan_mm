<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charrshet="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
  
</head>
<body>
  <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a></button>
  <button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Dept") ?>">Back</a></button>

<?php 
echo form_open("Dept/update_scheme/{$scheme->id}",['class'=>'form-horizontal']);
//THIS EXTENSION i.e "{artic->id}" is to provide article-id OF ARTICLE TO BE UPDATE
//PLZ SEE SYNTEX= "public function update_article($artic_id)" OF ADMIN.PHP FILE ON LINE 60
//IN WHICH '{artic->id}' IS PASS AS PERAMETER///  
?>
  


  <fieldset>
    <legend align="center">EDIT SCHEME</legend>

    
    </div>
 
    <div class="row">
      <div class="col-lg-6">
    		<div class="form-group">
      <label for="inputEmail" class="col-lg-6 control-label">SCHEME NAME</label>
      <div class="col-lg-6">

 <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
 echo form_input(['name'=>'name_scheme','class'=>"form-control",'placeholder'=>'Enter Scheme Name','value'=>set_value('name_scheme',$scheme->name_scheme)]); 
  ?> 
      </div>
  	</div>
    </div>

     <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
      <label for="inputEmail" class="col-lg-6 control-label">FINANCIAL YEAR</label>
      <div class="col-lg-6">
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'FY','class'=>"form-control",'placeholder'=>'Enter Financial Year','value'=>set_value('FY',$scheme->FY)]); 
    ?> 
    </div></div></div></div></div>

     <div class="container">
      <div class="col-lg-12">
        <div class="form-group">
      <div class="col-lg-6">

 
      <p style="color:red;"><b>Please Select Category of Fund:</b></p>
          <input type="radio" name="fund_cat" value="state" checked > STATE <br>
          <input type="radio" name="fund_cat" value="css"> CSS<br>
         

<p style="color:red;"><b>Please Select Category of Scheme:</b></p>
  <input type="radio" name="category" value="on_going_scheme" checked> On Going Scheme<br>
  <input type="radio" name="category" value="new_scheme"> New Scheme<br>
  <input type="radio" name="category" value="maintainance_of_asset"> Maintainance of Assets<br> 
  <input type="radio" name="category" value="committed_liabilities"> Committed Liabilities<br>  
      </div> 
    </div>
  </div>
</div>
  <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
      <label for="inputEmail" class="col-lg-6 control-label">BUDGET ESTIMATE (In Lakhs only)</label>
      <div class="col-lg-6">
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'budget_est','class'=>"form-control",'placeholder'=>'Total Budget Estimate (in Rs.)','value'=>set_value('budget_est',$scheme->budget_est)]); 
    ?> 
    </div></div></div></div></div>
  

  <?php 
      echo form_reset(['name'=>'reset','value'=>'Reset','class'=>'btn btn-default']),  //HERE WE R USING INBUILT FUNCTION OF CODEIGNITER, INSTEAD OF HTML CODE*//
		form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-primary']);

   ?>

  </fieldset>
</form>
