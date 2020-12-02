 <?php
require_once 'includes/cnpariksha.php'; 
$email=$_COOKIE['wdb_email'];
$streamcategory=$_POST['streamcategory'];
$streamname=$_POST['streamname'];
$subject=$_POST['subject'];
$chapter=$_POST['chapter'];
$section=$_POST['section'];
$selected=$_POST['selected1'];
$search_sql="SELECT qid,question,op1,op2,op3,op4,answer,supporting_img from qbank where email='$email' AND (streamcategory='$streamcategory' OR streamname='$streamname' OR subject='$subject' OR chapter='$chapter' OR section='$section')";
$ssql6=mysqli_query($cnp,$search_sql);
$search_numrows= mysqli_num_rows($ssql6);
ob_start();
?>
<h1 style="font-family: sans-serif; color: #076cb0;">Showing results : - </h1>
<div class="row align-items-center border border-primary">
    <?php 
    $n=0;
    while($search_show=mysqli_fetch_assoc($ssql6)): 
        $n++;
        ?>
    <div class="col-lg-4 float-lg-left" style="padding-top: 10px; padding-bottom: 10px;">
        <?php echo '<img src="data:image;base64,'.base64_encode($search_show['supporting_img']).'"  alt="Image not uploaded yet" style="width:310px; height:250px; " class="rounded" name="paper_image">'  ;?>
    </div>
    <div class="col-lg-7 " style="margin-top: 10px;">
        <div class="message-box">
            <div class="container  border border-dark rounded" style="padding-top: 15px; padding-left: 20px; background-color: #FFF2ED;">
                <p><label style="font-weight: bold;">Question ID : &nbsp;<?=$search_show['qid']; ?> </label><br>
                <label style="color: #399E1C;">Question : <?=$n;?>. <?=$search_show['question']; ?></label><br>
                <label>1.&nbsp; </label><?=$search_show['op1']; ?><br>
                <label>2.&nbsp; </label><?=$search_show['op2']; ?><br>
                <label>3.&nbsp; </label><?=$search_show['op3']; ?><br>
                <label>4.&nbsp; </label><?=$search_show['op4']; ?><br>
                <label style="color: green;">Answer :&nbsp; <?=$search_show['answer']; ?></label></p> 
            </div>
        </div> 
    </div>
    <div class="col-lg-1">
        <a href="question_bank.php?edit=<?=$search_show['qid']; ?>" style="width: 30px; color: green; font-size: 30px;">Edit</a>
    </div>
    <hr>
    <?php endwhile; ?>
 </div>

<?php echo ob_get_clean();?>