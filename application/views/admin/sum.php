<?php

	function dash() 
	    {
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "plan_db";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "SELECT SUM(budget_est) AS value_sum FROM schemes";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			         echo " <br><b>GRAND TOTAL OF ALL BUDGET ESTIMATE IS :- Rs. " . $row["value_sum"]. "  Lakhs (Including State & Central Fund)</b>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();

       }
   

 ?>