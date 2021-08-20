<?php
require 'conn.php';

if(isset($_POST))
{
	$customer = $_POST['customer'];
	$customer_id = 0;
	$sql = "SELECT customer_id FROM customer WHERE customer_name LIKE '%{$customer}%' OR customer_mobile LIKE '%{$customer}%'";
	$res = mysqli_query($conn, $sql);

	if(mysqli_num_rows($res) > 0)
	{
		while($customer = mysqli_fetch_assoc($res))
		{
			$customer_id = $customer['customer_id'];
		}
	}
	
	echo json_encode(array('customer_id' => $customer_id));
}

?>