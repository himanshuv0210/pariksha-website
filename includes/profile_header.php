<?php 
$email=$_COOKIE['wdb_email'];
$sql1="select * from profile where email='$email'";
$res11=mysqli_query($cnp,$sql1);
$profile1=mysqli_fetch_assoc($res11);
?>
<div class="container text-center">
    <h1 style="color:#076cb0; font-family: sans-serif; padding-bottom: 0; "><?=$profile1['institutename']; ?></h1>
    Contact Person : <?=$profile1['contactperson']; ?> |
    Email : <?=$email; ?> | 
    Address : <?php echo $profile1['address'].", ".$profile1['pin']; ?> | 
    Contact Numbers : <?php echo $profile1['mno1'].", ".$profile1['mno2']; ?>  |
    Profile type  : <?=$_COOKIE['wdb_protype']; ?>
</div>