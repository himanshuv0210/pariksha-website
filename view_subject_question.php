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
?>
<?php include 'includes/profile_header.php'; 
if(isset($_GET['show']))
{
	$email2=$_COOKIE['wdb_email'];
	$sub=$_GET['show'];
    $view_sql="SELECT qid,question,op1,op2,op3,op4,answer,supporting_img from qbank where email='$email2' and subject='$sub' order by qid DESC";
    $ssql7=mysqli_query($cnp,$view_sql);
    $view_count=mysqli_num_rows($ssql7);
    ?>
    <br>
    <div class="container text-center " style="background-color: #076cb0;">
    	<h2 class="text-center p-3" style="color: white; font-family: sans-serif; ">Questions </h2>
		<table class="table table-borderless table-condensed table-striped" style="color: white; font-family: sans-serif;">
			<tr>
    			<td style="font-size: 25px;">Subject : <?=$sub;?></td>
    			<td><a href="view_questions.php" class="btn btn-success" id="add-subject-btn">Search Question</a></td>
    		</tr>	
		</table>	
    </div>
    <br>
    <div class="container">
    <div class="row align-items-center border border-primary">
    <?php 
    $x=0;
    while($view_show=mysqli_fetch_assoc($ssql7)): 
    	$x++;
    	?>
    <div class="col-lg-4 float-lg-left" style="padding-top: 10px; padding-bottom: 10px;">
        <?php echo '<img src="data:image;base64,'.base64_encode($view_show['supporting_img']).'"  alt="Image not uploaded yet" style="width:310px; height:250px; " class="rounded" name="paper_image">'  ;?>
    </div>
    <div class="col-lg-7" style="margin-top: 10px;">
        <div class="message-box" >
            <div class="container  border border-dark rounded" style="padding-top: 15px; padding-left: 20px; background-color: #FFF2ED;">  
                <p><label style="font-weight: bold;">Question ID : &nbsp;<?=$view_show['qid']; ?> </label><br>
                <label style="color: #399E1C;">Question : <?=$x;?>. <?=$view_show['question']; ?> </label><br>
                <label>1.&nbsp; </label><?=$view_show['op1']; ?><br>
                <label>2.&nbsp; </label><?=$view_show['op2']; ?><br>
                <label>3.&nbsp; </label><?=$view_show['op3']; ?><br>
                <label>4.&nbsp; </label><?=$view_show['op4']; ?></p>
                <p><label style="color: green;">Answer :&nbsp; <?=$view_show['answer']; ?> </label></p> 
            </div>
        </div> 
    </div>
    <div class="col-lg-1">
        <a href="question_bank.php?edit=<?=$view_show['qid']; ?>" style="width: 30px; color: green; font-size: 30px;">Edit</a>
    </div>
    <hr>
    <?php endwhile; ?>
 </div>
</div>
<?php 
unset($_GET['show']);
}
?>
<?php 
include 'includes/footer.php';
?>