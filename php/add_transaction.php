<?php
require 'conn.php';
session_start();

//print_r($_POST);

if(isset($_POST))
{
	//Step 1: generate invoice id
	$lastInvoiceSql = "SELECT txn_invoice_no FROM transaction_invoice WHERE txn_invoice_no LIKE '".date('jmY')."%' ORDER BY txn_invoice_no";
	$lastInvoiceRes = mysqli_query($conn, $lastInvoiceSql);

	//echo $lastInvoiceSql."<br>";

	$invoiceCount = mysqli_num_rows($lastInvoiceRes) > 0 ? mysqli_num_rows($lastInvoiceRes)+1 : 1;

	$leadingZeros = "";
	if(strlen($invoiceCount) < 5)
	{
		for($i = 0; $i < (5-strlen($invoiceCount)); $i++)
		{
			$leadingZeros .= "0";
		}
	}
	
	$nextTxnInvoiceNo = date('dmY').$leadingZeros.$invoiceCount;

	$pickup_date = str_replace('/', '-', $_POST['pickup_datepicker']);
	$pickup_time = date('H:i:s', strtotime($_POST['pickup_timepicker']));

	$pickup_date_time = date('Y-m-d', strtotime(str_replace('/', '-', $pickup_date)))." ".$pickup_time;

	//Step 2: insert transaction invoice
	$transaction_details = array('txn_invoice_no' => $nextTxnInvoiceNo,
									'txn_invoice_date' => date("Y-m-d h:m:s"),
									'txn_customer_id' => $_POST['customer_id'],
									'txn_status' => 'Pending',
									'txn_total_qty' => count($_POST['items']),
									'txn_gross_amt' => $_POST['gross_amt'],
									'txn_discount_amt' => $_POST['discount_amt'],
									'txn_prepaid_amt' => 0,
									'txn_gst_amt' => $_POST['gst_amt'],
									'txn_net_amt' => $_POST['net_amt'],
									'txn_payment_status' => $_POST['payment_status'],
									'txn_pickup_date' => $pickup_date_time,
									'txn_notes' => $_POST['notes'],
									'txn_invoice_isvoid' =>  '0',
									'last_modified_by' => $_SESSION['user_id']
								);

	$invoiceSummaryFld = "";
	$invoiceSummaryVals = "";
	$summaryCtr = 0;
	foreach($transaction_details as $summaryFld => $summaryVal)
	{
		$invoiceSummaryFld .= ($summaryCtr == count($transaction_details)-1) ? "{$summaryFld}" : "{$summaryFld}, ";
		$invoiceSummaryVals .= ($summaryCtr ==  count($transaction_details)-1) ? "'{$summaryVal}'" : "'{$summaryVal}' ,";
		$summaryCtr++;
	}

	$last_txn_invoice_id = 0;
	$invoiceSummarySql = "INSERT INTO transaction_invoice ({$invoiceSummaryFld}) VALUES ({$invoiceSummaryVals})";
	
	//echo $invoiceSummarySql;
	
	$status_response = array("success" => "N", "message" => "Unable to create transaction. Please try again.");
	
	if(mysqli_query($conn, $invoiceSummarySql))
	{
		$last_txn_invoice_id = mysqli_insert_id($conn);
	
		//Step 3: insert each item into transaction_invoice_item table
		$transaction_item_details = array();

		$items = $_POST['items'];


		for($i = 0; $i < count($items);  $i++)
		{
			
			$transaction_item_details[$i] = array('txn_invoice_no' => $nextTxnInvoiceNo,
													'item_type_id' => $items[$i],
													'txn_invoice_item_qty' => $_POST['items_qty'][$i],
													'txn_invoice_item_subtotal' => $_POST['items_subtotal'][$i],
													'last_modified_by' => $_SESSION['user_id']
												);
		}
		
		
		$invoiceItemSqls = array();
		
		foreach($transaction_item_details as $item => $details)
		{
			$invoiceItemFlds = "";
			$invoiceItemVals = "";
			$itemFldCtr = 0;
			foreach($details as $flds => $vals)
			{
				$invoiceItemFlds .= ($itemFldCtr == count($details)-1) ? "{$flds}" : "{$flds}, ";
				$invoiceItemVals .= ($itemFldCtr == count($details)-1) ? "'{$vals}'" : "'{$vals}', ";
				$itemFldCtr++;
			}
			$invoiceItemSqls[$item] = "INSERT INTO transaction_invoice_item ({$invoiceItemFlds}) VALUES ({$invoiceItemVals})";
		}

		$insertSuccess = 0;
		for($j = 0; $j < count($invoiceItemSqls); $j++)
		{
			if(mysqli_query($conn, $invoiceItemSqls[$j]))
				$insertSuccess++;
		}

		//Step 4: compose response
		if($insertSuccess == count($invoiceItemSqls))
			$status_response = array("success" => "Y", "message" => "Transaction successful!<br/>", "invoice_no" => $nextTxnInvoiceNo, "pickup_date_time" => $pickup_date." ".$pickup_time);
	}
	
}
echo json_encode($status_response);

?>