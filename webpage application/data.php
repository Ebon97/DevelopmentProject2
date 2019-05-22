<?php
//setting header to json
header('Content-Type: application/json');
//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'salon');
//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}
//query to get data from the table
$query = sprintf("SELECT s.staff_name, sum(b.price) from staff s inner join booking b on s.staffid = b.booking_staff ");
//execute query
$result = $mysqli->query($query);
//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
//free memory associated with result
$result->close();
//close connection
$mysqli->close();
//now print the data
print json_encode($data);