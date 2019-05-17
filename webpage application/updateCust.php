<?php
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,'salon');

	if(isset($_POST['updatedata']))
	{
		$id= $_POST['update_id'];

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$telephone = $_POST['telephone'];
		$gender = $_POST['gender'];
		$age = $_POST['age'];
		$joined = $_POST['joined'];
		$salary = $_POST['record'];


		$query = "UPDATE staff SET fname='$fname', lname='$lname', email='$email', telephone='$telephone', gender='$gender',age='$age', joined='$joined',record='$record'";
		$query_run = mysqli_query($connection,$query);

		if($query_run)
		{
			echo "<script>alert('Data updated!''); </script>";
			header('location: testingCustomer.php');
		}
		else
		{
			echo "<script>alert('Data NOT updated!''); </script>";
		}

	}



	

?>