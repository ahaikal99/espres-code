<?php

include 'connection.php';

session_start();

    if(isset($_SESSION["userid"])){
        if(($_SESSION["userid"])=="" or $_SESSION['usertype']!='admin'){
            header("location: ../login.php");
        }else{
            $userid=$_SESSION["userid"];
        }

    }else{
        header("location: ../login.php");
    }

    $sql_stmnt = $pdo->prepare("SELECT * FROM admin WHERE userid = '$userid'");
    $sql_stmnt->execute();
    $user_db = $sql_stmnt -> fetch(PDO::FETCH_ASSOC);

if($_POST){
    $id = $_POST['id'];
    $uid = $_POST['uid'];

    $sql = $pdo->prepare("SELECT * FROM logbook WHERE id = '$id' AND userid = '$uid'");
    $sql->execute();
    $logbok_data = $sql->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- bootstrap -->
    <link rel="stylesheet" href="\espres-code/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="\espres-code/node_modules\bootstrap-icons\font\bootstrap-icons.css">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="\espres-code/public\assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="\espres-code/public\assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="\espres-code/public\assets\css\style.css">

</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="dashboard.php" class="b-brand">
                    <div>
                        <img class="rounded-circle" style="width:40px;" src="assets/images/favicon.ico">
                    </div>
                    <span class="b-title">ESPRES</span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Profile</span></a>
                    </li>
                    <li  class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Supervisor</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="supervisor-profile.php" class="">Profile</a></li>
                        </ul>
                    </li>
                    <li  class="nav-item pcoded-hasmenu active">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="bi bi-mortarboard-fill"></i></span><span class="pcoded-mtext">Student</span></a>
                        <ul class="pcoded-submenu">
                            <li class=" "><a href="student-profile.php" class="">Profile</a></li>
                            <li class="active"><a href="logbook.php" class="">Logbook</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>
            <a href="index.php" class="b-brand">
                <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div>
                <span class="b-title">ESPRES</span>
            </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="javascript:">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li><a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li class="nav-item">
                    <div class="main-search">
                        <div class="input-group">
                            <input type="text" id="m-search" class="form-control" placeholder="Search . . .">
                            <a href="javascript:" class="input-group-append search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </a>
                            <span class="input-group-append search-btn btn btn-primary">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div>
                        <h6></h6>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notifications</h6>
                            </div>
                            <ul class="noti-body">
                                <li class="notification">
                                    <div class="media">
                                        <div class="media-body">
                                            <p><strong>You have no new notification</strong></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="" class="img-radius">
                                <span><?php echo $user_db['uname'] ?></span>
                                
                            </div>
                            <ul class="pro-body">
                                <li><a href="change-password.php" class="dropdown-item"><i class="feather icon-settings"></i> Change Password</a></li>
                                <li><a href="profile.php" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                                <li><a href="\espres-code\logout.php" class="dropdown-item"><i class="feather icon-log-out"></i> Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <section class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        
                                    </div>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="history.php">History</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                            <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>History</h5>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="">
                                                <div class="row mb-5">
                                                    <div class="col-3">
                                                        <div class="input-group" style="width: 220px;">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">DATE</span>
                                                            </div>
                                                            <input type="text" class="form-control" style="background-color: white" value="<?php echo $logbok_data['date'] ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="input-group" style="width: 230px;">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">START TIME</span>
                                                            </div>
                                                            <input type="text" class="form-control" style="background-color: white" value="<?php echo $logbok_data['starttime'] ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="input-group" style="width: 210px;">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">END TIME</span>
                                                            </div>
                                                            <input type="text" class="form-control" style="background-color: white" value="<?php echo $logbok_data['endtime'] ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="input-group" style="width: 230px;">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">TOTAL HOUR</span>
                                                            </div>
                                                            <input type="text" class="form-control" style="background-color: white" value="<?php echo $logbok_data['totaltime'] ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-5" style="width: 600px;">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">ACTIVITY</span>
                                                    </div>
                                                    <input type="text" class="form-control" style="background-color: white" value="<?php echo $logbok_data['activity'] ?>" disabled>
                                                </div>
                                                <div class="input-group mb-5" style="width: 1000px;">
                                                    <div class="input-group">
                                                        <span class="input-group-text" style="width: 1000px;">DISCUSSION</span>
                                                    </div>
                                                    <span type="text" class="form-control" value="" style="height: 300px;  background-color: white" disabled><?php echo $logbok_data['discuss'] ?></span>
                                                </div>
                                                <?php if($logbok_data['doc']): ?>
                                                    <iframe src="\espres-code\users\student\<?php echo $logbok_data['doc'] ?>" width="100%" height="1000px"></iframe>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Main Content ] start -->

    <!-- Required Js -->
    <script src="\espres-code\public\assets/js/vendor-all.min.js"></script>
	<script src="\espres-code\public\assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="\espres-code\public\assets/js/pcoded.min.js"></script>
    <script src="\espres-code\node_modules\bootstrap\dist\js\bootstrap.min.js"></script>

</body>
</html>