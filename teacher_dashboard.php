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
if(isset($_GET['delete']))
{
    $did=sanitize($_GET['delete']);
    $dsql="DELETE FROM `qbank` WHERE `qbank`.`qid` = '$did'";
    mysqli_query($cnp,$dsql);
    ?>
    <script>
        alert("Question Deleted successfully");
        location.href="teacher_dashboard.php";
    </script> <?php
}
$csql="SELECT DISTINCT(subject),COUNT(`question`) as totalquestion from qbank WHERE email='$email' GROUP BY subject";
$run_csql=mysqli_query($cnp,$csql);

$csql2="SELECT DISTINCT(subject),COUNT(`question`) as totalquestion from qbank WHERE email='$email' GROUP BY subject";
$run_csql2=mysqli_query($cnp,$csql2);

// $subsql="select * from qpaper where email='$email' ";
// $subres=mysqli_query($cnp,$subsql);
// $subpaper=mysqli_fetch_assoc($subres);
// $sub_question=explode('_',$subpaper['qpid']);
// $sub_data['sub']=$sub_question[0];
// $totalquestion_subject=mysqli_fetch_assoc($run_csql);
?>
<br>
<?php include 'includes/profile_header.php'; ?>
<br>
<div class="border border-light p-3 mb-4">
    <div class="text-center">
        <a href="add_question_bank.php" class="btn btn-primary" id="add-subject-btn">Add Question</a> &nbsp;
        <a href="view_questions.php" class="btn btn-warning" id="add-subject-btn">View Questions</a> &nbsp;
        <a href="question_paper.php" class="btn btn-secondary" id="add-subject-btn">Create Question Paper</a> &nbsp;
        <a href="manage_question_paper.php" class="btn btn-success" id="add-subject-btn"> View Question Paper</a>
    </div>
</div>
<br>
<div class="container">
    <h2 class="container" style="color: #076cb0; font-family: sans-serif; ">1 :- Total number of question subject wise </h2>
<table  class="table table-bordered table-condensed table-striped table-fixed">
    <thead class="bg-primary" style="color: white;">
        <th>#</th><th>Subject</th><th>Total Questions in Subject</th><th>View</th>
            <tbody> 
                <?php 
                $x=0;
                while ($totalquestion_subject=mysqli_fetch_assoc($run_csql)):
                    $x++;
                    ?> <tr class="table-success">
                        <th scope="row"><?=$x;?></th>
                        <td><?=$totalquestion_subject['subject']; ?></td>
                        <td><?=$totalquestion_subject['totalquestion']; ?></td>
                        <td>
                            <a href="view_subject_question.php?show=<?php echo $totalquestion_subject['subject']; ?>" style="color:blue;width: 72px;">View</a>
                        </td>
                    </tr> 
                <?php endwhile; ?>
            </tbody>
    </thead>
</table>
</div>
<br>
<br>

<script>
    $(document).ready(function() {
    $('#example').DataTable();
    } );
</script>
<br>
<?php 
include 'includes/footer.php';
?>