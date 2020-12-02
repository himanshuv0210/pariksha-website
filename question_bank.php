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
// $qpimage=$qpeid['supporting_img'];
if(isset($_GET['add']) || isset($_GET['edit']) || isset($_POST['submit']))
{
	$stream_category=((isset($_POST['stream_category']) && $_POST['stream_category']!='')?sanitize($_POST['stream_category']):'');
    $stream_name=((isset($_POST['stream_name']) && $_POST['stream_name']!='')?sanitize($_POST['stream_name']):'');
    $subject=((isset($_POST['subject']) && $_POST['subject']!='')?sanitize($_POST['subject']):'');
    $chapter=((isset($_POST['chapter']) && $_POST['chapter']!='')?sanitize($_POST['chapter']):'');
    $section=((isset($_POST['section']) && $_POST['section']!='')?sanitize($_POST['section']):'');
    $question=((isset($_POST['question']) && $_POST['question']!='')?sanitize($_POST['question']):'');
    $question_type=((isset($_POST['question_type']) && $_POST['question_type']!='')?sanitize($_POST['question_type']):'');
    $op1=((isset($_POST['op1']) && $_POST['op1']!='')?sanitize($_POST['op1']):'');
    $op2=((isset($_POST['op2']) && $_POST['op2']!='')?sanitize($_POST['op2']):'');
    $op3=((isset($_POST['op3']) && $_POST['op3']!='')?sanitize($_POST['op3']):'');
    $op4=((isset($_POST['op4']) && $_POST['op4']!='')?sanitize($_POST['op4']):'');
    $answer=((isset($_POST['answer']) && $_POST['answer']!='')?sanitize($_POST['answer']):'');
        
    // If request for Edit a question 
    if(isset($_GET['edit']))
    {
        $edit_id=(int)$_GET['edit'];
        $proresults=mysqli_query($cnp,"select * from qbank where qid='$edit_id'");
        $subject1=mysqli_fetch_assoc($proresults);
        $stream_category=((isset($_POST['stream_category']) && $_POST['stream_category']!='')?sanitize($_POST['stream_category']):$subject1['streamcategory']);
        $stream_name=((isset($_POST['stream_name']) && $_POST['stream_name']!='')?sanitize($_POST['stream_name']):$subject1['streamname']);
        $subject=((isset($_POST['subject']) && $_POST['subject']!='')?sanitize($_POST['subject']):$subject1['subject']);
        $chapter=((isset($_POST['chapter']) && $_POST['chapter']!='')?sanitize($_POST['chapter']):$subject1['chapter']);
        $section=((isset($_POST['section']) && $_POST['section']!='')?sanitize($_POST['section']):$subject1['section']);
        $question=((isset($_POST['question']) && $_POST['question']!='')?sanitize($_POST['question']):$subject1['question']);
        $question_type=((isset($_POST['question_type']) && $_POST['question_type']!='')?sanitize($_POST['question_type']):$subject1['questiontype']);
        $op1=((isset($_POST['op1']) && $_POST['op1']!='')?sanitize($_POST['op1']):$subject1['op1']);
    	$op2=((isset($_POST['op2']) && $_POST['op2']!='')?sanitize($_POST['op2']):$subject1['op2']);
    	$op3=((isset($_POST['op3']) && $_POST['op3']!='')?sanitize($_POST['op3']):$subject1['op3']);
    	$op4=((isset($_POST['op4']) && $_POST['op4']!='')?sanitize($_POST['op4']):$subject1['op4']);
    	$answer=((isset($_POST['answer']) && $_POST['answer']!='')?sanitize($_POST['answer']):$subject1['answer']);
    }
   
   // If request for Adding new Question
   if($_POST)
    {
        if (is_uploaded_file($_FILES['userImage']['tmp_name']))
        {
            $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
            $email=$_COOKIE['wdb_email'];

        // Add a new Question in table
        $sql11="INSERT INTO `qbank`(`qid`, `email`, `streamcategory`, `streamname`, `subject`, `chapter`, `section`, `question`, `questiontype`, `supporting_img`, `op1`, `op2`, `op3`, `op4`, `answer`, `createdts`) VALUES (NULL,'$email','$stream_category','$stream_name','$subject','$chapter', '$section','$question','$question_type','{$imgData}','$op1','$op2','$op3','$op4','$answer',CURRENT_TIMESTAMP)";

            // Edit or do changes in exist question 
            if(isset($_GET['edit']))
            {
            $sql11="UPDATE `qbank` SET `email`='$email',`streamcategory`='$stream_category',`streamname`='$stream_name',`subject`='$subject',`chapter`='$chapter',`section`='$section',`question`='$question',`questiontype`='$question_type',`op1`='$op1',`op2`='$op2',`op3`='$op3',`op4`='$op4',`answer`='$answer',`supporting_img`='{$imgData}' WHERE qid='$edit_id'";
            }
            
            $rsql=mysqli_query($cnp,$sql11);
            if($rsql>0)
            {
                ?>
                <script>
                    alert("Question saved successfully");
                    location.href="teacher_dashboard.php";
                </script> <?php  
            }
            else
            {
                ?>
                <script>
                    alert("Error in query <br> <?=$sql11;?>");
                    location.href="teacher_dashboard.php";
                </script> <?php  
            }
        }       

        else
        {
            // $qimage_data=
            $email=$_COOKIE['wdb_email'];

        // Add a new Question in table
            $sql11="INSERT INTO `qbank`(`qid`, `email`, `streamcategory`, `streamname`, `subject`, `chapter`, `section`, `question`, `questiontype`, `supporting_img`, `op1`, `op2`, `op3`, `op4`, `answer`, `createdts`) VALUES (NULL,'$email','$stream_category','$stream_name','$subject','$chapter', '$section','$question','$question_type','NULL','$op1','$op2','$op3','$op4','$answer',CURRENT_TIMESTAMP)";

            // Edit or do changes in exist question 
            if(isset($_GET['edit']))
            {
            $sql11="UPDATE `qbank` SET `email`='$email',`streamcategory`='$stream_category',`streamname`='$stream_name',`subject`='$subject',`chapter`='$chapter',`section`='$section',`question`='$question',`questiontype`='$question_type',`op1`='$op1',`op2`='$op2',`op3`='$op3',`op4`='$op4',`answer`='$answer' WHERE qid='$edit_id'";
            }
            
            $rsql=mysqli_query($cnp,$sql11);
            if($rsql>0)
            {
                ?>
                <script>
                    alert("Question saved successfully");
                    location.href="teacher_dashboard.php";
                </script> <?php  
            }
            else
            {
                ?>
                <script>
                    alert("Error in query <br> <?=$sql11;?>");
                    location.href="teacher_dashboard.php";
                </script> <?php  
            }
        }
    }
}
?>
<?php include 'includes/profile_header.php' ?>
<br>
<div class="container" style="background-color: #076cb0;">
<h2 class="text-center p-3 mb-4" style="color: white; font-family: sans-serif; padding-top: 30px;"><?=((isset($_GET['edit']))?'Edit ':'Add A New '); ?>Question</h2>
</div>
<div class="container">
    <form action="question_bank.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1'); ?>" method="post" enctype="multipart/form-data" class="form-inline">
        <div class=" form-group col-lg-3" style="margin-bottom: 20px;">
            <label for="email" style="font-size: 20px;">Email :</label>
            <input type="text" name="email" class="form-control" id="email" value="<?=$email; ?>" readonly>
        </div>	
        <div class="form-group col-lg-3" style="margin-bottom: 20px;">
            <label for="stream_category" style="font-size: 20px;">Stream Category:</label>
            <select class="form-control" id="stream_category" name="stream_category" style="width: 220px;" required>
            <option value=""<?=(($stream_category=='')?' selected':''); ?>>Select your choice</option>    
            <option value="IT"<?=(($stream_category=='IT')?' selected':''); ?>>IT</option>
            <option value="SE"<?=(($stream_category=='SE')?' selected':''); ?>>SE</option>

        </select>
        </div>
        <div class="form-group col-lg-3" style="margin-bottom: 20px;">
            <label for="stream_name" style="font-size: 20px;">Stream Name:</label>

            <select class="form-control" id="stream_name" name="stream_name" style="width: 365px;" required>
                <option value=""<?=(($stream_name=='')?' selected':''); ?>>Select your choice</option>
                <option value="CS"<?=(($stream_name=='CS')?' selected':''); ?>>CS</option>
            </select>

        </div>
        <div class="form-group col-lg-3" style="margin-bottom: 20px;">
            <label for="subject" style="font-size: 20px;">Subject:</label>
            <select class="form-control" id="subject" name="subject" style="width: 220px;" required>
                 <option value=""<?=(($subject=='')?' selected':''); ?>>Select your choice</option>
                 <?php 
                    $sub_sql="select * from subject";
                    $sub_query=mysqli_query($cnp,$sub_sql);
                    while ($subjects=mysqli_fetch_assoc($sub_query)): 
                        $sub_new=$subjects['subject'];
                 ?>
                    <option value="<?=$sub_new;?>"<?=(($subject=="$sub_new")?' selected':''); ?> > <?=$sub_new;?>
                    </option>
                    <?php endwhile; ?>
            </select>
        </div>
        <br>
        <div class="form-group col-lg-3" style="margin-bottom: 20px;">
            <label for="chapter" style="font-size: 20px;">Chapter: </label>
            <input type="text" name="chapter" class="form-control" id="chapter" value="<?=$chapter;?>" required>
        </div>
        <div class="form-group col-lg-3" style="margin-bottom: 20px;">   
            <label for="section" style="font-size: 20px;">Section: </label>
            <input type="text" id="section" name="section" class="form-control" value="<?=$section;?>" required>
        </div>
        
        <div class="form-group col-lg-6" style="margin-bottom: 20px;">   
            <label for="question_type" style="font-size: 20px;">Question Type: </label>
            <select class="form-control" id="question_type" name="question_type" style="width: 500px;" required>
            <option value=""<?=(($question_type=='')?' selected':''); ?>>Select your choice</option>    
            <option value="MCQ"<?=(($question_type=='MCQ')?' selected':''); ?>>MCQ</option>
            <option value="MCQ(MultipleAnswer)"<?=(($question_type=='MCQ(MultipleAnswer)')?' selected':'');?>>MCQ(MultipleAnswer)</option>
            <option value="Text"<?=(($question_type=='Text')?' selected':''); ?>>Text</option>
            <option value="Yes/No"<?=(($question_type=='Yes/No')?' selected':''); ?>>Yes/No</option>
            </select>
        </div>

        <div class="form-group col-lg-12" style="margin-bottom: 20px;">   
            <label for="question" style="font-size: 20px;">Question: </label>
            <input type="text" id="question" name="question" class="form-control" value="<?=$question;?>" size="124" required>
         </div>
       
        <div class="form-group col-lg-12" style="margin-bottom: 20px;">   
            <label for="op1" style="font-size: 20px;">Option 1: </label>
            <input type="text" id="op1" name="op1" class="form-control" value="<?=$op1;?>" size="124" required>
        </div>
        <div class="form-group col-lg-12" style="margin-bottom: 20px;">   
            <label for="op2" style="font-size: 20px;">Option 2: </label>
            <input type="text" id="op2" name="op2" size="124" class="form-control" value="<?=$op2;?>" required>
        </div>
        <div class="form-group col-lg-12" style="margin-bottom: 20px;">   
            <label for="op3" style="font-size: 20px;">Option 3: </label>
            <input type="text" id="op3" name="op3" size="124" class="form-control" value="<?=$op3;?>" required>
        </div>
        <div class="form-group col-lg-12" style="margin-bottom: 20px;">   
            <label for="op4" style="font-size: 20px;">Option 4: </label>
            <input type="text" id="op4" name="op4" size="124" class="form-control" value="<?=$op4;?>" required>
        </div>

        <div class="form-group col-lg-6" style="margin-bottom: 20px;">   
            <label for="answer" style="font-size: 20px;">Answer : </label>

            <select class="form-control" id="answer" name="answer" style="width: 500px;" required>
                <option value=""<?=(($answer=='')?' selected':''); ?>>Select your choice</option>
                <option value="a"<?=(($answer=='a')?' selected':''); ?>>a</option>
                <option value="b"<?=(($answer=='b')?' selected':''); ?>>b</option>
                <option value="c"<?=(($answer=='c')?' selected':''); ?>>c</option>
                <option value="d"<?=(($answer=='d')?' selected':''); ?>>d</option>
                <option value="ab"<?=(($answer=='ab')?' selected':''); ?>>ab</option>
                <option value="ac"<?=(($answer=='ac')?' selected':''); ?>>ac</option>
                <option value="ad"<?=(($answer=='ad')?' selected':''); ?>>ad</option>
                <option value="bc"<?=(($answer=='bc')?' selected':''); ?>>bc</option>
                <option value="bd"<?=(($answer=='bd')?' selected':''); ?>>bd</option>
                <option value="cd"<?=(($answer=='cd')?' selected':''); ?>>cd</option>
                <option value="abc"<?=(($answer=='abc')?' selected':''); ?>>abc</option>
                <option value="acd"<?=(($answer=='acd')?' selected':''); ?>>acd</option>
                <option value="bcd"<?=(($answer=='bcd')?' selected':''); ?>>bcd</option>
                <option value="abd"<?=(($answer=='abd')?' selected':''); ?>>abd</option>
                <option value="abcd"<?=(($answer=='abcd')?' selected':''); ?>>abcd</option>
            </select>
        </div>

    <div class="form-group col-lg-12" style="color: #076cb0; margin-bottom: 20px; margin-top: 20px;">
                <label for="supporting_img" style="font-size: 20px;">Upload Supporting image :&nbsp;
                        <?php if(isset($_GET['edit']))
                        {
                        $qedit_id=(int)$_GET['edit'];
                        $qpsql1=mysqli_query($cnp,"select `supporting_img` from qbank where `qid`='$qedit_id'");
                        $qpeid=mysqli_fetch_assoc($qpsql1);
                        echo '<br><img src="data:image;base64,'.base64_encode($qpeid['supporting_img']).'"  alt="Image not uploaded yet" style="width: 255px; height:200px;" name="paper_image">';
                    ?></label>
                    &nbsp;&nbsp; &nbsp;&nbsp;
                    <input type="file" name="userImage" class="form-control" id="first_name" placeholder="upload supporting iamge" style="width: 500px; margin-left: 40px;">
                    <?php 
                    } else {
                    ?>
                    &nbsp;&nbsp; &nbsp;&nbsp;
                    <input type="file" name="userImage" class="form-control" id="first_name" placeholder="upload supporting iamge" style="width: 500px; margin-left: 40px;">
                     <?php } ?>
         </div>

       <div class="row text-center" style="width: auto; margin-left: 2px;"> 
       <div class="form-group col-lg-12">
            <input type="reset" name="cancel" class="btn btn-primary">
            &nbsp; &nbsp;
            <input type="submit" value="<?=((isset($_GET['edit']))?'Save ':'Save');?>" class="btn btn-success">
            &nbsp; &nbsp;
            <a href="teacher_dashboard.php" class="btn btn-danger">Cancel</a>    
        </div>
        </div>
        <div class="clearfix"></div>
    </form>
    <br>
  </div>
<?php 
include 'includes/footer.php';
?>