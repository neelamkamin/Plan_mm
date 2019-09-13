<?php include_once 'sum.php'; ?>
<?php include_once 'admin_header.php'; ?>

<!------END !------->
<br><br><br>

<div class="container">
	<table class="table table-hover">
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
		<a href="<?php echo site_url('User') ?>" class="btn btn-lg btn-primary">SHOW ALL SCHEME</a>
		</td>
		
	  </div>
   </div>
</div>
    
<?php echo dash(); ?>

</div>
</body>
</html>