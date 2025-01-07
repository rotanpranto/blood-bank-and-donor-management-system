<?php 
session_start();
require 'file/database.php';
if(isset($_GET['search'])){
    $searchKey = $_GET['search'];
    $sql = "select bloodinfo.*, donor.* from bloodinfo, donor where bloodinfo.hid=donor.id && bg LIKE '%$searchKey%'";
}else if(isset($_GET['city'])){
    $searchKey = $_GET['city'];
    $sql = "select bloodinfo.*, donor.* from bloodinfo, donor where bloodinfo.hid=donor.id && donor_city  = '$searchKey'";
}
else{
    $sql = "select bloodinfo.*, donor.* from bloodinfo, donor where bloodinfo.hid=donor.id";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Available Blood Samples"; ?>
<?php require 'head.php'; ?>
<body>
    <?php require 'header.php'; ?>
    <div class="container cont">
        
        <?php require 'message.php'; ?>
        
        <div class="row col-lg-8 col-md-8 col-sm-12 mb-3">
            <form method="get" action="" style="margin-top:-20px; ">
            <label class="font-weight-bolder">Select Blood Group:</label>
               <select name="search" class="form-control">
               <option><?php echo @$_GET['search']; ?></option>
               <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
               </select><br>
               <a href="abs.php" class="btn btn-info mr-4"> Reset</a>
               <input type="submit" name="submit" class="btn btn-info" value="search">
           </form>
        </div>
        <div class="row col-lg-8 col-md-8 col-sm-12 mb-3">
            <form method="get" action="" style="margin-top:-20px; ">
            <label class="font-weight-bolder">Select City:</label>
               <select name="city" class="form-control">
               <option><?php echo @$_GET['city']; ?></option>
               <option value="Dhaka">Dhaka</option>
                <option value="Dinajpur">Dinajpur</option>
                <option value="Bhairab">Bhairab</option>
                <option value="Kishoregonj">Kishoregonj</option>
                <option value="Narsingdi">Narsingdi</option>
                <option value="Narayanganj">Narayanganj</option>
                <option value="Sylhet">Sylhet</option>
                <option value="Bogura">Bogura</option>
                <option value="Hobiganj">Hobiganj</option>
                <option value="Manikgonj">Manikgonj</option>
               </select><br>
               <a href="abs.php" class="btn btn-info mr-4"> Reset</a>
               <input type="submit" name="submit" class="btn btn-info" value="search">
           </form>
        </div>

        <table class="table table-responsive table-striped rounded mb-5">
            <tr><th colspan="7" class="title">Available Blood Samples</th></tr>
            <tr>
                <th>#</th>
                <th>Donor Name</th>
                <th>Donor City</th>
                <th>Donor Nid</th>
                <th>Donor Phone</th>
                <th>Donor Smoking Status</th>
                <th>Blood Group</th>
                <th>Last Donated</th>
                <th>Action</th>
            </tr>

            <div>
                <?php
                if ($result) {
                    $row =mysqli_num_rows( $result);
                    if ($row) { echo "<b> Total ".$row." </b>";
                }else echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">Nothing to show.</b>';
            }
            ?>
            </div>

        <?php while($row = mysqli_fetch_array($result)) { ?>

            <tr>
                <td><?php echo ++$counter;?></td>
                <td><?php echo $row['donor_name'];?></td>
                <td><?php echo ($row['donor_city']); ?></td>
                <td><?php echo ($row['donor_nid']); ?></td>
                <td><?php echo ($row['donor_phone']); ?></td>
                <td><?php echo ($row['smoking_status']); ?></td>
                <td><?php echo ($row['bg']); ?></td>
                <td><?php echo ($row['last_donated']); ?></td>

                <?php $bid= $row['bid'];?>
                <?php $hid= $row['hid'];?>
                <?php $bg= $row['bg'];?>
                <form action="file/request.php" method="post">
                    <input type="hidden" name="bid" value="<?php echo $bid; ?>">
                    <input type="hidden" name="hid" value="<?php echo $hid; ?>">
                    <input type="hidden" name="bg" value="<?php echo $bg; ?>">

                <?php if (isset($_SESSION['hid'])) { ?>
                <td><a href="javascript:void(0);" class="btn btn-info hospital">Request For Donation</a></td>
                <?php } else {(isset($_SESSION['rid']))  ?>
                <td><input type="submit" name="request" class="btn btn-info" value="Request For Donation"></td>
                <?php } ?>
                
                </form>
            </tr>

        <?php } ?>
        </table>
    </div>
    <?php require 'footer.php' ?>
</body>

<script type="text/javascript">
    $('.hospital').on('click', function(){
        alert("Donor user can't request for blood.");
    });
</script>