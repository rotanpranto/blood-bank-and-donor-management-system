<?php
include "database.php";
    session_start();
    $reqid=$_GET['reqid'];
	$status = "Accepted";
    $donor_id = $_SESSION['hid'];
    $date = date('m/d/Y h:i:s', time());
	$sql = "update bloodrequest SET status = '$status' WHERE reqid = '$reqid'";

    if (mysqli_query($conn, $sql)) {
    $donor_date_update = mysqli_query($conn,"UPDATE donor SET last_donated = '$date'  WHERE id='$donor_id'");
	$msg="You have accepted the request.";
	header("location:../bloodrequest.php?msg=".$msg );
    } else {
    $error= "Error changing status: " . mysqli_error($conn);
    header("location:../bloodrequest.php?error=".$error );
    }
    mysqli_close($conn);
?>