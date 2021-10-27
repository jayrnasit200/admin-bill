<?php require_once 'includes/header.php'; ?>

<?php 
$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();
?>

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Setting</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-wrench"></i> Setting</div>
			</div> <!-- /panel-heading -->

			<div class="panel-body">

				

				<form action="php_action/changeUsername.php" method="post" class="form-horizontal" id="changeUsernameForm">
					<fieldset>
						<legend>Change Username</legend>

						<div class="changeUsenrameMessages"></div>			

						<div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Username</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="username" name="username" placeholder="Usename" value="<?php echo $result['username']; ?>"/>
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Address</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $result['Address']; ?>"/>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Mobile No</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobilr No" value="<?php echo $result['mobile']; ?>"/>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="username" class="col-sm-2 control-label">GST No</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="GST No" value="<?php echo $result['gst']; ?>"/>
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Bank Name</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank Name" value="<?php echo $result['bank_name']; ?>"/>
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Bank Ac</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="bank_ac" name="bank_ac" placeholder="Bank Ac" value="<?php echo $result['bank_ac']; ?>"/>
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Bank IFSC Code</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code" placeholder="Bank IFSC Code" value="<?php echo $result['Bank_IFSC_Code']; ?>"/>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Bill No</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="bill_no" name="bill_no" placeholder="Bill No" value="<?php echo $result['billno']; ?>"/>
					    </div>
					  </div>




					  <div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Description</label>
					    <div class="col-sm-10">
					      <textarea type="text" class="form-control" id="Description" name="Description" placeholder="Description"><?php echo $result['Description']; ?></textarea>
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" /> 
					      <button type="submit" class="btn btn-success" data-loading-text="Loading..." id="changeUsernameBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
					    </div>
					  </div>


					</fieldset>
				</form>

				<form action="php_action/changePassword.php" method="post" class="form-horizontal" id="changePasswordForm">
					<fieldset>
						<legend>Change Password</legend>

						<div class="changePasswordMessages"></div>

						<div class="form-group">
					    <label for="password" class="col-sm-2 control-label">Current Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="password" name="password" placeholder="Current Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="npassword" class="col-sm-2 control-label">New password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" /> 
					      <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
					      
					    </div>
					  </div>


					</fieldset>
				</form>

			</div> <!-- /panel-body -->		

		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->	
</div> <!-- /row-->


<script src="custom/js/setting.js"></script>
<?php require_once 'includes/footer.php'; ?>