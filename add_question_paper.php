<?php 
require_once 'includes/cnpariksha.php';
require_once 'help/helper.php';
$email=$_COOKIE['wdb_email'];
$description=((isset($_POST['description']) && $_POST['description']!='')?sanitize($_POST['description']):'');
$totalquestion=((isset($_POST['totalquestion']) && $_POST['totalquestion']!='')?sanitize($_POST['totalquestion']):'');
$password=((isset($_POST['password']) && $_POST['password']!='')?sanitize($_POST['password']):'');
$keyword=((isset($_POST['keyword']) && $_POST['keyword']!='')?sanitize($_POST['keyword']):'');
$subject=$_POST['subject'];
$maxidsql=mysqli_query($cnp,"select MAX(`qpid`) as maximum from qpaper");
$max_qpid=mysqli_fetch_assoc($maxidsql);
$sub_qpaperid=explode('-',$max_qpid['maximum']); // sub_y:m:d-003

$sub_qpid['sub']=$sub_qpaperid[0]; //sub_y:m:d
echo $sub_qpid['sub']; //tick
$sub_date=explode('_',$sub_qpid['sub']);
$sub_old['subold']=$sub_date[0]; //sub
$sub_old['odate']=$sub_date[1]; //odate
echo $sub_old['subold']; //tick
echo $sub_old['odate']; //tick

$sub_qpid['num']=$sub_qpaperid[1]; //003
echo $sub_qpid['num'];
$sub_quepaperid=$sub_qpid['num'];
echo $sub_quepaperid;
settype($sub_quepaperid, "integer"); // 003 int
$sub_qpid_new=$sub_quepaperid+001; //004
settype($sub_qpid_new, "string"); // 004 string
echo "new id".$sub_qpid_new;
$sub_date[1]=date("ym"); 
echo "date:-".$sub_date[1];
// $updated_qpid=$_GET['subj']."_".$sub_date[1]."-00".$sub_qpid_new;
// echo $updated_qpid;
if(isset($_POST['submit']))
{
        $updated_qpid=$subject."_".$sub_date[1]."-00".$sub_qpid_new;
        echo $updated_qpid;
        $email=$_COOKIE['wdb_email'];
        $sql11="INSERT INTO `qpaper`(`email`, `keyword`,`description`, `totalquestion`, `password`, `createdts`, `qpid`) VALUES ('$email','$keyword','$description','$totalquestion','$password',CURRENT_TIMESTAMP,'$updated_qpid')";  
        $rsql=mysqli_query($cnp,$sql11);
    
        if($rsql>0)
        {
            ?>
            <script>
                alert("Question Paper saved successfully");
                location.href="manage_question_paper.php";
            </script> <?php  
        }
        else{
            ?>
            <script>
                alert("Error in query <br> <?=$sql11;?>");
                location.href="teacher_dashboard.php";
            </script> <?php  
        }     
}
else{
    echo "not submit";
}
?>
<?php 
if(isset($_POST['search_submit']))
{
    $email=$_COOKIE['wdb_email'];
$streamcategory=((isset($_POST['streamcategory']) && $_POST['streamcategory']!='')?sanitize($_POST['streamcategory']):'');
$streamname=((isset($_POST['streamname']) && $_POST['streamname']!='')?sanitize($_POST['streamname']):'');
$subject=((isset($_POST['subject']) && $_POST['subject']!='')?sanitize($_POST['subject']):'');
$chapter=((isset($_POST['chapter']) && $_POST['chapter']!='')?sanitize($_POST['chapter']):'');
$section=((isset($_POST['section']) && $_POST['section']!='')?sanitize($_POST['section']):'');

$search_sql="select * from qbank where email='$email' and streamcategory='$streamcategory' and streamname='$streamname' and subject='$subject' and chapter='$chapter' and section='$section'";
$ssql6=mysqli_query($cnp,$search_sql);
$search_numrows= mysqli_num_rows($ssql6);
$key_insert=mysqli_fetch_assoc($ssql6);
    if($search_numrows<=0)
    { 
        ?> <script>
            alert("No Results found try again");
            location.href="question_paper.php";
        </script> <?php 
    }
    else
    {
        $_COOKIE['streamcategory']=$key_insert['streamcategory'];
        $_COOKIE['streamname']=$key_insert['streamname'];
        $_COOKIE['subject']=$key_insert['subject'];
        $_COOKIE['chapter']=$key_insert['chapter'];
        $_COOKIE['section']=$key_insert['section'];
      ?> <script>
            alert("Keyword Generated");
            location.href="question_paper.php?sc=<?=$_COOKIE['streamcategory']; ?> && sn=<?=$key_insert['streamname']; ?> && subj=<?=$key_insert['subject']; ?> && chap=<?=$key_insert['chapter']; ?> && sect=<?=$key_insert['section']; ?>";
        </script> <?php   
    }
}

?>