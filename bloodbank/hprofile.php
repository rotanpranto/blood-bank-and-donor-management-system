<?php
require 'file/database.php';
session_start();
if(!isset($_SESSION['hid']))
{
  header('location:login.php');
}
else {
	if(isset($_SESSION['hid'])){
		$id=$_SESSION['hid'];
		$sql = "SELECT * FROM donor WHERE id='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
	}
}
?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Receiver Profile"; ?>
<?php require 'head.php';?>
<body>
	<?php require 'header.php'; ?>

	<div class="container cont">

		<?php require 'message.php'; ?>

		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-4 col-sm-6 mb-5">
				<div class="card">
					<div class="media justify-content-center mt-1">
						<img src="image/user.png" alt="profile" class="rounded-circle" width="70" height="60">
					</div>
					<div class="card-body">
					   <form action="file/updateprofile.php" method="post">
					   	<label class="text-muted font-weight-bold" class="text-muted font-weight-bold">Donor Name</label>
						<input type="text" name="donor_name" value="<?php echo $row['donor_name']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold">Donor Password</label>
						<input type="text" name="donor_password" value="<?php echo $row['donor_password']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold">Donor Phone Number</label>
						<input type="text" name="donor_phone" value="<?php echo $row['donor_phone']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold">Donor City</label>
						<input type="text" name="donor_city" value="<?php echo $row['donor_city']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold">Smoking Status</label>
						<input type="text" name="smoking_status" value="<?php echo $row['smoking_status']; ?>" class="form-control mb-3">
						<input type="submit" name="update" class="btn btn-block btn-primary" value="Update">
					   </form>
					</div>
					<a href="index.php" class="text-center">Cancel</a><br>
				</div>
			</div>
		</div>
	</div>
	<?php require 'footer.php'; ?>
</body>
</html>