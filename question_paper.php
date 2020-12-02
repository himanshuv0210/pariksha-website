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
$description=((isset($_POST['description']) && $_POST['description']!='')?sanitize($_POST['description']):'');
$totalquestion=((isset($_POST['totalquestion']) && $_POST['totalquestion']!='')?sanitize($_POST['totalquestion']):'');
$password=((isset($_POST['password']) && $_POST['password']!='')?sanitize($_POST['password']):'');
$streamcategory=((isset($_POST['streamcategory']) && $_POST['streamcategory']!='')?sanitize($_POST['streamcategory']):'');
$streamname=((isset($_POST['streamname']) && $_POST['streamname']!='')?sanitize($_POST['streamname']):'');
$subject=((isset($_POST['subject']) && $_POST['subject']!='')?sanitize($_POST['subject']):'');
$chapter=((isset($_POST['chapter']) && $_POST['chapter']!='')?sanitize($_POST['chapter']):'');
$section=((isset($_POST['section']) && $_POST['section']!='')?sanitize($_POST['section']):'');
$keyword=((isset($_POST['keyword']) && $_POST['keyword']!='')?sanitize($_POST['keyword']):'');
$ssql1=mysqli_query($cnp,"select DISTINCT(`streamcategory`) as streamcat from qbank");
$ssql2=mysqli_query($cnp,"select DISTINCT(`streamname`) as sname from qbank");
$ssql3=mysqli_query($cnp,"select DISTINCT(`subject`) as sub from qbank");
$ssql4=mysqli_query($cnp,"select DISTINCT(`chapter`) as chapters from qbank");
$ssql5=mysqli_query($cnp,"select DISTINCT(`section`) as sections from qbank");
?>
<?php include 'includes/profile_header.php' ?>
<br>
<div class="container" style="background-color: #076cb0;">
<h2 class="text-center p-3 mb-4" style="color: white; font-family: sans-serif; padding-top: 0px;">Create Question Paper</h2>
</div>
<br>
<h2 class="container" style="color: #076cb0; font-family: sans-serif; ">1 :- Generate Keyword </h2>
<br>
<br>
<div class="container">
    <form action="add_question_paper.php" method="post" enctype="multipart/form-data" class="form-inline">
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
            <select class="form-control" id="streamname" name="streamname" style="width: 530px;" required>
            <option value=""<?=(($streamname=='')?' selected':''); ?>>Select your choice</option>    
            <?php while ($unique_sname=mysqli_fetch_assoc($ssql2)):  ?>
            <option value="<?=$unique_sname['sname'];?>"<?=(($streamname==$unique_sname['sname'])?'':''); ?>> <?=$unique_sname['sname'];?></option>            
            <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group col-lg-4" style="margin-bottom: 20px;">   
            <label for="subject" style="font-size: 20px;">Subject : </label> &nbsp;
            <select class="form-control" id="subject" name="subject" style="width: 365px;" required>
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
        <div class=" form-group col-lg-6" style="margin-bottom: 20px;">
            <label for="email" style="font-size: 20px;">Email :</label> &nbsp;
            <input type="text" name="email" class="form-control" id="email" value="<?=$email; ?>" size="55" readonly>
        </div> 
        <div class=" form-group col-lg-6"   style="margin-bottom: 20px;">
            <label for="keyword" style="font-size: 20px;">Keyword :</label> &nbsp;
            <div id="keyword">
            </div>
        </div>  
        <div class="form-group col-lg-4" style="margin-bottom: 20px;">
            <label for="description" style="font-size: 20px;">Descriptions :</label>
            <input type="text" name="description" class="form-control" id="description" value="<?=$description; ?>" size="35" required>
        </div>
        &nbsp; &nbsp; &nbsp; 
        <div class="form-group col-lg-3" style="margin-bottom: 20px;">
            <label for="totalquestion" style="font-size: 20px;">Total Questions :</label>
            <input type="number" name="totalquestion" class="form-control" id="totalquestion" value="<?=$totalquestion; ?>" max="100" required>
        </div>
        <div class="form-group col-lg-4" style="margin-bottom: 20px;">
            <label for="password" style="font-size: 20px;">Password :</label>
            <input type="text" name="password" class="form-control" id="password" 
            value="<?=$password; ?>" size="42">
        </div>
        <br>  
        <div class="p-3 mb-4">
        	<div class="text-center">
	            <input type="reset" name="cancel" class="btn btn-primary">
	            &nbsp; &nbsp;
	            <input type="submit" name="submit" value="Submit" class="btn btn-success">
	            &nbsp; &nbsp;
	            <a href="teacher_dashboard.php" class="btn btn-danger">Cancel</a> &nbsp; &nbsp;
                <a href="manage_question_paper.php" class="btn btn-info" id="add-subject-btn"> View Question Paper</a>
        	</div>
        </div>
        <div class="clearfix"></div>
    </form>
  <br>
</div>

<?php  
include 'includes/footer.php';
?>
<script>
    jQuery('document').ready(function(){
        get_child_options('<?=$streamcategory; ?>','<?=$streamname; ?>','<?=$subject; ?>','<?=$chapter; ?>','<?=$section; ?>');
        //updateSizes();
    });
</script>