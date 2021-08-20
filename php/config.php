<?php
require "conn.php";
session_start();


if(isset($_POST) && !empty($_POST))
{
	$configurations = array();
	//check if config exists in db
	foreach($_POST as $config => $value)
	{
		if($config != "config_type")
		{
			$configurations[$config] = $value;
		}
		else
		{
			$config_type = $value;
		}
	}

	$errors = 0;
	foreach($configurations as $config_key => $config_value)
	{
		$sql = "SELECT * FROM config WHERE config_key='{$config_key}'";

		if($result = mysqli_query($conn, $sql))
		{
			if(mysqli_num_rows($result) == 0)
				$sql = "INSERT INTO config (config_key, config_value, config_type) VALUES('{$config_key}', '{$config_value}', '{$config_type}')";
			else
				$sql = "UPDATE config SET config_value = '{$config_value}', last_modified_by = {$_SESSION['user_id']} WHERE config_key = '{$config_key}'";


			$result = mysqli_query($conn, $sql);

			if(!$result)
				$errors++;
		}	
	}

	$success = $errors > 0 ? "N" : "Y";

	echo json_encode(array("success" => $success));
	
}
else if(isset($_GET))
{
	$sql = "SELECT * FROM config";
	$configurations = array();

	if($result = mysqli_query($conn, $sql))
	{
		while($configs = mysqli_fetch_assoc($result))
		{
			$configurations[$configs['config_type']][$configs['config_key']] = $configs['config_value'];
		}
	}

	echo json_encode(array("config" => $configurations));
}

?>