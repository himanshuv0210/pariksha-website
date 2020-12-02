 <?php
require_once 'includes/cnpariksha.php'; 
$streamcategory=$_POST['streamcategory'];
$streamname=$_POST['streamname'];
$subject=$_POST['subject'];
$chapter=$_POST['chapter'];
$section=$_POST['section'];
$selected=$_POST['selected1'];
ob_start();
?>
 <input type="text" name="keyword" class="form-control" value="<?php echo $streamcategory." - ".$streamname." - ".$subject." - ".$chapter." - " .$section; ?>" readonly size="55" required>
<?php echo ob_get_clean();?>
