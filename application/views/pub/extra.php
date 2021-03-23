<?php include 'header.php'; ?>

<div class="container-fluid">
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
		<td style="text-align: center;"><b>Scheme Head</b></td>
		<td style="text-align: center;"><b>Category of Fund</b></td>
		<td style="text-align: center;"><b>Financial Year</b></td>
		<td style="text-align: center;"><b>Dept Name</b></td>
	</tr>
<?php
	if(isset($_POST['submit']))
	{
	include('dbcon.php');
	$mm = $_POST['dept']; //THIS 'dept' IS RECEIVED FROM '<select name="dept">' FROM LINE NO.-23 ABOVE//
	
	$sql="SELECT * FROM `schemes` WHERE user_id='$mm' AND status=1 ORDER BY id DESC";
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
					<td> <b> <?=  
					//anchor ("user/article/{$data['id']}",$data['name_scheme']); 
							     $data['name_scheme'];
					         ?> </b></td>	
					<td><b>Rs. <?php echo $data['budget_est']; ?> (In Lakhs)</b></td>
					<td><?php echo $data['category']; ?></td>
					<td><?php echo $data['fund_cat']; ?></td>
					<td><?php echo $data['FY']; ?></td>	
					<td><?php echo $data['user_id']; ?></td>				
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
