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
$email=$_COOKIE['wdb_email'];
$subject=$_GET['show'];
$quopid=$_GET['qpid'];

if(isset($_GET['add']) && isset($_GET['show']) && isset($_GET['qpid']))
{
	$subject1=$_GET['show'];
	$quopid1=$_GET['qpid'];
	$new_qid=$_GET['add'];
    $in_sql="INSERT INTO `qpid_qid_mapping`(`srno`, `qpid`, `qid`) VALUES (NULL,'$quopid1',$new_qid)";
	$insert_sql=mysqli_query($cnp,$in_sql);

	$up_sql="UPDATE `qbank` SET `qpid`='$quopid',`status`=1 WHERE qid=$new_qid";
	$update_sql=mysqli_query($cnp,$up_sql);?>
	<script>
		location.href="add_questions.php?show=<?=$subject1;?>&&qpid=<?=$quopid1;?>";
	</script>
<?php
}

$sqlqp=mysqli_query($cnp,"select * from qpaper where qpid='$quopid'");
$qp_details=mysqli_fetch_assoc($sqlqp);
$cq_sql=mysqli_query($cnp,"SELECT COUNT(`qid`) as current_questions FROM `qpid_qid_mapping` WHERE qpid='$quopid'");
$current_questions=mysqli_fetch_assoc($cq_sql);
$added_questions=$current_questions['current_questions'];

$adsql=mysqli_query($cnp,"SELECT * from qbank WHERE subject='$subject' and status=0");
include 'includes/profile_header.php'; 
?>
<div class="container" style="background-color: #076cb0;">
<h2 class="text-center p-3" style="color: white; font-family: sans-serif; ">Add Question</h2>
<table class="table table-borderless table-condensed table-striped" style="color: white; font-family: sans-serif;">
  <tr>
    <td>Question Paper ID : <?=$qp_details['qpid'];?></td>
    <td>Keyword : <?=$qp_details['keyword'];?></td>
    <td>Subject : <?=$_GET['show'];?></td>
  </tr>
  <tr >
    <td>Description: <?=$qp_details['description'];?></td>
    <td>Total Questions :  <?=$added_questions;?> / <?=$qp_details['totalquestion'];?></td>
    <td><a href="view_question_paper.php?show=<?=$subject;?>&&qpid=<?=$quopid;?>" class="btn btn-danger" id="add-subject-btn">Back</a></td>
  </tr>
</table>
</div>
<div class="container">
	<div class="row align-items-center border border-primary">
    <?php while($search_show3=mysqli_fetch_array($adsql)): ?>
    <div class="col-lg-4 float-lg-left" style="padding-top: 10px; padding-bottom: 10px; ">
        <?php echo '<img src="data:image;base64,'.base64_encode($search_show3['supporting_img']).'" alt="No Supporting Image" style="width:330px; height:290px;" class="rounded" name="paper_image">'  ;?>
    </div>
    <div class="col-lg-7" style="margin-top: 10px; margin-bottom: 10px;">
        <div class="message-box" >
        	<div class="container  border border-dark" style="padding-top: 15px; padding-left: 20px; background-color: #FFF2ED;">
	        <p><label style="font-weight: bold;">Question ID : &nbsp; <?=$search_show3['qid']; ?> </label><br>
	        <label style="color: #399E1C;">Question : &nbsp; <?=$search_show3['question']; ?> </label><br>
			<label>1.&nbsp; </label><?=$search_show3['op1']; ?><br>
	        <label>2.&nbsp; </label><?=$search_show3['op2']; ?><br>
	        <label>3.&nbsp; </label><?=$search_show3['op3']; ?><br>
	        <label>4.&nbsp; </label><?=$search_show3['op4']; ?><br></p>
	        <p style="color: green;"><label>Answer :&nbsp; </label><?=$search_show3['answer']; ?></p> 
	    	</div>
        </div> 
    </div>
    <div class="col-lg-1">
     <a href="add_questions.php?add=<?=$search_show3['qid'];?>&&show=<?=$subject;?>&&qpid=<?=$quopid;?>" style="color:green; font-size: 20px;">Add</a>
    </div>
    <hr>
    <?php endwhile; ?>
 </div>
</div>
<?php include 'includes/footer.php'; ?>



