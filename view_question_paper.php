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
$subject=$_GET['show'];
$quopid=$_GET['qpid'];

$sqlqp=mysqli_query($cnp,"select * from qpaper where qpid='$quopid'");
$qp_details=mysqli_fetch_assoc($sqlqp);

$cq_sql=mysqli_query($cnp,"SELECT COUNT(`qid`) as current_questions FROM `qpid_qid_mapping` WHERE qpid='$quopid'");
$current_questions=mysqli_fetch_assoc($cq_sql);
$added_questions=$current_questions['current_questions'];

$sqlqp=mysqli_query($cnp,"select * from qpid_qid_mapping where qpid='$quopid'");
$sqlqp_numrows=mysqli_num_rows($sqlqp);

if(isset($_GET['delete']) && isset($_GET['show']) && isset($_GET['qpid']))
{
	$subject2=$_GET['show'];
	$quopid2=$_GET['qpid'];
	$old_qid=$_GET['delete'];

    $del_sql="DELETE FROM `qpid_qid_mapping` where qid=$old_qid";
	$del_sql=mysqli_query($cnp,$del_sql);

	$up_sql="UPDATE `qbank` SET `qpid`='NULL',`status`=0 WHERE qid=$old_qid";
	$update_sql=mysqli_query($cnp,$up_sql);?>
	<script>
		location.href="view_question_paper.php?show=<?=$subject2;?>&&qpid=<?=$quopid2;?>";
	</script>
<?php
}

// If question paper created
include 'includes/profile_header.php'; 
?>
<br>
<div class="container" style="background-color: #076cb0;">
<h2 class="text-center p-3" style="color: white; font-family: sans-serif; ">Question Paper</h2>
<table class="table table-borderless table-condensed table-striped" style="color: white; font-family: sans-serif;">
  <tr>
    <td>Question Paper ID : <?=$qp_details['qpid'];?></td>
    <td>Keyword : <?=$qp_details['keyword'];?></td>
    <td>Password : <?=$qp_details['password'];?></td>
  </tr>
  <tr >
    <td>Description: <?=$qp_details['description'];?></td>
    <td>Total Questions :  <?=$added_questions;?> / <?=$qp_details['totalquestion'];?></td>
    <td>
    	<?php 
    	if($added_questions==$qp_details['totalquestion'])
    	{
    		?><a class="btn btn-success" disabled>Delete some Question</a> &nbsp;<?php
    	}
    	else 
    	{
    		?>
    		<a href="add_questions.php?show=<?=$subject;?>&&qpid=<?=$quopid;?>" class="btn btn-success" id="add-subject-btn">Add Question</a> &nbsp;
    		<?php
    	}
    	?>
    	<a href="manage_question_paper.php" class="btn btn-danger" id="add-subject-btn">Back</a>
    </td>
  </tr>
</table>
</div>

<?php
if($sqlqp_numrows>0)
{
	$sqlqid=mysqli_query($cnp,"SELECT qbank.qid,qbank.supporting_img,qbank.question,qbank.op1,qbank.op2,qbank.op3,qbank.op4,qbank.answer,qpid_qid_mapping.qid from qbank,qpid_qid_mapping where qbank.qid=qpid_qid_mapping.qid and qpid_qid_mapping.qpid='$quopid'");
?>
<div class="container">
	<div class="row align-items-center border border-primary">
    <?php 
    $x=0;
    while($search_show=mysqli_fetch_assoc($sqlqid)): 
    	$x++;
    	?>
    <div class="col-lg-4 float-lg-left" style="padding-top: 10px; padding-bottom: 10px;">
        <?php echo '<img src="data:image;base64,'.base64_encode($search_show['supporting_img']).'"  alt="No Supporting Image" style="width:330px; height:290px; " class="rounded" name="paper_image">'  ;?>
    </div>
    <div class="col-lg-7" style="margin-top: 10px;">
        <div class="message-box" >
        	<div class="container  border border-dark rounded" style="padding-top: 15px; padding-left: 20px; background-color: #FFF2ED;">
	        <p><label style="font-weight: bold;">Question ID : &nbsp; <?=$search_show['qid']; ?> </label><br>
	        <label style="color: #399E1C;">Question : <?=$x;?>. &nbsp; <?=$search_show['question']; ?> </label><br>
			<label>1.&nbsp; </label><?=$search_show['op1']; ?><br>
	        <label>2.&nbsp; </label><?=$search_show['op2']; ?><br>
	        <label>3.&nbsp; </label><?=$search_show['op3']; ?><br>
	        <label>4.&nbsp; </label><?=$search_show['op4']; ?><br>
	        <label style="color: green;">Answer :&nbsp; <?=$search_show['answer']; ?> </label></p> 
	    	</div>
        </div> 
    </div>
    <div class="col-lg-1">
        <a href="view_question_paper.php?delete=<?=$search_show['qid'];?>&&show=<?=$subject;?>&&qpid=<?=$quopid;?>" style="color:red; font-size: 20px;">Delete</a>
    </div>
    <hr>
    <?php endwhile; ?>
 </div>
</div>
<?php	
}

