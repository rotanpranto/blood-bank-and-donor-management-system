<?php
include "database.php";
    $reqid=$_GET['reqid'];
	$status = "Rejected";
	$sql = "update bloodrequest SET status = '$status' WHERE reqid = '$reqid'";
    $donor_date_update = "UPDATE donor SET last_donated = 'N/A'  WHERE id='$donor_id'";
    if (mysqli_query($conn, $sql)) {
	$msg="You have Rejected the request.";
	header("location:../bloodrequest.php?msg=".$msg );
    } else {
    $error= "Error changing status: " . mysqli_error($conn);
    header("location:../bloodrequest.php?error=".$error );
    }
    mysqli_close($conn);
?>