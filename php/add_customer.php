<?php
require 'conn.php';
session_start();

if(isset($_POST))
{
	$customer_details = $_POST;
	$insertFlds = "";
	$insertVals = "";
	$ctr = 0;

	$customer_details['last_modified_by'] = $_SESSION['user_id'];
	$customer_details['customer_type'] = "individual";
	foreach($customer_details as $fld => $val)
	{
			
			$insertFlds .= $ctr == (count($customer_details)-1) ? "{$fld}" : "{$fld}, ";
			$insertVals .= $ctr == (count($customer_details)-1) ? "'{$val}'" : "'{$val}', ";
			$ctr++;
	}

	$last_customer_id = 0;
	$query = "INSERT INTO customer ({$insertFlds}) VALUES ({$insertVals})";

	$response = array("customer_id" => 0,  "message" => "Unable to add customer. Please try again.");
	
	if(mysqli_query($conn, $query))
	{
		$response = array("customer_id" => mysqli_insert_id($conn), "message" => "Customer added successfully!");
	}
}
echo json_encode($response);
?>