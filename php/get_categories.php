<?php
require "conn.php";

$sql = "SELECT * FROM category";
$i = 0;
if($result = mysqli_query($conn, $sql))
{
	while($categs = mysqli_fetch_assoc($result))
	{
		$categories[$i] = array('category_id' => $categs['category_id'], 
								'category_name' => $categs['category_name']);
		$i++;
	}
}

echo json_encode(array('categories' => $categories));

?>