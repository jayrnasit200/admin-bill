<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
  
  $productName 		= $_POST['productName'];
  $quantity 			= $_POST['quantity'];
  $rate 					= $_POST['rate'];
  $brandName 			= $_POST['brandName'];
  $productStatus 	= $_POST['productStatus'];
  $hsn 			= $_POST['hsn'];
  $gst_rate 	= $_POST['gst_rate'];
  $pro_mrp = $_POST['pro_mrp'];
$sql = "SELECT product_name FROM product WHERE product_name = '".$productName."'";
$result = $connect->query($sql);
if($result->num_rows > 0)
{ 
					$valid['success'] = TRUE;
					$valid['messages'] = "This Product all ready Added";
}
else
{
	$sql = "INSERT INTO product (product_name, brand_id, quantity,hsn,gst_rate, pro_mrp, rate, active, status) 
				VALUES ('$productName', '$brandName', '$quantity','$hsn','$gst_rate', '$pro_mrp', '$rate', '$productStatus', 1)";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the members";
				}
	$connect->close();
}
	

	echo json_encode($valid);
 
} // /if $_POST