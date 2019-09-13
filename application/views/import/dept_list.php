<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charrshet="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ALL SCHEMES OF STATE</title>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
</head>
<body>
  <br>
<button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Admin") ?>">Home</a></button>

  <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a></button>
  	
<?= form_open('user/search',['class'=>'navbar-form navbar-left','role'=>'search']); ?>
    <input type="text" name="query" class="form-control mr-sm-4" size="30" type="text" placeholder="Enter Project Name">
</div>
     <button class="btn btn-default" type="submit">Search</button>
    <?= form_close(); ?>
    <?= form_error('query',"<p class='navbar-text'>",'</p>') ?>
</nav>
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

<div class="container">
	<h3 style="color:red;"> <b>VIEW FILE (Views/import/dept_list.php)</h3>
	<hr>
	<table class="table" border="1">
		<thead align="center">
			<tr style="color:green;">
				<td><b>Sl. No.</td>
				<td><b>Name of the Scheme</td>
				<td><b>Implementing Department</b></td>
				<td><b>Category</b></td>
				<td><b>Funding_Type</b></td>
				<td><b>Budget Estimate (In Lakhs)</b></td>
			
			</tr>
			</thead>
		<tbody>
			<tr>
			<? if ( count($articles)): ?>
		<?php	$count = $this->uri->segment(3,0); ?>
		<?php foreach( $articles as $mm): ?>
				<td>(<?= ++$count ?>)</td>
				<td> <?= $mm->name_scheme; ?> </td>
				<td> <?= $mm->user_id; ?> </td>
				<td> <?= $mm->category; ?> </td>
				<td> <?= $mm->fund_cat; ?> </td>
				<td>Rs. <?= $mm->budget_est; ?> Lakhs</td>
	
			</tr>

		<?php endforeach; ?>
			<? else: ?>
		<tr>
		</tr>

		<? endif; ?>
			</tr>
		</tbody>
	</table>

		<?= $this->pagination->create_links() ?>

</div></td></td></tr></thead></table></div></div>


</body>
</html>
