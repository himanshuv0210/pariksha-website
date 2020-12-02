<?php
require_once 'includes/cnpariksha.php';
require_once 'help/helper.php';
$email=$_COOKIE['wdb_email'];	
$mobileno=((isset($_POST['mobileno']))?sanitize($_POST['mobileno']):'');
$mobileno2=((isset($_POST['mobileno2']))?sanitize($_POST['mobileno2']):'');
$iname=((isset($_POST['iname']))?sanitize($_POST['iname']):'');
$address=((isset($_POST['address']))?sanitize($_POST['address']):'');
$pin=((isset($_POST['pin']))?sanitize($_POST['pin']):'');
$profiletype=((isset($_POST['profiletype']))?sanitize($_POST['profiletype']):'');
$cperson=((isset($_POST['cperson']))?sanitize($_POST['cperson']):'');
$required=array('first_name','last_name','email','mobileno','mobileno2','password','iname','address','pin','userImage','profiletype','cperson');
if(isset($_POST['submit']) && (count($_FILES) > 0))
{			
	$emailsql=mysqli_query($cnp,"select * from profile where email='$email'");
	$emailcount=mysqli_num_rows($emailsql);
	$pro_id=mysqli_fetch_assoc($emailsql);
	$profileid=$pro_id['profileid'];
    // settype($profileid, "integer");
    // echo ($profileid.'<br>');
    if($emailcount!=0)
    {
    ?>
    	<script>
            location.href="dashboard.php";
        </script>
    <?php
    }        
 	else
 	{	
 		if (is_uploaded_file($_FILES['userImage']['tmp_name']))
 		{
		$imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
		$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
        $emailsql2=mysqli_query($cnp,"select max(profileid) as maximum from profile");
        $pro_id=mysqli_fetch_assoc($emailsql2);
        $profileid=$pro_id['maximum'];
        settype($profileid, "integer");
        $profileid_new=$profileid+1;
        settype($profileid_new, "string");
        //add user to database
        mysqli_query($cnp,"INSERT INTO `profile` (`profileid`, `email`, `institutename`, `address`, `pin`, `mno1`, `mno2`, `profiletype`, `logo`, `contactperson`, `createdts`) VALUES ('$profileid_new', '$email', '$iname', '$address','$pin','$mobileno','$mobileno2','$profiletype','{$imgData}','$cperson',CURRENT_TIMESTAMP)");?>
                <script>
                    alert("Saved Successfully");
                    location.href="dashboard.php";
                </script> <?php
        }
        else{
    		?>
                <script>
                    alert("Upload a logo first");
                </script> <?php
    	}
    }
    // $cnp->close();      
}
?>
    