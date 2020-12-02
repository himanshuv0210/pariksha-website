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
$gsql=mysqli_query($cnp,"SELECT qid,question,op1,op2,op3,op4 from qbank WHERE subject='$subject' order by rand() limit 30");
$quopid=$_GET['qpid'];
$sqlqp=mysqli_query($cnp,"select * from qpaper where qpid='$quopid'");
$qp_details=mysqli_fetch_assoc($sqlqp);
?>
<?php 
include 'includes/profile_header.php' ?>
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
    <td>Total Question : <?=$qp_details['totalquestion'];?></td>
    <td></td>
  </tr>
</table>
</div>
<div class="row col-lg-12">
  <div class="col-lg-6">
	<table class="table table-bordered table-condensed table-striped table-hover table-fixed" style="color: black; display: block; overflow-y: auto; height: 600px; ">
	 <thead class="bg-primary" style="color: white;"><th class="text-center">Question Id</th><th class="text-center">Question</th><th class="text-center">Option 1</th><th class="text-center">Option 2</th><th class="text-center">Option 3</th><th class="text-center">Option 4</th><th class="text-center">Delete Question</th></thead>
	 <tbody>
	 	<?php while($questions=mysqli_fetch_assoc($gsql)): ?>
                <tr class="table-success">
                    <td class="text-center"><?php echo $questions['qid']; ?></td>
                    <td><?=$questions['question']; ?></td>
                    <td><?=$questions['op1']; ?></td>
                    <td><?=$questions['op2']; ?></td>
                    <td><?=$questions['op3']; ?></td>
                    <td><?=$questions['op4']; ?></td>
                    <td>
                        <!--delete your Question-->
                        <a href="create_question_paper.php?del=<?=$subject; ?>" class="btn btn-xs btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>	 	
	 </tbody>
	</table>
 </div>
 <div class="col-lg-6">
   jghgghg

 </div>
</div>
<div class="p-3 mb-4">
  <div class="text-center">
      <a href="manage_question_paper.php" class="btn btn-danger">Back</a>
  </div>
</div>
<?php include 'includes/footer.php'; ?>