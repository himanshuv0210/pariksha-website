<?php 
if(!isset($_COOKIE['wdb_email']))
{
  header("location:index.php");
  exit;
}
require_once 'includes/cnpariksha.php';
require_once 'help/helper.php';
?>
<?php 
include 'includes/header.php';
echo '<br><br><br>';
echo '<br><br><br>'; 
?>
<p style="font-size: 50px;">
	<?php echo "Email ID : ";?>
	<?=($_COOKIE['wdb_email']); ?>
	<?php echo '<br>';?>
	<?php echo "Profile type : ";?>
	<?=($_COOKIE['wdb_protype']); ?>
</p>
<?php
include 'includes/footer.php';
?>