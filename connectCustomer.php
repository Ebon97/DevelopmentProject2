<?php

$con = mysql_connect('localhost','root','');

if($con)
{
	echo 'Not connected to server';
}

if(!mysql_select_db($con,'sample'))
{
	echo 'database not selected';
}

$fname = $_POST ['fname'];
$lname = $_POST ['lname'];
$address = $_POST ['address'];
$gender = $_POST ['gender'];
$age = $_POST ['age'];
$dob = $_POST ['dob'];
$telephone = $_POST ['telephone'];
$comment = $_POST ['comment'];

$sql = "INSERT INTO staff (fname,lname,address,gender,age,dob,telephone,comment) VALUES ('$fname','$lname','$address','$gender','$age','$dob','&telephone','$comment')";

if(!mysql_query($con,$sql))
{
	echo'not inserted';
}
else
{
	echo 'inserted';
}

header("refresh:2; url = homepage.html");

?>