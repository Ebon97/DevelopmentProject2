<?php

	$connection = mysqli_connect ("localhost","root","");
	$db = mysqli_select_db($connection,'salon');

	if(isset($_POST['insertdata']))
	{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$telephone = $_POST['telephone'];
		$gender = $_POST['gender'];
		$age = $_POST['age'];
		$joined = $_POST['joined'];
		$record = $_POST['record'];

		$query = "INSERT INTO customer (fname, lname, email, telephone, gender, age, joined, record) VALUES ('$fname','$lname','$email','$telephone','$gender','$age','$joined','$record')";

		$query_run = mysqli_query($connection,$query);

		if($query_run)
		{
			echo '<script> alert("Data Saved") </script>';
			header('location: testingCustomer.php');
		}
		else
		{
			echo'<script>alert("Data Not Saved");</script>';
		}

	}

?>