<?php 
if(!isset($_COOKIE['wdb_email']))
{
  header("location:index.php");
  exit;
}
else
{
	if($_COOKIE['wdb_protype']=='Teacher')
	{
		?>
	    <script>
	            location.href="teacher_dashboard.php";
	    </script>
	    <?php
	}
	if($_COOKIE['wdb_protype']=='Student')
	{
		?>
	    <script>
	            location.href="student_dashboard.php";
	    </script>
	    <?php
	}
}
?>
