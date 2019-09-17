<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charrshet="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Projects Lists</title>
	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
</head>
<body>

  <div class="container">
  <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a></button>
   <button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Admin") ?>">Home</a></button>

   <br><br>
    <td>
       <a href="<?php echo site_url("Admin/show_category") ?>" class="btn btn-lg btn-primary">Category of Fund</a>
	        </td>
		<td>
			<a href="<?php echo site_url("Admin") ?>" class="btn btn-lg btn-primary">DEPT-WISE LIST</a>
		</td>
			<td>
		<a href="<?php echo site_url('Admin/dashboard') ?>" class="btn btn-lg btn-primary">DEPT DASHBOARD</a>
		</td>
		 <td>
            <a href="<?php echo site_url("Admin/extra") ?>" class="btn btn-lg btn-primary">Dept. Wise Project</a>
        </td>
        <td>
		<a href="<?php echo site_url('Admin') ?>" class="btn btn-lg btn-primary">SHOW ALL PROJECTS</a>
		</td>
		<td>
			<a href="<?php echo site_url("Login/updatePwd") ?>" class="btn btn-lg btn-primary">A/C Setting</a>
		</td>


<br><br>
<table align="center">
   <form action="" method="post">
<tr>
	<th style="color: red">DEPARTMENT NAME :-</th>
	  <td>
		<select name="dept">
			<option value="">Choose any Dept.</option>
			<option value="Dept._Of_IT">IT & C</option>
			<option value="PHED_Dept">PHED</option>
			<option value="PWD">PWD</option>
			<option value="Urban_Development_and_Housing">UD & H</option>
			<option value="Dept_of_Higher_and_Technical_Education">Education</option>
			<option value="RD">Rural Development</option>
			<option value="SRSAC">Remote Sensing</option>
		</select>
	</td>
	
<td colspan="2" align="right"><input type="submit" name="submit" value="Search"/></td>
 </tr>	
  </form>
   </table>
          <br>
<table align="center" width="100%" border="1" style="margin-top: 10px;">
	<tr style="background-color:#cafbed; color:blue;">
		<th style="text-align: center;">Sl No.</th>
		<th style="text-align: center;">Scheme Name</th>
		<th style="text-align: center;">Budget Estimate (In Lakhs)</th>
		<td style="text-align: center;"><b>Category of Scheme</b></td>
		<td style="text-align: center;"><b>Category of Fund</b></td>
	</tr>
<?php
	if(isset($_POST['submit']))
	{
	include('dbcon.php');
	$mm = $_POST['dept']; //THIS 'dept' IS RECEIVED FROM '<select name="dept">' FROM LINE NO.-23 ABOVE//
	
	$sql="SELECT * FROM `schemes` WHERE user_id='$mm' ORDER BY id DESC";
	$run = mysqli_query($con,$sql);

	if(mysqli_num_rows($run)<1)
	{
		echo "<tr><td colspan='5'>No Records Found</td></tr>";	
	}
	else
	{
		$count=0;
		while($data = mysqli_fetch_assoc($run))
		{
			$count++;
?>
			<tr align="center">
					<td><?php echo $count; ?></td>
					<td> <?=  
					//anchor ("Admin/scheme/{$data['id']}",$data['name_scheme']); 
								$data['name_scheme'];
					      ?> </td>	
					<td><b>Rs. <?php echo $data['budget_est']; ?> Lakhs</b></td>
					<td><?php echo $data['category']; ?></td>
					<td><?php echo $data['fund_cat']; ?></td>				
			</tr>
<?php
		}
	}	
}		
?>

</table>
</div>
</body>
</html>
