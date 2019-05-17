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
		$dob = $_POST['dob'];
		$joined = $_POST['joined'];
		$salary = $_POST['salary'];
		$pos = $_POST['pos'];
		$comment = $_POST['comment'];

		$query = "INSERT INTO staff (fname, lname, email, telephone, gender, age, dob, joined, salary, pos, comment) VALUES ('$fname','$lname','$email','$telephone','$gender','$age','$dob','$joined','$salary','$pos','$comment')";

		$query_run = mysqli_query($connection,$query);

		if($query_run)
		{
			echo '<script> alert("Data Saved") </script>';
			header('location: testingStaff.php');
		}
		else
		{
			echo'<script>alert("Data Not Saved");</script>';
		}

	}

?>