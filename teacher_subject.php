<?php 
if(!isset($_COOKIE['wdb_email']))
{
  header("location:index.php");
  exit;
}
require_once 'includes/cnpariksha.php';
require_once 'help/helper.php';
include 'includes/header.php';
echo '<br><br><br>';
echo '<br><br><br>';
if(isset($_GET['add']) || isset($_GET['edit']))
{
    $subject=((isset($_POST['subject']) && $_POST['subject']!='')?sanitize($_POST['sub_code']):'');
    if(isset($_GET['edit']))
    {
        $edit_id=(int)$_GET['edit'];
        $proresults=mysqli_query($cnp,"select * from subject where sid='$edit_id'");
        $subject2=mysqli_fetch_assoc($proresults);
        $subject=((isset($_POST['subject']) && $_POST['subject']!='')?sanitize($_POST['subject']):$subject['subject']);
    }
    if($_POST)
    {
        $errors=array();
        $required=array('subject');
        foreach($required as $field)
        {
            if($_POST[$field]=='')
            {
                $errors[]='All fields required.';
                break;
            }
        }
        if(!empty($errors))
        {
            echo display_errors($errors);
        }
        $sql="INSERT INTO `subject` (`sid`, `subject`) VALUES (NULL, '$subject')";
        
        if(isset($_GET['edit']))
        {
        $sql="update subject set sub_code='$sub_code',sub_name='$sub_name',type='$type',course_abbre='$course_abbre',sub_abbre='$sub_abbre',credits='$credits',semester='$semester' where sub_id='$edit_id'";
        }
        
        mysqli_query($db,$sql);
        $_SESSION['success_flash']='Your subject has been added or updated!!';
        header('location:subject.php');
                  
    }
    ?>
}     
?>
<div class="container">
<h2 class="text-center">subject</h2><hr>
<a href="teacher_subject.php?add=1" class="btn btn-success pull-right" id="add-subject-btn">Add subject</a><div class="clearfix"></div>
<br>
<table class="table table-bordered table-condensed table-striped table-hover table-dark">
    <thead class="bg-primary"><th>#</th><th></th><th>Subject Id</th><th>Subject Name</th></thead>
        <tbody>
                <?php 
                     $sql2="select * from subject order by subject";
                     $res=mysqli_query($cnp,$sql2);
                     $x=0;
                    while($subject1=mysqli_fetch_assoc($res)): 
                        $x++;
                        ?>
                <tr>
                    <th scope="row"><?=$x;?></th>
                    <td>
                        <a href="subject.php?edit=<?=$subject1['sid']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    </td>
                    <td><?=$subject1['sid']; ?></td>
                    <td><?=$subject1['subject']; ?></td>
                </tr>
                <?php endwhile; ?>
        </tbody>
</table>
</div>
<?php
include 'includes/footer.php';
?>