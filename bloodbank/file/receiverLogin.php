<?php
session_start();
    require 'database.php';
    if(isset($_POST['rlogin'])){
    $remail=$_POST['remail'];
    $rpassword=$_POST['rpassword'];
    $sql="select * from receivers where rnid='$remail' and rpassword='$rpassword'";
    $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $rows_fetched=mysqli_num_rows($result);
    if($rows_fetched==0){
        $error= "Wrong nid or password. Please try again.";
        header( "location:../login.php?error=".$error);
    }else{
        $row=mysqli_fetch_array($result);
        $_SESSION['rnid']=$row['rnid'];
        $_SESSION['rname']=$row['rname'];
        $_SESSION['rid']=$row['id'];
        $msg= $_SESSION['rname'].' have logged in.';
        header( "location:../abs.php?msg=".$msg);
    } 
  }
?>