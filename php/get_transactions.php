<?php
include 'conn.php';

if(isset($_GET))
{
	$txn_status = $_GET['txn_status'];
	$filter_keyword = $_GET['filter_keyword'];
	$filter_by = $_GET['filter_by'];

	$filter_string = $filter_keyword != "" ? " AND {$filter_by} LIKE '%{$filter_keyword}%'" : "";

	$sql = "SELECT txn.*, txn_item.*, cust.customer_name, cust.customer_mobile, CONCAT(cust.customer_streetaddress, \" \", cust.customer_suburb, \" \", cust.customer_state,\" \", cust.customer_postcode) AS customer_address, cust.customer_email, item.item_type_name, item.item_type_price, users.user_name
		FROM transaction_invoice txn 
		LEFT JOIN transaction_invoice_item txn_item ON txn.txn_invoice_no=txn_item.txn_invoice_no 
		LEFT JOIN customer cust ON txn.txn_customer_id=cust.customer_id
		LEFT JOIN item_type item ON item.item_type_id=txn_item.item_type_id
		LEFT JOIN users ON txn.last_modified_by=users.user_id
		WHERE txn_status = '{$txn_status}' {$filter_string} ORDER BY txn_invoice_date DESC";


	$transactions = array();
	$txnCtr = 0;
	$itemCtr = 0;
	$prevTxnInvoice = "";

	if($res = mysqli_query($conn, $sql))
	{

		while($txns = mysqli_fetch_assoc($res))
		{
			if($txns['txn_invoice_no'] == $prevTxnInvoice){
				$itemCtr++;
			}
			else
			{
				$itemCtr = 0;
				$txnCtr++;
				$transactions[$txnCtr-1] = array('txn_invoice_no' => $txns['txn_invoice_no'],
												'txn_invoice_date' => date('d/m/Y', strtotime($txns['txn_invoice_date'])),
												'txn_customer_id' => $txns['txn_customer_id'],
												'txn_status' => $txns['txn_status'],
												'txn_total_qty' => $txns['txn_total_qty'],
												'txn_gross_amt' => "$ {$txns['txn_gross_amt']}",
												'txn_discount_amt' => "$ {$txns['txn_discount_amt']}",
												'txn_prepaid_amt' => "$ {$txns['txn_prepaid_amt']}",
												'txn_gst_amt' => "$ {$txns['txn_gst_amt']}",
												'txn_net_amt' => "$ {$txns['txn_net_amt']}",
												'txn_payment_status' => $txns['txn_payment_status'],
												'txn_pickup_date' => date('d/m/Y g:i a', strtotime($txns['txn_pickup_date'])),
												'txn_notes' => $txns['txn_notes'],
												'txn_invoice_isvoid' => $txns['txn_invoice_isvoid'] == 0 ? "No" : "Yes",
												'customer_name' => $txns['customer_name'],
												'customer_address' => $txns['customer_address'],
												'customer_email' => $txns['customer_email'],
												'customer_mobile' => $txns['customer_mobile'],
												'last_modified_by' => $txns['user_name']
												);
			}

			$transactions[$txnCtr-1]['items'][$itemCtr] = array('txn_invoice_item_id' => $txns['txn_invoice_item_id'],
															'item_type_id' => $txns['item_type_id'],
															'item_type_name' => $txns['item_type_name'],
															'item_type_price' => $txns['item_type_price'],
															'txn_invoice_item_qty' => $txns['txn_invoice_item_qty'],
															'txn_invoice_total_charge_amt' => $txns['txn_invoice_total_charge_amt'],
															'txn_invoice_item_subtotal' => $txns['txn_invoice_item_subtotal']
															);
			$prevTxnInvoice = $txns['txn_invoice_no'];
		}
	}
}

echo json_encode(array('transactions' => $transactions));

?>