<?php
require "conn.php";

$message = "";

if(isset($_POST))
{
	$txn_invoice_no = $_POST['txn_invoice_no'];

	if(isset($_POST['txn_status']))
	{
		$txn_status = $_POST['txn_status'];
		
		$sql = "UPDATE transaction_invoice SET txn_status = '{$txn_status}' WHERE txn_invoice_no = '{$txn_invoice_no}'";

		$message = mysqli_query($conn, $sql) ? "Transaction updated successfully!" : "Unable to update transaction. Please try again.";
	}
	
	if(isset($_POST['txn_payment_status']))
	{
		$txn_payment_status = $_POST['txn_payment_status'];
		$sql = "UPDATE transaction_invoice SET txn_payment_status = '{$txn_payment_status}' WHERE txn_invoice_no = '{$txn_invoice_no}'";

		if(mysqli_query($conn, $sql))
		{
			$message = mysqli_query($conn, $sql) ? "Transaction updated successfully!" : "Unable to update transaction. Please try again.";
		}
	}

	if(isset($_POST['void']))
	{
		$void = $_POST['void'];
		$sql = "UPDATE transaction_invoice SET txn_invoice_isvoid = '{$void}' WHERE txn_invoice_no = '{$txn_invoice_no}'";

		if(mysqli_query($conn, $sql))
		{
			$message = mysqli_query($conn, $sql) ? "Transaction updated successfully!" : "Unable to update transaction. Please try again.";
		}	
	}
}

echo json_encode(array("message" => $message));

?>