<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$username = $_POST['username'];
	$address = $_POST['address'];
	$mobile_no = $_POST['mobile_no'];
	$gst_no = $_POST['gst_no'];
	$bank_name = $_POST['bank_name'];
	$bank_ac = $_POST['bank_ac'];
	$bank_ifsc_code = $_POST['bank_ifsc_code'];
	$bill_no = $_POST['bill_no'];
	$Description = $_POST['Description'];

	$userId = $_POST['user_id'];

	$sql = "UPDATE users SET username = '$username',Address = '$address',mobile = '$mobile_no',gst = '$gst_no',bank_name = '$bank_name',bank_ac = '$bank_ac',Bank_IFSC_Code = '$bank_ifsc_code', Description='$Description',billno = '$bill_no' WHERE user_id = {$userId}";
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}

	$connect->close();

	echo json_encode($valid);

}

?>