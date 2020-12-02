<?php 
if(!isset($_COOKIE['wdb_email']))
{
  header("location:index.php");
  exit;
}
require_once 'includes/cnpariksha.php';
$email=$_COOKIE['wdb_email'];	

include("includes/header.php");
echo '<br><br><br>';
echo '<br><br><br>';    
?>
<br>
<br>
<br>
<div class="container">
		<h2 style="font-family: sans-serif; margin-left: 15px;">Edit Profile</h2>
                <?php
                $sql3="select * from profile where email='$email' ";
                $res=mysqli_query($cnp,$sql3);
                $numrow=mysqli_num_rows($res);
                $pro=mysqli_fetch_assoc($res);
                $mobileno=$pro['mno1'];
                $mobileno2=$pro['mno2'];
                $iname=$pro['institutename'];
                $address=$pro['address'];
                $pin=$pro['pin'];
                $profiletype=$pro['profiletype'];
                $cperson=$pro['contactperson'];
            ?>
        <form method="post" action="register_profile.php" enctype="multipart/form-data" role="form" class="form-inline">
            <div class="form-group" style="margin-bottom: 20px; color: #076cb0;">
                <div class="col-sm-12">
                	<label for="contactperson" style="font-size: 15px;">Email :</label>
                	<br>
                    <input class="form-control" id="email" name="email" placeholder="Email" type="email" value="<?=$_COOKIE['wdb_email']; ?>" readonly>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px; color: #076cb0;">
                <div class="col-sm-12">
                	<label for="contactperson" style="font-size: 15px;">Mobile :</label>
                	<br>
                    <input class="form-control" id="mobile" name="mobileno" placeholder="Mobile" type="number" value="<?=$mobileno;?>" min="10" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px; color: #076cb0;">
                <div class="col-sm-12">
                	<label for="contactperson" style="font-size: 15px;">Another Mobile :</label>
                	<br>
                    <input class="form-control" id="mobile" name="mobileno2" placeholder="Another Mobile" type="number" value="<?=$mobileno2; ?>" min="10" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px; color: #076cb0;">
                <div class="col-sm-12">
                	<label for="contactperson" style="font-size: 15px;">Institute Name :</label>
                	<br>
                    <input class="form-control" id="first_name" name="iname" placeholder="Institute Name" type="text" value="<?=$iname; ?>" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px; color: #076cb0;">
                <div class="col-sm-12">
                	<label for="contactperson" style="font-size: 15px;">Address :</label>
                	<br>
                    <input class="form-control" id="first_name" name="address" placeholder="Address" type="text" value="<?=$address; ?>" required >
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px; color: #076cb0;">
                <div class="col-sm-12">
                	<label for="contactperson" style="font-size: 15px;">Pincode :</label>
                	<br>
                    <input class="form-control" id="mobileno" name="pin" placeholder="Pincode" type="number" value="<?=$pin; ?>" min="10" required >
                </div>
            </div>
            <div class="form-gorup" style="color: #076cb0; margin-bottom: 20px;">
                <div class="col-sm-12">
                <label for="profiletype" style="font-size: 15px;">Profile Type :</label>
                <br>
                <select class="form-control" style="width: auto; margin-left: 15px;" name="profiletype">
                <option value="Teacher"<?=(($profiletype=='Teacher')?' selected':''); ?>>Teacher</option>
                <option value="Student"<?=(($profiletype=='Student')?' selected':'');?>>Student</option>
                </select>
                </div>
            </div>
            <div class="form-group" style="color: #076cb0; margin-bottom: 20px;">
                <div class="col-lg-12">
                    <label for="profiletype" style="font-size: 15px;">Upload a logo :</label>
                    <br>
                    <input type="file" name="userImage" class="form-control" id="first_name" placeholder="upload a logo" required>
                </div>
            </div>
            <div class="form-group" style="color: #076cb0; margin-bottom: 20px;"> 
                <div class="col-sm-12">
                	<label for="contactperson" style="font-size: 15px;">Contact person :</label>
                	<br>
                    <input class="form-control" id="first_name" name="cperson" placeholder="Contact person" type="text" value="<?=$cperson; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" name="submit" class="btn btn-light btn-radius btn-brd grd1">
                        Save &amp; Continue
                    </button>
                    <button type="reset" name="cancel" class="btn btn-light btn-radius btn-brd grd1">
                        Cancel</button>
                </div>
            </div>
        </form>
</div>
<?php
include 'includes/footer.php';
?>