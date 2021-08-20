<?php
require "conn.php";

if(isset($_POST))
{
	$user_id = $_POST['this_user_id'];
	$new_password = $_POST['new_password'];
	$sql = "UPDATE users SET user_pin = PASSWORD('$new_password') WHERE user_id={$user_id}";
	$result = mysqli_query($conn, $sql);

	$success = $result ? "Y" : "N";
}

echo json_encode(array("success" => $success));

?>