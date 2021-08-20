<?php
require 'conn.php';


$query = "SELECT * FROM users WHERE user_name='{$_POST['username']}' AND user_pin=PASSWORD('{$_POST['password']}')";
$res = mysqli_query($conn, $query);

if(mysqli_num_rows($res) > 0)
{
	session_start();
	while($row = mysqli_fetch_assoc($res))
	{
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['username'] = $row['user_name'];
		$_SESSION['user_type'] = $row['user_type'];
	}

	$getGST = "SELECT * FROM config WHERE config_key='gst_percent'";
	
	$res = mysqli_query($conn, $getGST);
	if(mysqli_num_rows($res) > 0)
	{
		while($gst = mysqli_fetch_assoc($res))
		{
			$_SESSION['gst_percent'] = $gst['config_value'];
		}
	}
	
	echo json_encode(array('status' => 'success', 'url' => $_SERVER["HTTP_REFERER"].'php/main.php'));

}
else
{
	echo json_encode(array('status' => 'error', 'message' => 'Username and password mismatch! Please try again.'));
}
exit();


?>