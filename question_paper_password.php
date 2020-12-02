<?php 
if(!isset($_COOKIE['wdb_email']))
{
  header("location:index.php");
  exit;
}
require_once 'includes/cnpariksha.php';
require_once 'help/helper.php';
 
include 'includes/header.php';
echo '<br><br><br>';
echo '<br><br><br>'; 
echo '<br><br>'; 
?>
<?php  
if( isset($_GET['show']) && isset($_GET['qptq']) && isset($_GET['desc']) )
{
	$test_id=$_GET['show'];
	$email=$_COOKIE['wdb_email'];
	$total_question=$_GET['qptq'];
	$desc=$_GET['desc'];
	$password=((isset($_POST['password']) && $_POST['password']!='')?sanitize($_POST['password']):'');
	$ch_sql="SELECT password FROM `qpaper` WHERE qpid='$test_id'";
	$check_sql=mysqli_query($cnp,$ch_sql);
	$get_password=mysqli_fetch_assoc($check_sql);
	if( isset($_POST['submit']))
	{
		if($get_password['password']==$password)
		{
			?>
			<script type="text/javascript">
				location.href="start_exam.php?show=<?=$test_id;?>&tq=<?=$total_question;?>&&des=<?=$desc;?>";
			</script>
			<?php
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("Invalid Password !!!Try Again");
			</script>
			<?php
		}
	}
	else
	{

	}
	?>
	<br>
	<div class="container" style="background-color: #076cb0;">
	<h2 class="text-center p-3 mb-4" style="color: white; font-family: sans-serif; padding-top: 30px;">Launch Exam</h2>
	</div>
	<div class="container">
		<form method="post" action="" enctype="multipart/form-data" class="text-center">
			<div class="form-group col-lg-12" style="margin-bottom: 20px;">   
            	<label style="font-size: 20px;">Email : <?=$email;?></label> &nbsp;
        	</div>
        	<div class="form-group col-lg-12" style="margin-bottom: 20px;">   
            	<label style="font-size: 20px;">Paper ID : <?=$test_id;?></label> &nbsp;
        	</div>
        	<div class="form-group col-lg-12" style="margin-bottom: 20px;">   
            	<label style="font-size: 20px;">Total Question : <?=$total_question;?></label> &nbsp;
        	</div>

        	<div class="row">
        		<div class=" form-group col-lg-4">
        		</div>
	        	<div class="form-group col-lg-4" style="margin-bottom: 20px;">   
	            	<input type="password" name="password" placeholder="Enter Paper Password" value="<?=$password;?>" class="form-control" required>
	            </div>
	            <div class=" form-group col-lg-4">
        		</div>
        	</div>
        	<div class="row p-3 mb-4" style="width: auto;"> 
       			<div class="form-group col-lg-12">
		            <input type="reset" name="reset" value="Reset" class="btn btn-primary">
		            &nbsp; &nbsp;
		            <input type="submit" value="Start" name="submit" class="btn btn-success">
		            &nbsp; &nbsp;
		            <a href="student_dashboard.php" class="btn btn-danger">Cancel</a>    
        		</div>
        	</div>
        <div class="clearfix"></div>
		</form>
	</div>
	<?php
}
?>
<br>
<?php include 'includes/footer.php'; ?>