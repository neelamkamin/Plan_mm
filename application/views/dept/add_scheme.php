<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charrshet="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
    <script src='<?= base_url() ?>assests/js/jquery.min.js'></script>
        <script>
                function form_validation()
                {
                    var name_scheme = $ ('#name_scheme').val();
                    var budget_est = $ ('#budget_est').val();
                   
                    if(name_scheme=='')
                    {
                      alert("Please Enter Scheme Name");
                      return false;
                    }
                    if(budget_est=='')
                    {
                      alert("Please Enter Total Budget Estimate");
                      return false;
                    }
              
                }
      </script>
</head>
<body>
  <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a></button>
  <button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Dept") ?>">Back</a></button>

<form class="form-horizontal" method="post" action="store_scheme" onsubmit="return form_validation();">

  
<?php echo form_hidden('user_id', $this->session->userdata('user_id')); ?>



  <fieldset>
    <h2 align="center" style="color:blue;"> PROJECT PROPOSAL SUBMISSION FORM  </h2> <br>
    <h2 align="center" style="color:red;">Submit only one scheme at a time </h2>
    <hr>
<div class="container">
  <div class="col-lg-12">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label"><font color="red">**</font>FINANCIAL YEAR<font color="red">**</font></label>
       <div class="col-lg-6">
  
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'FY','class'=>"form-control",'placeholder'=>'*Enter Financial Year','value'=>set_value('FY')]); 
    ?> 
   </div></div></div></div>



    <div class="container">
      <div class="col-lg-12">
        <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label"><font color="red">**</font>SCHEME NAME<font color="red">**</font></label>
      <div class="col-lg-6">

 <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
      echo form_input(['name'=>'name_scheme', 'id'=>'name_scheme','class'=>"form-control",'placeholder'=>'Enter Scheme Name','value'=>set_value('name_scheme')]); 
  ?> 

      <p style="color:red;"><b>Please Select Category of Fund:</b></p>
          <input type="radio" name="fund_cat" value="state" checked > STATE <br>
          <input type="radio" name="fund_cat" value="css"> CSS<br>
         

<p style="color:red;"><b>Please Select Category of Scheme:</b></p>
  <input type="radio" name="category" value="on_going_scheme"> On Going Scheme<br>
  <input type="radio" name="category" value="new_scheme" checked > New Scheme<br>
  <input type="radio" name="category" value="Budget_Announcement"> Budget Announcement<br> 
  <input type="radio" name="category" value="maintainance_of_asset"> Maintainance of Assets<br> 
  <input type="radio" name="category" value="committed_liabilities"> Committed Liabilities<br>  
      </div> 
    </div>
  </div>
</div>

<div class="container">
  <div class="col-lg-12">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label">PREVIOUS YEAR BUDGET ESTIMATE (in Lakhs)</label>
       <div class="col-lg-6">
  
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'pre_budget_est','class'=>"form-control",'placeholder'=>'*Enter Previous Year Budget Estimate in Lakhs only, if any','value'=>set_value('pre_budget_est')]); 
    ?> 
   </div></div></div></div>

   <div class="container">
  <div class="col-lg-12">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label">PREVIOUS YEAR REVISED ESTIMATE (in Lakhs)</label>
       <div class="col-lg-6">
  
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'pre_revised_est','class'=>"form-control",'placeholder'=>'*Enter Previous Year Revised Estimate in Lakhs only, if any','value'=>set_value('pre_revised_est')]); 
    ?> 
   </div></div></div></div>


<div class="container">
  <div class="col-lg-12">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label"><font color="red">***</font>BUDGET ESTIMATE (in Lakhs)<font color="red">***</font></label>
       <div class="col-lg-6">
  
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'budget_est', 'id'=>'budget_est','class'=>"form-control",'placeholder'=>'*Enter Budget Estimate in Lakhs only','value'=>set_value('budget_est')]); 
    ?> 
   </div></div></div></div>

<div>
  <?php 
      echo form_reset(['name'=>'reset','value'=>'Reset','class'=>'btn btn-default']),  //HERE WE R USING INBUILT FUNCTION OF CODEIGNITER, INSTEAD OF HTML CODE*//
    form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-primary']);

   ?>
</div>
  </fieldset>
</form>


<div class="container">
<font color="red">Please Note All Fields are Mandatory
</font>
</div>

