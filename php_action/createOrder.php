<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	



for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity , product.product_name FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				
			if ($updateQuantity[$x] <= 0) 
			{
				$stock_alert = "Please Upade your stock";
				$name_of_product = $updateProductQuantityResult[1];
			}
			else
			{
				$stock_alert = "";
			}

		} 
	}
if (empty($stock_alert)) 
{
	
  $orderDate 					= date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName 					= $_POST['clientName'];
  $clientContact 				= $_POST['clientContact'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $vatValue 					= $_POST['vatValue'];
  $vatValue1 					= $_POST['vatValue1'];
  $totalAmountValue     		= $_POST['totalAmountValue'];
  $discount 					= $_POST['discount'];
  $grandTotalValue 			    = $_POST['grandTotalValue'];
  $paid 						= $_POST['paid'];
  $dueValue 				    = $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];
  $clientaddress 				= $_POST['clientaddress'];
  $clientgst_no 				= $_POST['clientgst_no'];
  $sgst 						= $_POST['sgst'];
  $cgst 						= $_POST['cgst'];

			


	$sql = "INSERT INTO orders (order_date, client_name, client_contact, sub_total, vat,vat1, total_amount, discount, grand_total, paid, due, payment_type, payment_status, order_status,client_add,client_Gst,sgst,cgst) VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue','$vatValue1', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', $paymentType, $paymentStatus, 1, '$clientaddress', '$clientgst_no','$sgst','$cgst')";
	
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;
	}

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

				$connect->query($orderItemSql);		

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
}
else
{
	$valid['error'] = true;
	$valid['messages'] = $name_of_product." "."stock not available please update your stock";
	echo json_encode($valid);
}

} // /if $_POST
// echo json_encode($valid);