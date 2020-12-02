<!DOCTYPE HTML>
<html lang="en">
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- Site Metas -->
    <title>Pariksha - A step to self accessment</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="logo" href="images/logo02.png">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/3.3.7/css/timeline.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/prettyPhoto/3.1.6/css/prettyPhoto.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> 

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/custom.js" type="text/javascript"></script>
    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>
</head>
<body class="host_version">
    <!-- Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header tit-up">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color: #192b5e">Login & Registration</h4>
            </div>
            <div class="modal-body customer-box">
                <!-- Tab panes -->
                <!--Login-->
                <div class="tab-content">   
                    <div class="tab-pane active" id="Login" >
                        <span><?php 
                                if(isset($message))
                                {
                                    echo '<div class="error-msg">';
                                    echo $message;
                                    echo '</div>';
                                    unset($message);
                                }
                            ?></span>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"role="form" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-12" style="color: #076cb0;">
                                    <input class="form-control" id="email1" name="email" placeholder="Email" type="email" required value="<?php echo (isset($_COOKIE['wdb_email'])?$_COOKIE['wdb_email']:'')?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" type="password" required value="<?php echo (isset($_COOKIE['wdb_email'])?$_COOKIE['wdb_password']:'')?>">
                                </div>
                            </div>
                            <div class="form-group" style="color: #076cb0;">
                                <input type="checkbox" name="remember_me" value="1" <?php echo (isset($_COOKIE['wdb_email'])?'checked':'')?>> Remember me
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" name="submit_login" class="btn btn-light btn-radius btn-brd grd1">
                                        Submit
                                    </button>
                                    <button type="reset" name="cancel" class="btn btn-light btn-radius btn-brd grd1">
                                        Cancel</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <a class="for-pwd" href="http://binscomputer.com/user/forgotPassword.php" target="_blank">Forgot your password?</a>
                                <a class="for-pwd" href="http://binscomputer.com/user/verify.php" target="_blank">Verify Email?</a>
                                <a class="for-pwd" href="http://binscomputer.com/user/register.php" target="_blank">Create a new account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader-container">
            <div class="progress-br float shadow">
                <div class="progress__item"></div>
            </div>
        </div>
    </div>
    <!-- END LOADER -->

    <!-- Start header -->
    <header class="top-navbar">
        <nav  class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="images/logo02.png" width="70px" height ="80px" alt="" />
                </a>
                <a href="index.php"><h1 style="color: #076cb0;">Bins Computer</h1></a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse lead" id="navbars-host" style="font-family: sans-serif; font-weight: bolder;">
                    <ul class="navbar-nav ml-auto">
                        <?php
                        if(!isset($_COOKIE['wdb_email']))
                        {
                        ?><li class="nav-item"><a class="nav-link" href="index.php"><b>   About Us</b></a></li><?php
                        }
                        else 
                        {
                            ?><li class="nav-item"><a class="nav-link" href="dashboard.php"><b>Dashboard</b></a></li><?php
                        }
                        ?>
                        <li class="nav-item"><a class="nav-link" href="#"><b>Courses</b></a></li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown"><b>Blog</b></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <a class="dropdown-item" href="blog.html">Blog </a>
                                <a class="dropdown-item" href="blog-single.html">Blog single </a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="teachers.html"><b>Teachers</b></a></li>
                        <li class="nav-item"><a class="nav-link" href="pricing.html"><b>Pricing</b></a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.html"><b>Contact</b></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <?php
                        if(!isset($_COOKIE['wdb_email']))
                        {
                          ?><li><a class="hover-btn-new log orange" href="#login" data-toggle="modal" data-target="#login"><span>Login</span></a></li>
                          <?php
                        }
                        else 
                        {
                           ?><li class="nav-item">
                                <a class="nav-link" href="logout.php"><b>Log out</b></a>
                            </li>
                          <?php 
                        }
                    ?></ul>
                </div>
            </div>
        </nav>
    </header>
