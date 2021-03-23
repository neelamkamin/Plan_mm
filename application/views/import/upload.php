<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charrshet="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
    <script src='<?= base_url() ?>assests/tinymce/tinymce.min.js'></script>
</head>
<body>
  <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a></button>
  <button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Auth") ?>">Back</a></button>
  <br><br><br>

<?php echo form_open_multipart('Import/uploadData',['class'=>'form-horizontal']) ?>
  
<?php echo form_hidden('user_id', $this->session->userdata('user_id')); ?>


<?= //HERE WE USE THIS METHOD SO THAT "DATE" OF PROJECT REPORT WIL NOT CHANGE EVEN AFTER UPDATE
//FOR THIS WE HAV CREATED 1 MORE ROW AT TABLE "articles" NAMED "reported_at" WITH 'VALCHAR' AND GET DATE & TIME FROM THIS 'form_hidden' METHOD.
    form_hidden('reported_at', date('d-m-Y H:i:s'));
  //THIS 'form_hidden' METHOD IS NOT NECESSARY IS WE CREATE EXTRA ROW WITH "Timestamp" VALUE, BUT DATE WIL CHANGE IN ANY NEW UPDATE OF EARLIER REPORT//
?> 
<div class="container">
     Import/Upload excel file/data : 
    <input type="file" name="uploadFile" value="" /><br><br>
    <input type="submit" name="submit" value="Upload" />
</div>
</form>
