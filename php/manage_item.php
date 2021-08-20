<?php
require "conn.php";

if(isset($_POST))
{
	if($_POST['action'] == "delete")
	{
		$sql = "DELETE from item_type WHERE item_type_id=".$_POST['item_type_id'];
	}
	else if($_POST['action'] == "insert")
	{
		$sql = "INSERT INTO item_type (item_type_name, item_type_desc, item_type_price, category_id, item_type_image) VALUES ('".$_POST['item_type_name']."', '".$_POST['item_type_desc']."', ".$_POST['item_type_price'].", ".$_POST['category_id'].", '\\\img\\\DryCleaning\\\\20.png')";
	}
	else if($_POST['action'] == "update")
	{
		$sql = "UPDATE item_type SET item_type_price='".$_POST['item_type_price']."' WHERE item_type_id=".$_POST['item_type_id'];
	}

	if(mysqli_query($conn, $sql))
		$success = "Y";
	else
		$success = "N";
}

echo json_encode(array("success" => $success));

?>