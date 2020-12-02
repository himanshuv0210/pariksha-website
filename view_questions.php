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
$streamcategory=((isset($_POST['streamcategory']) && $_POST['streamcategory']!='')?sanitize($_POST['streamcategory']):'');
$streamname=((isset($_POST['streamname']) && $_POST['streamname']!='')?sanitize($_POST['streamname']):'');
$subject=((isset($_POST['subject']) && $_POST['subject']!='')?sanitize($_POST['subject']):'');
$chapter=((isset($_POST['chapter']) && $_POST['chapter']!='')?sanitize($_POST['chapter']):'');
$section=((isset($_POST['section']) && $_POST['section']!='')?sanitize($_POST['section']):'');
$ssql1=mysqli_query($cnp,"select DISTINCT(`streamcategory`) as streamcat from qbank");
$ssql2=mysqli_query($cnp,"select DISTINCT(`streamname`) as sname from qbank");
$ssql3=mysqli_query($cnp,"select DISTINCT(`subject`) as sub from qbank");
$ssql4=mysqli_query($cnp,"select DISTINCT(`chapter`) as chapters from qbank");
$ssql5=mysqli_query($cnp,"select DISTINCT(`section`) as sections from qbank");
?>
<div class="container" style="background-color: #076cb0;">
<h2 class="text-center p-3 mb-4" style="color: white; font-family: sans-serif; padding-top: 30px;">View Question</h2>
</div>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data" class="form-inline">
    	<div class="form-group col-lg-6" style="margin-bottom: 20px;">   
            <label for="streamcategory" style="font-size: 20px;">Stream Category : </label> &nbsp;
            <select class="form-control" id="streamcategory" name="streamcategory" style="width: 530px;" required>
            <option value=""<?=(($streamcategory=='')?' selected':''); ?>>Select your choice</option>
            <?php while ($unique_streamcat=mysqli_fetch_assoc($ssql1)): ?>
            <option value="<?=$unique_streamcat['streamcat'];?>"<?=(($streamcategory==$unique_streamcat['streamcat'])?'':''); ?>> <?=$unique_streamcat['streamcat'];?></option>     
            <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group col-lg-6" style="margin-bottom: 20px;">   
            <label for="streamname" style="font-size: 20px;">Stream Name : </label> &nbsp;
            <select class="form-control" id="streamname" name="streamname" style="width: 530px;" required >
            <option value=""<?=(($streamname=='')?' selected':''); ?>>Select your choice</option>    
            <?php while ($unique_sname=mysqli_fetch_assoc($ssql2)):  ?>
           	<option value="<?=$unique_sname['sname'];?>"<?=(($streamname==$unique_sname['sname'])?'':''); ?>> <?=$unique_sname['sname'];?></option> 	       
	        <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group col-lg-4" style="margin-bottom: 20px;">   
            <label for="subject" style="font-size: 20px;">Subject : </label> &nbsp;
            <select class="form-control" id="subject" name="subject" style="width: 365px;" required onchange="other()">
            <option value=""<?=(($subject=='')?' selected':''); ?>>Select your choice</option>
            <?php while ($unique_sub=mysqli_fetch_assoc($ssql3)): ?>
            	<option value="<?=$unique_sub['sub'];?>"<?=(($subject==$unique_sub['sub'])?'':''); ?>> <?=$unique_sub['sub'];?></option>
	        <?php endwhile; ?>    
            </select>
        </div>
        <div class="form-group col-lg-4" style="margin-bottom: 20px;">   
            <label for="chapter" style="font-size: 20px;">Chapter : </label> &nbsp;
            <select class="form-control" id="chapter" name="chapter" style="width: 365px;" required>
            <option value=""<?=(($chapter=='')?' selected':''); ?>>Select your choice</option>  
            <?php while ($unique_chapter=mysqli_fetch_assoc($ssql4)): ?>
            	<option value="<?=$unique_chapter['chapters'];?>"<?=(($chapter==$unique_chapter['chapters'])?'':''); ?>> <?=$unique_chapter['chapters'];?></option>
	        <?php endwhile; ?> 
            </select>
        </div>
        <div class="form-group col-lg-4" style="margin-bottom: 20px;">   
            <label for="section" style="font-size: 20px;">Section : </label> &nbsp;
            <select class="form-control" id="section" name="section" style="width: 365px;" required>
            <option value=""<?=(($section=='')?' selected':''); ?>>Select your choice</option>
            <?php while ($unique_section=mysqli_fetch_assoc($ssql5)): ?>
            	<option value="<?=$unique_section['sections'];?>"<?=(($section==$unique_section['sections'])?'':''); ?>> <?=$unique_section['sections'];?></option>
	        <?php endwhile; ?>    
            </select>
        </div>
</form>
</div>
<div class="p-3 mb-4">
	<div class="text-center">
	    <a href="teacher_dashboard.php" class="btn btn-danger">Back</a>
	</div>
</div>
<div class="container" id="results">
</div>

<?php 
if(isset($_GET['show']))
{
    $email2=$_COOKIE['wdb_email'];
    $sub=$_GET['show'];
    $view_sql="SELECT qid,question,op1,op2,op3,op4,answer,supporting_img from qbank where email='$email2' and subject='$sub' order by qid DESC";
    $ssql7=mysqli_query($cnp,$view_sql);
    $view_count=mysqli_num_rows($ssql7);
    ?>
    <div class="container">
    <div class="row align-items-center border border-primary">
    <?php while($view_show=mysqli_fetch_assoc($ssql7)): ?>
    <div class="col-lg-4 float-lg-left" style="padding-top: 10px; padding-bottom: 10px;">
        <?php echo '<img src="data:image;base64,'.base64_encode($view_show['supporting_img']).'"  alt="Image not uploaded yet" style="width:310px; height:250px; " class="rounded" name="paper_image">'  ;?>
    </div>
    <div class="col-lg-8" style="margin-top: 10px;">
        <div class="message-box" >
            <div class="container  border border-dark rounded" style="padding-top: 15px; padding-left: 20px; background-color: #FFF2ED;">  
                <p><label style="font-weight: bold;">Question ID : &nbsp; </label><?=$view_show['qid']; ?><br>
                <label style="color: #399E1C;">Question : &nbsp; </label><?=$view_show['question']; ?><br>
                <label>1.&nbsp; </label><?=$view_show['op1']; ?><br>
                <label>2.&nbsp; </label><?=$view_show['op2']; ?><br>
                <label>3.&nbsp; </label><?=$view_show['op3']; ?><br>
                <label>4.&nbsp; </label><?=$view_show['op4']; ?></p>
                <p><label style="color: green;">Answer :&nbsp; </label><?=$view_show['answer']; ?></p> 
            </div>
        </div> 
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
<script>
    jQuery('document').ready(function(){
        get_results('<?=$streamcategory; ?>','<?=$streamname; ?>','<?=$subject; ?>','<?=$chapter; ?>','<?=$section; ?>');
    });
</script>