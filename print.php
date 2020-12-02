<?php
require_once 'includes/cnpariksha.php';
if(!isset($_COOKIE['wdb_email']))
{
  header("location:index.php");
  exit;
}
if(isset($_GET['show']))
{
	 $email_id=$_GET['show'];
	 $sql2="select * from MasterAdmission where Email='$email_id'";
     $res1=mysqli_query($cnp,$sql2);
     $student1=mysqli_fetch_assoc($res1);
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Site Metas -->
<title>Template</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="logo" href="images/logo.jpg">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style type="text/css">
.container 
{
	margin-top: 20px;
} 
.float-lg-none
{
	font-size: 90px;
}
label
{
	font-weight: bold;
}
</style>
</head>
<body>
<div class="container text-center border">
	<div class="float-lg-none">
		<img src="images/logo.jpg" width="70px" height ="90px" alt="" />
		The Nest 		
	</div>
	<div class="text-center">
		<h3>SERVED HOSTELS</h3>
		<span>(A Milestone Multi Services Initiative)</span>
	</div>
	<br>
	<div class="border border-dark text-center">
		<p>Head Office - 28 , Prayash Apt. Modern Colony Paul Road,Korthrud,Pune-411038<br>Website: www.thenestpune.com | Email: info@thenestpune.com | Mobile/Whatsapp: 8408927702/9822020484</p>
	</div>
	<br>
	<div> 
		<div class="float-lg-right text-right">
			<p><img src="<?=$student1['PhotoPath']; ?>" alt="PHOTO" width="150px;" height="120px;"></p>
		</div>
		<h3><u>HOSTEL ADMISSION FORM</u></h3>
		<span>(Particulars must be filled by the candidate in his/her own handwriting)</span>
	</div>
	<br>
	<br>
	<br>
	<div class="text-left">
	<div class="form-group">
		<div class="float-lg-right">
			<label>Date : </label> <u><?=$student1['UpdateDate']; ?></u>
		</div>
		<label>Form No. </label> <u><?=$student1['FormNo']?></u>
	</div>

	<div class="form-group">
		<label>Student Name :  </label>  <u><?=$student1['StudentName']; ?></u>
	</div>
	<div class="form-group">
		<label>Father's / Guardians Name :</label> <u><?=$student1['FatherName']; ?></u>
	</div>
	<div class="form-group">
		<label>Mother's Name :</label> <u><?=$student1['MotherName']; ?></u>
	</div>
	<div class="form-group">
		
		<div class="float-left">
			<label>College/Course</label> <u><?=$student1['College']; ?></u>
		</div>
		<label class="text-center" style="margin-left: 300px;">Date Of Birth : </label> <u><?=$student1['DOB']; ?></u>
		<label class="float-right">Blood group : <u><?=$student1['BloodGroup']; ?></u> </label> 
	</div> 
	<div class="form-group">
		<label>Permanent Address : </label> <u><?=$student1['PermanentAddress']; ?></u>
	</div>

	<div class="form-group">
		<div class="float-left">
			<label>Email : </label> <u><?=$student1['Email']; ?></u>
		</div>
		<label class="text-center" style="margin-left: 300px;">Mobile : <u><?=$student1['Contact1']; ?></u> </label>
	</div>
	<div class="form-group">
		<label>Adhar Card No. : </label> <u><?=$student1['aadhar']; ?></u>
	</div>

	</div>
	<hr style="background-color: black;">
	<h3><u>GUARDIAN CERTIFICATE</u></h3>
	<br>

	<div class="text-left">
	<div>
			<p>I <label><u><?=$student1['email']; ?></u></label> certify that my son/ Daughter <br>
			is applying for hostel accommodation at the Nest with the my Permission and I undertake that I will be responsible for his / her 
			stay at the Hostel and will <br> accept all the decissions of the hostel Administration. I will be responsible to pay all the hostel dues,
			if any, against my son / daughter.</p>
 	</div>
 	<br>
 	<br>
	<div class="form-group">
		<div class="float-left">
			<label>Name : </label> <u><?=$student1['StudentName']; ?></u>
		</div>
		<label class="text-center" style="margin-left: 500px;">Father' Name : <u><?=$student1['FatherName']; ?></u> </label>
	</div>
	<div class="form-group">
		<label>Address : </label> <u><?=$student1['PermanentAddress']; ?></u>
	</div>
	<div class="form-group">
		<div class="float-left">
			<label>Email Id: </label> <u><?=$student1['Email']; ?></u>
		</div>
		<label class="text-center" style="margin-left: 405px;">Contact Number :  <u><?=$student1['Contact2']; ?></u></label>
	</div>
	<div class="form-group">
		<label></label>
		<div class="float-right">
			<label>Parent Signature : <u><?=$student1['email']; ?></u> </label>
		</div>
	</div>
	<!-- <input type="button" value="Print this page" onClick="window.print()"> -->
	</div>
</div>
</body>
</html>

