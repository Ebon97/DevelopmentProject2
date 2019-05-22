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
//$query = sprintf("SELECT s.staff_name as staff, sum(b.price) as sales from staff s inner join booking b on s.staff_id = b.booking_staff GROUP BY s.staff_id ORDER BY s.staff_id");
$query = sprintf("SELECT DAYNAME(booking_date) as day, sum(b.price) as sales from booking b GROUP BY DAYNAME(booking_date) ORDER BY WEEKDAY(booking_date)");

//$query = sprintf("SELECT playerid, score FROM score ORDER BY playerid");
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