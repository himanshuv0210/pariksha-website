<?php 
require_once 'includes/cnpariksha.php';
// require_once 'includes/cnothers.php';
require_once 'help/helper.php';
$first_name=((isset($_POST['first_name']))?sanitize($_POST['first_name']):'');
$last_name=((isset($_POST['last_name']))?sanitize($_POST['last_name']):'');
$email=((isset($_POST['email']))?sanitize($_POST['email']):'');
$password=((isset($_POST['password']))?sanitize($_POST['password']):'');
$mobileno=((isset($_POST['mobileno']))?sanitize($_POST['mobileno']):'');
$mobileno2=((isset($_POST['mobileno2']))?sanitize($_POST['mobileno2']):'');
$iname=((isset($_POST['iname']))?sanitize($_POST['iname']):'');
$address=((isset($_POST['address']))?sanitize($_POST['address']):'');
$pin=((isset($_POST['pin']))?sanitize($_POST['pin']):'');
// $profiletype=((isset($_POST['profiletype']))?sanitize($_POST['profiletype']):'');
$cperson=((isset($_POST['cperson']))?sanitize($_POST['cperson']):'');
$errors=array();
$required=array('first_name','last_name','email','mobileno','mobileno2','password','iname','address','pin','userImage','profiletype','cperson');

$message = '';
$qsql="select * from qpaper where email='$email'";
$qres=mysqli_query($cnp,$qsql);
$qpaper=mysqli_fetch_assoc($qres);
if(isset($_POST['submit_login']))
{
 if(empty($_POST["email"]) || empty($_POST["password"]))
 {
  $message = "<div class='alert alert-danger'>Both Fields are required</div>";
 }

 else
 {
  $qry = "select first_name, last_name,email from mst_user where email='$email' and password = '$password'";
  $rs = mysqli_query($cnp, $qry);
  $numRows = mysqli_num_rows($rs);
  if($numRows == 1)
  {
   			$getRow = mysqli_fetch_assoc($rs);
			$forOneHour = time() + 3600;
			setcookie("wdb_email",$email,$forOneHour,"/");
			setcookie("wdb_password",$password,$forOneHour,"/");
			$emailsql1=mysqli_query($cnp,"select * from profile where email='$email'");
			$emailcount1=mysqli_num_rows($emailsql1);
			$pro_email=mysqli_fetch_assoc($emailsql1);
			// $pro_id=$pro_email['email'];
			$qpaper1=$qpaper['qpid'];
			$profiletype=$pro_email['profiletype'];

			if($emailcount1!=0)
			{
				setcookie("wdb_protype",$profiletype,$forOneHour,"/");
				setcookie("qpaper_id",$qpaper1,$forOneHour,"/");
				?>
				    <script>
				            location.href="dashboard.php";
				    </script><?php
			}
			else 
			{
				header("location:profile.php");
				exit;
			}
	}	
    else
    {
     $message = '<div class="alert alert-danger">Wrong Email and Password</div>';
    }
   }
 }
?>
<?php 
	include 'includes/header.php';
