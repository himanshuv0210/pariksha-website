<?php 
if(!isset($_COOKIE['wdb_email']))
{
	if(!isset($_COOKIE['qpaper_id']))
	{
		header("location:teacher_dashboard.php");
		exit;
	}
  	header("location:index.php");
  	exit;
}
require_once 'includes/cnpariksha.php';
require_once 'help/helper.php';
include 'includes/header.php';
echo '<br><br><br>';
echo '<br><br><br>';
$email=$_COOKIE['wdb_email'];
$sub_sql="select subject from subject";
$sub_query=mysqli_query($cnp,$sub_sql);
include 'includes/profile_header.php'; 
?>
<br>
<div class="container" style="background-color: #076cb0;">
<h2 class="text-center p-3 mb-4" style="color: white; font-family: sans-serif; padding-top: 30px;">Summary</h2>
</div>
<div class="container">
	<table  class="table table-bordered table-condensed table-striped">
    <thead class="bg-primary" style="color: white;">
        <th>#</th><th>Subjects</th><th>Contents</th><th>Total Questions</th><th>Correct Answers</th><th>Wrong Answers</th><th>Not Attempted</th><th>Score</th>
            <tbody style="font-size: 20px;"> 
                <?php 
                $x=0;
                $datas=array();
				$datas2=array();
				$datas3=array();
                while ($subjects=mysqli_fetch_assoc($sub_query)): 
                    $datas[]=$subjects;
                    endwhile;
                    ?>       
                    <?php
            		foreach ($datas as $data) 
            		{	
            			?>
            			<tr class="table-success"><?php
            			$x++;
            			?><th scope="row"><?=$x;?></th><?php 
            			$subt=$data['subject'];
            			echo '<td>'.$subt.'</td>';
            			$qp_sql="SELECT qpid,description FROM mstexam WHERE email='$email' and qpid LIKE '$subt%' ";
            			$dash_paper=mysqli_query($cnp,$qp_sql);
            			?><td><?php
            			while ($qpaper_res=mysqli_fetch_assoc($dash_paper)):
            				$qpp=$qpaper_res['description'];
	        				$qppid=$qpaper_res['qpid'];
	        				echo "<span>".$qpp."</span></br><hr>";
            			endwhile;
	        				// echo "<td><span>".$qp_tq."</span></br></td>";
	        			?></td>
	        			<?php 
            			$subt2=$data['subject'];
            			$qp_sql2="SELECT qpid,totalquestion FROM mstexam WHERE email='$email' and qpid LIKE '$subt2%' ";
            			$dash_paper2=mysqli_query($cnp,$qp_sql2);
            			?>
	        			<td><?php
		        			while ($qpaper_res2=mysqli_fetch_assoc($dash_paper2)):
	                            $qp_tq=$qpaper_res2['totalquestion'];
		        				$qppid=$qpaper_res['qpid'];
		        				echo "<span>".$qp_tq."</span></br><hr>";
	            			endwhile;
		        			?>	
	        			</td>
		        			<?php 
	            			$subt3=$data['subject'];
	            			$qp_sql3="SELECT qpid,correct_ans FROM exam_result WHERE email='$email' and qpid LIKE '$subt3%' ";
	            			$dash_paper3=mysqli_query($cnp,$qp_sql3);
	            			?>
	        			<td>
		        			<?php
		        			while ($qpaper_res3=mysqli_fetch_assoc($dash_paper3)):
	                            $correct_ans=$qpaper_res3['correct_ans'];
		        				$qppid=$qpaper_res['qpid'];
		        				echo "<span>".$correct_ans."</span></br><hr>";
	            			endwhile;
		        			?>	
	        			</td>
		        			<?php 
	            			$subt4=$data['subject'];
	            			$qp_sql4="SELECT qpid,wrong_ans FROM exam_result WHERE email='$email' and qpid LIKE '$subt4%' ";
	            			$dash_paper4=mysqli_query($cnp,$qp_sql4);
            			?>
	        			<td>
		        			<?php
		        			while ($qpaper_res4=mysqli_fetch_assoc($dash_paper4)):
	                            $wrong_ans=$qpaper_res4['wrong_ans'];
		        				$qppid=$qpaper_res['qpid'];
		        				echo "<span>".$wrong_ans."</span></br><hr>";
	            			endwhile;
		        			?>	
	        			</td>
	        				<?php 
	            			$subt5=$data['subject'];
	            			$qp_sql5="SELECT qpid,qnotattempted	FROM exam_result WHERE email='$email' and qpid LIKE '$subt5%' ";
	            			$dash_paper5=mysqli_query($cnp,$qp_sql5);
            			?>
	        			<td>
		        			<?php
		        			while ($qpaper_res5=mysqli_fetch_assoc($dash_paper5)):
	                            $qnotattempted=$qpaper_res5['qnotattempted'];
		        				$qppid=$qpaper_res['qpid'];
		        				echo "<span>".$qnotattempted."</span></br><hr>";
	            			endwhile;
		        			?>	
	        			</td>
		        			<?php 
		            			$subt6=$data['subject'];
		            			$qp_sql6="SELECT qpid,marks	FROM exam_result WHERE email='$email' and qpid LIKE '$subt6%' ";
		            			$dash_paper6=mysqli_query($cnp,$qp_sql6);
	            			?>
	        			<td>
		        			<?php
		        			while ($qpaper_res6=mysqli_fetch_assoc($dash_paper6)):
	                            $marks=$qpaper_res6['marks'];
		        				$qppid=$qpaper_res['qpid'];
		        				echo "<span>".number_format((float) $marks,2, '.', '').' %'."</span></br><hr>";
	            			endwhile;
		        			?>	
	        			</td>
	        			</tr><?php			
            		}

	            	unset($datas);	
                    ?>        
            </tbody>
    </thead>
</table>
</div>
<div class="border border-light p-3 mb-4">
    <div class="text-center">
        <a href="student_dashboard.php" class="btn btn-danger" id="add-subject-btn">Dashboard</a> &nbsp;
    </div>
</div>
<br>
<?php
include 'includes/footer.php';
?>