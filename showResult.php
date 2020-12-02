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
include 'includes/header.php';
echo '<br><br><br>';
echo '<br><br><br>';

$test_id=$_GET['show'];
$email=$_COOKIE['wdb_email'];
$total_question=$_GET['tqp'];
$des=$_GET['des'];
$right=0;
$wrong=0;
$no_attempt=0;
$total=0;
$query=mysqli_query($cnp,"SELECT * from qbank where qpid='$test_id'"); 
$result=mysqli_fetch_all($query, MYSQLI_ASSOC);
if(isset($_POST['submitTest']))
{
	foreach ($result as $res) 
	{
	  if($_POST[$res['qid']]==$res['answer']){
	    $right++;
	  }else if($_POST[$res['qid']]=='none'){
	    $no_attempt++;
	  }else{
	    $wrong++;
	  }
	}
$total=$right+$wrong+$no_attempt;
$score=($right*100)/($total);

mysqli_query($cnp,"INSERT INTO `mstexam`(`examid`, `email`, `startts`, `totalquestion`,`description`, `qpid`) VALUES(NULL,'$email',CURRENT_TIMESTAMP,'$total_question','$des','$test_id')" );

$ch="INSERT INTO `exam_result`(`resultid`, `email`, `qpid`, `correct_ans`, `wrong_ans`,`qnotattempted`, `marks`, `endtime`) VALUES (NULL,'$email','$test_id','$right','$wrong','$no_attempt','$score',CURRENT_TIMESTAMP)";

mysqli_query($cnp,$ch);

$temp_query=mysqli_query($cnp,"SELECT * FROM exam_result ORDER BY resultid DESC LIMIT 1");
$temp_result=mysqli_fetch_array($temp_query, MYSQLI_ASSOC);
$result_id=$temp_result['resultid'];
}
  unset($test_id);
?>
<a href="student_dashboard.php" class="btn btn-success" id="add-subject-btn">Back to Dashboard</a>
<div class="container" style="background-color: #076cb0;">
<h2 class="text-center p-3 mb-4" style="color: white; font-family: sans-serif; padding-top: 30px;">Test Results</h2>
</div>
<div class="container" style="margin-top:10px;">
  <table class="table table-bordered table-condensed table-striped">
    <thead class="bg-primary" style="color: white;">
      <tr>
        <th>Total Questions</th>
        <th>Correct Answers</th>
        <th>Wrong Answers</th>
        <th>Not Attempted</th>
        <th>Score</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><h1><?php echo $total; ?></h1></td>
        <td><h1><?php echo $right; ?></h1></td>
        <td><h1><?php echo $wrong; ?></h1></td>
        <td><h1><?php echo $no_attempt; ?></h1></td>
        <td><h1><?php echo number_format((float) $score,2, '.', '').' %'; ?></h1></td>
      </tr>
    </tbody>
  </table><br><br>
</div>
<br>
<?php include 'includes/footer.php'; ?>