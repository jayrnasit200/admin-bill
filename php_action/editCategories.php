<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['editCategoriesName'];
  $brandStatus = $_POST['editCategoriesStatus']; 
  $categoriesId = $_POST['editCategoriesId'];

  $billno = $_POST['billno'];
  $bill_date = $_POST['bill_date']; 
  $bill_amount = $_POST['bill_amount'];
  $bill_gst = $_POST['bill_gst'];

	$sql = "UPDATE categories SET categories_name = '$brandName', billno = '$billno', bill_date = '$bill_date', bill_amount = '$bill_amount', gst_no='$bill_gst', categories_active = '$brandStatus' WHERE categories_id = '$categoriesId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the categories";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST