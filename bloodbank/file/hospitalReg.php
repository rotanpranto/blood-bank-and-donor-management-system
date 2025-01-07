<?php
require 'database.php';
if(isset($_POST['donor_register'])){
	$hname=$_POST['donor_name'];
	$hemail=$_POST['donor_email'];
	$hpassword=$_POST['donor_password'];
	$hphone=$_POST['donor_phone'];
	$hcity=$_POST['donor_city'];
	$check_email = mysqli_query($conn, "SELECT donor_email FROM donor_ospitals where donor_email = '$hemail' ");
	if(mysqli_num_rows($check_email) > 0){
    $error= 'Email Already exists. Please try another Email.';
    header( "location:../register.php?error=".$error );
}else{
	$sql = "INSERT INTO hospitals (donor_name, donor_email, donor_password, donor_phone, donor_city)
	VALUES ('$hname','$hemail', '$hpassword', '$hphone', '$hcity')";
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