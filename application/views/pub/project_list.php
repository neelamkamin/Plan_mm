<?php 
	include_once('header.php'); 

          function dash() {
			$servername = "localhost:3307";
			$username = "root";
			$password = "";
			$dbname = "plan_db";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			//$dept_id = $this->session->userdata('dept_id');
			$sql = "SELECT SUM(budget_est) AS value_sum FROM schemes WHERE status=1";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo "<b>GRAND TOTAL OF ALL BUDGET ESTIMATE IS :- Rs. " . $row["value_sum"]. "  Lakhs (Including State & Central Fund)</b>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();

		}
		echo dash();
       ?>

</table>

<div class="container-fluid">
	<h3 style="color:red;"> <b>ALL PROJECTS OF A.P</h3>
	<hr>
	<table class="table" class="table table-hover">
		<thead align="center">
			<tr style="color:green;">
				<td><b>Sl. No.</td>
				<td><b>NAME OF SCHEMES</td>	
				<td><b>BUDGET_ESTIMATE (in Lakhs)</b></td>
				<td><b>CATEGORY_OF_SCHEME</b></td>
				<td><b>CATEGORY_OF_FUND</b></td>
				<td><b>IMPLEMENTING DEPT</b></td>
				<td><b>FINANCIAL YEAR</b></td>
			</tr>
			</thead>
		<tbody>
			<tr>
			<? if ( count($schemes)): ?>
		<?php	$count = $this->uri->segment(3,0); ?>
		<?php foreach( $schemes as $mm): ?>
				<td>(<?= ++$count ?>)</td>
				<td><?= anchor ("Admin/scheme/{$mm->id}",$mm->name_scheme) ?></td>
				
				<td> Rs. <?= $mm->budget_est; ?> Lakhs</td>
				<td> <?= $mm->category; ?> </td>
				<td> <?= $mm->fund_cat; ?> </td>	
				<td> <?= $mm->dept_id; ?> </td>
				<td> <?= $mm->FY; ?> </td>
				
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

<?php include_once('footer.php'); ?>

