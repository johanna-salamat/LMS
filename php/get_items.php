<?php
require "conn.php";

$sql = "SELECT * 
		FROM item_type item 
		LEFT JOIN category cat ON item.category_id = cat.category_id";
$response = array();

if($result = mysqli_query($conn, $sql))
{
	$i = 0;
	while($items = mysqli_fetch_assoc($result))
	{
		$response[$i] = array('item_type_id'  => $items['item_type_id'],
								'item_type_name' => $items['item_type_name'],
								'item_type_desc' => $items['item_type_desc'],
								'item_type_price' => $items['item_type_price'],
								'category_name' => $items['category_name']
							);
		$i++;
	}
}

echo json_encode(array('items' => $response));

?>