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
$total_question=$_GET['tq'];
$des=$_GET['des'];
$sqlqid=mysqli_query($cnp,"SELECT qid,supporting_img,question,op1,op2,op3,op4,answer from qbank where qpid='$test_id'"); 
?>
<br>
<div class="container">
  <form id="quiz" method="post" action="showResult.php?show=<?=$test_id;?>&&tqp=<?=$total_question;?>&&des=<?=$des;?>">
	<div class="row align-items-center border border-primary">
    <?php 
    $x=0;
    while($search_show=mysqli_fetch_assoc($sqlqid)): 
    	$x++;
    	?>
    <div class="col-lg-4 float-lg-left" style="padding-top: 10px; padding-bottom: 10px;">
        <?php echo '<img src="data:image;base64,'.base64_encode($search_show['supporting_img']).'"  alt="No Supporting Image" style="width:330px; height:240px; " class="rounded" name="paper_image">'  ;?>
    </div>
    <div class="col-lg-8" style="margin-top: 5px;">
       <div class="message-box" >
           <div class="container  border border-dark rounded" style="padding-top: 15px; padding-left: 20px; background-color: #FFF2ED;">
	        <p>
    	        <label style="color: #399E1C;">Question : <?=$x;?>. &nbsp; <?=$search_show['question']; ?> </label><br>
    			<label><input type="radio" value="a" name="<?=$search_show['qid']; ?>"> </label>&nbsp; <?=$search_show['op1']; ?><br>
    	        <label><input type="radio" value="b" name="<?=$search_show['qid']; ?>"> </label>&nbsp; <?=$search_show['op2']; ?><br>
    	        <label><input type="radio" value="c" name="<?=$search_show['qid']; ?>"> </label>&nbsp; <?=$search_show['op3']; ?><br>
    	        <label><input type="radio" value="d" name="<?=$search_show['qid']; ?>"> </label>&nbsp; <?=$search_show['op4']; ?><br>
                <input type="radio" hidden checked="checked" value="none" name="<?php echo $search_show['qid']; ?>">
           </p> 
	   </div>
    </div> 
   </div>
    <hr>
    <?php endwhile; ?>
 </div>
  <center>
          <input type="submit" name="submitTest" value="Submit Test" class="btn btn-danger" style="height: 40px; width:300px;">
    </center>
 </form>
</div>
<br>
<br>
<?php include 'includes/footer.php'; ?>