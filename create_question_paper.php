<?php 
if(!isset($_COOKIE['wdb_email']))
{
	if(!isset($_COOKIE['qpaper_id']))
	{
		header("location:teacher_dashboard.php");
		exit;
	}
  	header("location:index.php");
  	exit;
}
require_once 'includes/cnpariksha.php';
require_once 'help/helper.php';
?>
<?php 
include("includes/header.php");
echo '<br><br><br>';
echo '<br><br><br>'; 
$email=$_COOKIE['wdb_email'];
$qpid=$_GET['create'];
$sub_question=explode('_',$qpid);
$sub_data['sub']=$sub_question[0];
$subject=((isset($_POST['subject']) && $_POST['subject']!='')?sanitize($_POST['subject']):'');
$gsql=mysqli_query($cnp,"select qpid from qpaper where qpid='$qpid'");
?>
<div class="container" style="background-color: #076cb0;">
<h2 class="text-center p-3 mb-4" style="color: white; font-family: sans-serif; padding-top: 30px;">Generate Question Paper</h2>
</div>
<div class="container">
    <form action="show_question_paper.php?show=<?=$sub_data['sub'];?>" method="post" enctype="multipart/form-data" class="form-inline">
    	<div class="form-group col-lg-12" style="margin-bottom: 20px;">   
            <label for="subject" style="font-size: 20px;">Subject : </label> &nbsp;
            <select class="form-control" id="subject" name="subject" style="width: 365px;" required>
            <option value=""<?=(($subject=='')?' selected':''); ?>>Select your choice</option>
	        <option value="$sub_data['sub'];?>"<?=(($subject==$sub_data['sub'])?'':''); ?>> <?=$sub_data['sub'];?></option>
            </select>
        </div>
         <div class="p-3 mb-4">
        	<div class="text-center">
	            <input type="reset" name="cancel" class="btn btn-primary">
	            &nbsp; &nbsp;
	            <input type="submit" name="submit" value="Generate question paper" class="btn btn-success">
	            &nbsp; &nbsp;
	            <a href="manage_question_paper.php" class="btn btn-danger">Back</a>
        	</div>
        </div>
    </form>
</div>
<?php include 'includes/footer.php'; ?>