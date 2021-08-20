<?php
require "conn.php";

if(isset($_GET))
{
	$charge_types = array();
	$sql = "SELECT * FROM charge_type";

	if($result = mysqli_query($conn, $sql))
	{
		$i=0;
		while($charges = mysqli_fetch_assoc($result))
		{
			$charge_types[$i] = $charges;
			$i++;
		}
	}

	echo json_encode(array('charges' => $charge_types));
}
else if(isset($_POST) && !empty($_POST))
{
	$success = "N";
	$charge_type_desc = $_POST['charge_type_desc'];
	$charge_type_price = $_POST['charge_type_price'];

	if($_POST['action'] == "insert")
		$sql = "INSERT INTO charge_type (charge_type_desc, charge_type_price) VALUES ('{$charge_type_desc}', {$charge_type_price})";
	else if($_POST['action'] == "update")
		$sql = "UPDATE charge_type SET charge_type_price = {$charge_type_price} WHERE charge_type_id = {$charge_type_id}";

	if($result = mysqli_query($conn, $sql))
		$success = "Y";

	echo json_encode(array("success" => $success));
}

?>