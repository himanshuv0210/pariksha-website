<?php 
if(!isset($_COOKIE['wdb_email']))
{
  header("location:index.php");
  exit;
}
require_once 'includes/cnpariksha.php';
require_once 'help/helper.php';

$sub_sql="select subject from subject";
$sub_query=mysqli_query($cnp,$sub_sql);
$datas=array();
$datas2=array();
$insert_sql="";
$qid_qpid="";
?>
<?php 
include 'includes/header.php';
echo '<br><br><br>';
echo '<br><br><br>'; 
?>
<?php include 'includes/profile_header.php'; ?>
<br>
<div class="border border-light p-3 mb-4">
    <div class="text-center">
        <a href="view_results.php" class="btn btn-primary" id="add-subject-btn">View Results</a> &nbsp;
    </div>
</div>
<br>
<div class="container">
    <h2 style="color: #076cb0; font-family: sans-serif;">Subjects</h2>
	<table  class="table table-bordered table-condensed table-striped">
    <thead class="bg-primary" style="color: white;">
        <th>#</th><th>Subject</th><th>Contents</th>
            <tbody style="font-size: 20px;"> 
                <?php 
                $x=0;
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
            			$qp_sql="SELECT qpid,description,totalquestion FROM qpaper WHERE qpid LIKE '$subt%' ";
            			$dash_paper=mysqli_query($cnp,$qp_sql);
            			while ($qpaper_res=mysqli_fetch_assoc($dash_paper)):
            				$datas2[]=$qpaper_res;
            			endwhile;
            			?><td><?php
            			foreach ($datas2 as $data2) 
	        			{
	        				$qpp=$data2['description'];
                            $qp_tq=$data2['totalquestion'];
	        				$qppid=$data2['qpid'];
	        				echo "<span><a href='question_paper_password.php?show=".$qppid."&& qptq=".$qp_tq."&& desc=".$qpp."'>".$qpp."</a></span></br>";
	        			}
	        			unset($datas2);
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
<br>
<?php
include 'includes/footer.php';
?>