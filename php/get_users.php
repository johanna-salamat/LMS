<?php
require "conn.php";

$sql = "SELECT * FROM users";

if($result = mysqli_query($conn, $sql))
{
	$i = 0;
	while($users = mysqli_fetch_assoc($result))
	{
		$response[$i] = array('user_id' => $users['user_id'], 'user_name' => $users['user_name'], 'user_type' => $users['user_type'], 'last_login' => $users['last_login']);
		$i++;
	}
}

echo json_encode(array('users' => $response));

?>