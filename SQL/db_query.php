<?php
$servername = "localhost";
$username = "username";
$password = "";
$dbname = "excel_import";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* SQL TO CREATE TABLE schemes, COPY BELOW QUERY AND RUN IN MARIA_DB  */
$sql = "CREATE TABLE schemes (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id VARCHAR(30) NOT NULL,
name_scheme VARCHAR(150) NOT NULL,
category VARCHAR(50) NOT NULL,
fund_cat VARCHAR(50) NOT NULL,
budget_est DOUBLE NOT NULL,
pre_budget_est DOUBLE NOT NULL,
pre_revised_est DOUBLE NOT NULL,
FY VARCHAR(50) NOT NULL

)";

/*COPY BELOW QUERY AND RUN THIS IN MARIA_DB


FOR CREATING TABLE users

 "CREATE TABLE users (
slno INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id VARCHAR(30) NOT NULL,
u_name VARCHAR(50) NOT NULL,
pass VARCHAR(20) NOT NULL,
Mobile_no VARCHAR(12) NOT NULL,
HOD VARCHAR(30) NOT NULL

)";



*/



if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>