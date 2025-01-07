<?php 
session_start();
require 'database.php';
if (isset($_SESSION['rid'])) {
if(isset($_POST['update'])){
    $id=$_SESSION['rid'];
    $rname = $_POST['rname'];
    $rphone = $_POST['rphone'];
    $bg = $_POST['bg'];
    $rcity = $_POST['rcity'];
    $rpassword = $_POST['rpassword'];
    $update = "UPDATE receivers SET rname='$rname', rpassword='$rpassword', rphone='$rphone', rbg='$bg',rcity='$rcity' WHERE id='$id'";
    if ($conn->query($update) === TRUE) {
        $msg = "Your profile is updated successfully.";
        header( "location:../rprofile.php?msg=".$msg);
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
        header( "location:../rprofile.php?error=".$error );
    }
    $conn->close();
}


}elseif (isset($_SESSION['hid'])) {
    if(isset($_POST['update'])){
        $id=$_SESSION['hid'];
    $donor_name = $_POST['donor_name'];
    $donor_phone = $_POST['donor_phone'];
    $donor_city = $_POST['donor_city'];
    $donor_password = $_POST['donor_password'];
    $smoking_status = $_POST['smoking_status'];
    // echo "<pre>";
    // var_dump($id,$hemail,$hcity,$hphone,$hpassword);
    // echo "</pre>";
    // die();
    $update = "UPDATE donor SET donor_name='$donor_name', donor_password='$donor_password', donor_phone='$donor_phone', donor_city='$donor_city',smoking_status='$smoking_status' WHERE id='$id'";
    if ($conn->query($update) === TRUE) {
        $msg= "Your profile is updated successfully.";
        header( "location:../hprofile.php?msg=".$msg);
    } else {
        $error= "Error: " . $sql . "<br>" . $conn->error;
        header( "location:../hprofile.php?error=".$error);
    }
    $conn->close();
}
}else{
    header("location:../login.php");
}
?>