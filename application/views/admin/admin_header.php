<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charrshet="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Project Report Management System</title>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
</head>
<body>
  <br>
<button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Admin") ?>">Home</a></button>

  <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a></button>
  	
<?= form_open('user/search',['class'=>'navbar-form navbar-left','role'=>'search']); ?>
    <input type="text" name="query" class="form-control mr-sm-4" size="30" type="text" placeholder="Enter Department Name">
</div>
     <button class="btn btn-default" type="submit">Search</button>
    <?= form_close(); ?>
    <?= form_error('query',"<p class='navbar-text'>",'</p>') ?>
</nav>

