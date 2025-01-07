<?php
require 'database.php';
if(isset($_POST['hregister'])){
	$hname=$_POST['hname'];
	$nid=$_POST['hemail'];
	$hpassword=$_POST['hpassword'];
	$hphone=$_POST['hphone'];
	$hcity=$_POST['hcity'];
	$somking_status = $_POST['smoking_status'];
	$check_email = mysqli_query($conn, "SELECT donor_nid FROM donor where donor_nid = '$nid' ");
	if(mysqli_num_rows($check_email) > 0){
    $error= 'Email Already exists. Please try another Nid.';
    header( "location:../register.php?error=".$error );
}else{
	$sql = "INSERT INTO donor (donor_name, donor_nid, donor_password, donor_phone, donor_city,smoking_status)
	VALUES ('$hname','$nid', '$hpassword', '$hphone', '$hcity','$somking_status')";
	if ($conn->query($sql) === TRUE) {
		$msg = 'You have successfully registered. Please, login to continue.';
		header( "location:../login.php?msg=".$msg );
	} else {
		$error = "Error: " . $sql . "<br>" . $conn->error;
        header( "location:../register.php?error=".$error );
	}
	$conn->close();
}
}
?>