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
include("includes/header.php");
echo '<br><br><br>';
echo '<br><br><br>'; 
$email=$_COOKIE['wdb_email'];
?>
<?php include 'includes/profile_header.php' ?>
<br>
<div class="container" style="background-color: #076cb0;">
<h2 class="text-center p-3 mb-4" style="color: white; font-family: sans-serif; padding-top: 30px;">Question Paper</h2>
</div>
<div class="container">
<table id="example" class="table table-bordered table-condensed table-striped table-hover table-fixed" style="color: black;">
 <thead class="bg-primary" style="color: white;"><th>#</th><th>Question Paper Id</th><th>Description</th><th class="text-center">Total no. of Questions</th><th class="text-center">Question Paper Password</th><th class="text-center">View Question Paper</th></thead>
        <tbody>
        	<?php 
                 $qsql="select * from qpaper where email='$email' order by createdts DESC";
                 $qres=mysqli_query($cnp,$qsql);
                 $x=0;
                while($qpaper=mysqli_fetch_assoc($qres)): 
                  $x++;
                  ?>
                <tr class="table-success">
                    <th scope="row"><?=$x;?></th>
                    <td><?php echo $qpaper['qpid']; 
                          $qqppid=$qpaper['qpid'];
                          $_COOKIE['qpid']=$qpaper['qpid'];
                          $sub_question=explode('_',$qpaper['qpid']);
                          $sub_data['sub']=$sub_question[0];
                    $cq_sql=mysqli_query($cnp,"SELECT COUNT(`qid`) as current_questions FROM `qpid_qid_mapping` WHERE qpid='$qqppid'");
                          $current_questions=mysqli_fetch_assoc($cq_sql);
                          $added_questions=$current_questions['current_questions'];

                    ?></td>
                    <td><?=$qpaper['description']; ?></td>
                    <td class="text-center"><?=$added_questions;?> / <?=$qpaper['totalquestion']; ?></td>
                    <td class="text-center"><?=$qpaper['password']; ?></td>
                    <td class="text-center">
                        <!-- View Your Question  paper-->
                        <a href="view_question_paper.php?show=<?php echo $sub_data['sub']; ?>&&qpid=<?=$_COOKIE['qpid'];?>" style="color:blue;width: 72px;">View</a>
                        <!-- Create your Question paper-->
                        <!-- <a href="create_question_paper.php?create=<?=$qpaper['qpid']; ?>" class="btn btn-xs btn-danger">Create</a> -->
                    </td>
                </tr>
                <?php endwhile; ?>
        </tbody>
</table>
<div class="p-3 mb-4">
	<div class="text-center">
	    <a href="teacher_dashboard.php" class="btn btn-danger">Back</a>
	</div>
</div>
</div>
<?php include 'includes/footer.php'; ?>