<?php
if(isset($_POST['rregister'])){
	require 'database.php';
	$rname=$_POST['rname'];
	$remail=$_POST['remail'];
	$rpassword=$_POST['rpassword'];
	$rphone=$_POST['rphone'];
	$rcity=$_POST['rcity'];
	$rbg=$_POST['rbg'];
	$check_email = mysqli_query($conn, "SELECT rnid FROM receivers where rnid = '$remail' ");
	if(mysqli_num_rows($check_email) > 0){
    $error= 'Email Already exists. Please try another Nid.';
    header( "location:../register.php?error=".$error );
}else{
	$sql = "INSERT INTO receivers (rname, rnid, rpassword, rphone, rcity, rbg)
	VALUES ('$rname','$remail', '$rpassword', '$rphone', '$rcity', '$rbg')";
	if ($conn->query($sql) === TRUE) {
		$msg = "You have successfully registered. Please, login to continue.";
		header( "location:../login.php?msg=".$msg);
	} else {
		$error = "Error: " . $sql . "<br>" . $conn->error;
        header( "location:../register.php?error=".$error );
	}
	$conn->close();
}
}
?>