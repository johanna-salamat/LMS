<?php
require "conn.php";

if(isset($_POST))
{
	//check if username is already in use
	$sql = "SELECT * FROM users WHERE user_name='".$_POST['user_name']."'";

	if($result = mysqli_query($conn, $sql))
	{
		if(mysqli_num_rows($result) > 0)
		{
			echo json_encode(array('exists' => 'Y'));
			exit();
		}
		else
		{
			$user_name = $_POST['user_name'];
			$password = $_POST['password'];
			$user_type = $_POST['user_type'];
			$sql = "INSERT INTO users (user_name, user_pin, user_type) VALUES ('{$user_name}', PASSWORD('{$password}'), '{$user_type}')";
			
			if($result = mysqli_query($conn, $sql))
			{
				$success = "Y";
			}
			else
			{
				$success = "N";
			}
		}
	}
}

echo json_encode(array("success" => $success));

?>