// Insert the questions in question paper
else
{
	$tq_sql=mysqli_query($cnp,"select totalquestion from qpaper where qpid='$quopid'");
	$qp_totalquestion=mysqli_fetch_assoc($tq_sql);
	$totalquestions=$qp_totalquestion['totalquestion'];
	// echo $totalquestions.'<br>';
	$gsql=mysqli_query($cnp,"SELECT qid from qbank WHERE subject='$subject' and status=0  order by rand() limit $totalquestions");
	$datas=array();
	$insert_sql="";
	$qid_qpid="";
	while($questionsid=mysqli_fetch_array($gsql)){
		$datas[]=$questionsid;
	}
	foreach ($datas as $data) {
		$qid_qpid=$data['qid'];
		// echo $qid_qpid.'<br>';
		$in_sql="INSERT INTO `qpid_qid_mapping`(`srno`, `qpid`, `qid`) VALUES (NULL,'$quopid',$qid_qpid)";
		$insert_sql=mysqli_query($cnp,$in_sql);

		$up_sql="UPDATE `qbank` SET `qpid`='$quopid',`status`=1 WHERE qid=$qid_qpid";
		$update_sql=mysqli_query($cnp,$up_sql);

		}
	$sqlqid2=mysqli_query($cnp,"SELECT qbank.qid,qbank.supporting_img,qbank.question,qbank.op1,qbank.op2,qbank.op3,qbank.op4,qbank.answer,qpid_qid_mapping.qid from qbank,qpid_qid_mapping where qbank.qid=qpid_qid_mapping.qid and qpid_qid_mapping.qpid='$quopid'");
?>
<div class="container">
	<div class="row align-items-center border border-primary">
    <?php 
    $y=0;
    while($search_show2=mysqli_fetch_assoc($sqlqid2)): 
    	$y++;
    	?>
    <div class="col-lg-4 float-lg-left" style="padding-top: 10px; padding-bottom: 10px; ">
        <?php echo '<img src="data:image;base64,'.base64_encode($search_show2['supporting_img']).'" alt="No Supporting Image" style="width:330px; height:290px;" class="rounded" name="paper_image">'  ;?>
    </div>
    <div class="col-lg-7" style="margin-top: 10px; margin-bottom: 10px;">
        <div class="message-box" >
        	<div class="container  border border-dark rounded" style="padding-top: 15px; padding-left: 20px; background-color: #FFF2ED;">
	        <p><label style="font-weight: bold;">Question ID : &nbsp; <?=$search_show2['qid']; ?> </label><br>
	        <label style="color: #399E1C;">Question : <?=$y;?>. &nbsp; <?=$search_show2['question']; ?> </label><br>
			<label>1.&nbsp; </label><?=$search_show2['op1']; ?><br>
	        <label>2.&nbsp; </label><?=$search_show2['op2']; ?><br>
	        <label>3.&nbsp; </label><?=$search_show2['op3']; ?><br>
	        <label>4.&nbsp; </label><?=$search_show2['op4']; ?><br></p>
	        <p style="color: green;"><label>Answer :&nbsp; <?=$search_show2['answer']; ?> </label></p> 
	    	</div>
        </div> 
    </div>
    <div class="col-lg-1">
        <a href="view_question_paper.php?delete=<?=$search_show2['qid']; ?>&&show=<?=$subject;?>&&qpid=<?=$quopid;?>" style="color:red; font-size: 20px;">Delete</a>
    </div>
    <hr>
    <?php endwhile; ?>
 </div>
</div>
<?php
}

// $sql_tquestions=mysqli_query($cnp,"select totalquestion from qpaper where qpid='$quopid'");

// $qp_details=mysqli_fetch_assoc($sqlqp);
?>
<?php include 'includes/footer.php'; ?>