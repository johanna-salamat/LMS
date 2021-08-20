<?php
require 'conn.php';

$response = array();

if(isset($_GET))
{

	$invoice_date_from = date('Y-m-d', strtotime(str_replace('/', '-', $_GET['invoice_date_from'])));

	$invoice_date_from = $invoice_date_from." 00:00:00";

	$invoice_date_to = date('Y-m-d', strtotime(str_replace('/', '-', $_GET['invoice_date_to'])));

	$invoice_date_to = $invoice_date_to." 23:59:59";

	$sql = "SELECT 
			IF(SUM(txn_net_amt), SUM(txn_net_amt), 0) AS total_net_amt, IF(SUM(txn_gst_amt), SUM(txn_gst_amt), 0) AS total_gst_amt, IF(SUM(txn_discount_amt),SUM(txn_discount_amt),0) AS total_discount_amt, IF(SUM(txn_gross_amt), SUM(txn_gross_amt), 0) AS total_gross_amt  
			FROM transaction_invoice 
			WHERE txn_invoice_date >= '{$invoice_date_from}' AND txn_invoice_date <= '{$invoice_date_to}' AND txn_status='collected'";

	$response['invoice_date_from'] = $invoice_date_from;
	$response['invoice_date_to'] = $invoice_date_to;

	if($result = mysqli_query($conn,$sql))
	{
		$response['success'] = "Y";

		while($totals = mysqli_fetch_assoc($result))
		{
			$response['total_net_amt'] = $totals['total_net_amt'];
			$response['total_gst_amt'] = $totals['total_gst_amt'];
			$response['total_discount_amt'] = $totals['total_discount_amt'];
			$response['total_gross_amt'] = $totals['total_gross_amt'];
		}
		
	}
	else
	{
		$response['success'] = "N";
		$response['message'] = "Unable to retrieve sales data.";
	}
}

echo json_encode($response);
?>