?>

	<div id="carouselExampleControls" class="carousel slide bs-slider box-slider" data-ride="carousel" data-pause="hover" data-interval="false" >
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleControls" data-slide-to="1"></li>
			<li data-target="#carouselExampleControls" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<div id="home" class="first-section" style="background-image:url('images/slider-01.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-right">
									<div class="big-tagline">
										<h2 style="font-family: myfirst"><strong>BinS Computer </strong> Training Division</h2>
										<p class="lead">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
											<a href="#" class="hover-btn-new"><span>Contact Us</span></a>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="#" class="hover-btn-new"><span>Read More</span></a>
									</div>
								</div>
							</div><!-- end row -->
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			<div class="carousel-item">
				<div id="home" class="first-section" style="background-image:url('images/slider-02.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-left">
									<div class="big-tagline">
										<h2 data-animation="animated zoomInRight">BinS Computer <strong>Automation Division</strong></h2>
										<p class="lead" data-animation="animated fadeInLeft">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
											<a href="#" class="hover-btn-new"><span>Contact Us</span></a>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="#" class="hover-btn-new"><span>Read More</span></a>
									</div>
								</div>
							</div><!-- end row -->
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			<div class="carousel-item">
				<div id="home" class="first-section" style="background-image:url('images/slider-03.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-center">
									<div class="big-tagline">
										<h2 data-animation="animated zoomInRight"><strong>VPS Servers</strong> Company</h2>
										<p class="lead" data-animation="animated fadeInLeft">1 IP included with each server
											Your Choice of any OS (CentOS, Windows, Debian, Fedora)
											FREE Reboots</p>
											<a href="#" class="hover-btn-new"><span>Contact Us</span></a>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="#" class="hover-btn-new"><span>Read More</span></a>
									</div>
								</div>
							</div><!-- end row -->
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			<!-- Left Control -->
			<a class="new-effect carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="fa fa-angle-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>

			<!-- Right Control -->
			<a class="new-effect carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="fa fa-angle-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>

    <div id="overviews" class="section wb" style="background: #ffded1;">
        <div class="container" style="background: #ffded1;">
            <div class="section-title row text-center">
                <div class="col-md-8 offset-md-2">
                    <h3 style="color:#192b5e;">About</h3>
                    <p class="lead" style="color: #076cb0;"> Across all industries conduct surveys to uncover answers to specific, important questions.
              Questions should be strategically planned and structured in the best way possible in order to receive the most accurate data.</p>
                </div>
            </div><!-- end title -->

            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="message-box">
                        <h3 style="color:#192b5e; font-size: 25px;">When structuring your survey questions, consider the following:</h3>
				          <ol type="1" class="lead" style="color: #076cb0;">
				              <li>The main goal of the survey</li>
				              <li>How you plan to apply the survey data</li>
				              <li>The decisions you will make as a result of the survey data</li>
				          </ol>
                 	 <a href="#" class="hover-btn-new orange"><span>Learn More</span></a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

				<div class="col-lg-5">
                    <div class="post-media wow fadeIn">
                        <img src="images/about_02.jpg"  alt="" class="img-fluid img-rounded">
                    </div><!-- end media -->
                </div><!-- end col -->
			</div>
			<div class="row align-items-center">
				<div class="col-lg-5">
                    <div class="post-media wow fadeIn">
                        <img src="images/about_03.jpg" alt="" class="img-fluid img-rounded">
                    </div><!-- end media -->
                </div><!-- end col -->

				<div class="col-lg-4">
                    <div class="message-box">
                    <h3 style="color:#192b5e; font-size: 25px;" >Why Surveys Still Matter?</h3>
				        <p class="lead" style="color: #076cb0;">
				            In this high-tech era of analytics, the idea of a customer survey sounds almost quaint.
				            Even with all the technology available that allows marketing and research companies to find out exactly what consumers want,
				            sometimes it’s still best to go straight to the source and ask them yourself.
				        </p>
                        <a href="#" class="hover-btn-new orange"><span>Learn More</span></a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

            </div> <!-- end row -->

            <div class="row align-items-center">
            	<div class="col-md-8" style="text-align: center;">
            		<p class="lead" style="color: #076cb0;">Survey research is a quantitative approach that features the use of self-report measures on carefully selected samples.
				        It is a flexible approach that can be used to study a wide variety of basic and applied research questions.
				        </p>
            	</div>
            </div>

            <div class="row align-items-center">
            	<div class="col-md-8" style="text-align: center;">
                    <h1 style="color:#192b5e;"> What are the 4 main reasons? why businesses and researchers should conduct surveys?</h1>
                    <p class="lead" style="color: #076cb0;">Uncover the answers</p>
					<p class="lead" style="color: #076cb0;">Evoke discussion</p>
					<p class="lead" style="color: #076cb0;">Base decisions on objective information</p>
					<p class="lead" style="color: #076cb0;">Compare results</p>
                </div>
            </div>
        </div><!-- end container -->
    </div><!-- end section -->
	<div class="section cl">
		<div class="container">
			<div class="row text-left stat-wrap" style="color:#192b5e;">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="flaticon-study"></i></span>
					<p class="stat_count">12000</p>
					<h3>Students</h3>
				</div><!-- end col -->

				<div class="col-md-4 col-sm-4 col-xs-12">
					<span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="flaticon-online"></i></span>
					<p class="stat_count">240</p>
					<h3>Courses</h3>
				</div><!-- end col -->

				<div class="col-md-4 col-sm-4 col-xs-12">
					<span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="flaticon-years"></i></span>
					<p class="stat_count">55</p>
					<h3>Years Completed</h3>
				</div><!-- end col -->
			</div><!-- end row -->
		</div><!-- end container -->
	</div><!-- end section -->

    <div id="plan" class="section lb" style="background: #ffded1;">
        <div class="container">
            <div class="section-title text-center">
                <p style="color: #076cb0;">Surveys can be used at any stage of a marketing campaign:
              in the preliminary stages to help shape the strategy;
              during a campaign’s run to see how the public feels about it;
              and in the post-launch stage to gather feedback.
              Whether you’re using them for an existing product or a brand new concept,
              don’t sleep on the idea of surveys their data can be invaluable to a product or brand’s lifespan. </p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="message-box">
                        <ul class="nav nav-pills nav-stacked" id="myTabs">
                            <li><a class="active" href="#tab1" data-toggle="pill">Monthly Subscription</a></li>
                            <li><a href="#tab2" data-toggle="pill">Yearly Subscription</a></li>
                        </ul>
                    </div>
                </div><!-- end col -->
            </div>

            <hr class="invis">

            <div class="row">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane active fade show" id="tab1">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="pricing-table pricing-table-highlighted">
                                        <div class="pricing-table-header grd1">
                                            <h2 >$45</h2>
                                            <h3>per month</h3>
                                        </div>
                                        <div class="pricing-table-space"></div>
                                        <div class="pricing-table-features">
                                            <p><i class="fa fa-envelope-o"></i> <strong>250</strong> Email Addresses</p>
                                            <p><i class="fa fa-rocket"></i> <strong>125GB</strong> of Storage</p>
                                            <p><i class="fa fa-database"></i> <strong>140</strong> Databases</p>
                                            <p><i class="fa fa-link"></i> <strong>60</strong> Domains</p>
                                            <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>
                                        </div>
                                        <div class="pricing-table-sign-up">
                                            <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="pricing-table pricing-table-highlighted">
                                        <div class="pricing-table-header grd1">
                                            <h2>$59</h2>
                                            <h3>per month</h3>
                                        </div>
                                        <div class="pricing-table-space"></div>
                                        <div class="pricing-table-features">
                                            <p><i class="fa fa-envelope-o"></i> <strong>150</strong> Email Addresses</p>
                                            <p><i class="fa fa-rocket"></i> <strong>65GB</strong> of Storage</p>
                                            <p><i class="fa fa-database"></i> <strong>60</strong> Databases</p>
                                            <p><i class="fa fa-link"></i> <strong>30</strong> Domains</p>
                                            <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>
                                        </div>
                                        <div class="pricing-table-sign-up">
                                            <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="pricing-table pricing-table-highlighted">
                                        <div class="pricing-table-header grd1">
                                            <h2>$85</h2>
                                            <h3>per month</h3>
                                        </div>
                                        <div class="pricing-table-space"></div>
                                        <div class="pricing-table-features">
                                            <p><i class="fa fa-envelope-o"></i> <strong>250</strong> Email Addresses</p>
                                            <p><i class="fa fa-rocket"></i> <strong>125GB</strong> of Storage</p>
                                            <p><i class="fa fa-database"></i> <strong>140</strong> Databases</p>
                                            <p><i class="fa fa-link"></i> <strong>60</strong> Domains</p>
                                            <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>
                                        </div>
                                        <div class="pricing-table-sign-up">
                                            <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div><!-- end pane -->

                        <div class="tab-pane fade" id="tab2">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="pricing-table pricing-table-highlighted">
                                        <div class="pricing-table-header grd1">
                                            <h2>$477</h2>
                                            <h3>Year</h3>
                                        </div>
                                        <div class="pricing-table-space"></div>
                                        <div class="pricing-table-features">
                                            <p><i class="fa fa-envelope-o"></i> <strong>250</strong> Email Addresses</p>
                                            <p><i class="fa fa-rocket"></i> <strong>125GB</strong> of Storage</p>
                                            <p><i class="fa fa-database"></i> <strong>140</strong> Databases</p>
                                            <p><i class="fa fa-link"></i> <strong>60</strong> Domains</p>
                                            <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>
                                        </div>
                                        <div class="pricing-table-sign-up">
                                            <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="pricing-table pricing-table-highlighted">
                                        <div class="pricing-table-header grd1">
                                            <h2>$485</h2>
                                            <h3>Year</h3>
                                        </div>
                                        <div class="pricing-table-space"></div>
                                        <div class="pricing-table-features">
                                            <p><i class="fa fa-envelope-o"></i> <strong>150</strong> Email Addresses</p>
                                            <p><i class="fa fa-rocket"></i> <strong>65GB</strong> of Storage</p>
                                            <p><i class="fa fa-database"></i> <strong>60</strong> Databases</p>
                                            <p><i class="fa fa-link"></i> <strong>30</strong> Domains</p>
                                            <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>
                                        </div>
                                        <div class="pricing-table-sign-up">
                                            <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="pricing-table pricing-table-highlighted">
                                        <div class="pricing-table-header grd1">
                                            <h2>$500</h2>
                                            <h3>Year</h3>
                                        </div>
                                        <div class="pricing-table-space"></div>
                                        <div class="pricing-table-features">
                                            <p><i class="fa fa-envelope-o"></i> <strong>250</strong> Email Addresses</p>
                                            <p><i class="fa fa-rocket"></i> <strong>125GB</strong> of Storage</p>
                                            <p><i class="fa fa-database"></i> <strong>140</strong> Databases</p>
                                            <p><i class="fa fa-link"></i> <strong>60</strong> Domains</p>
                                            <p><i class="fa fa-life-ring"></i> <strong>24/7 Unlimited</strong> Support</p>
                                        </div>
                                        <div class="pricing-table-sign-up">
                                            <a href="#" class="hover-btn-new orange"><span>Order Now</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div><!-- end pane -->
                    </div><!-- end content -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->

   <div class="parallax section dbcolor">
        <div class="container">
            <div class="row logos">
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="images/logo_01.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="images/logo_02.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="images/logo_03.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="images/logo_04.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="images/logo_05.png" alt="" class="img-repsonsive"></a>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-6 wow fadeInUp">
                    <a href="#"><img src="images/logo_06.png" alt="" class="img-repsonsive"></a>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end section -->
<?php
include 'includes/footer.php';
?>