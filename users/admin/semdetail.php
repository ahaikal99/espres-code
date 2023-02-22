<?php
include 'connection.php';

session_start();

    if(isset($_SESSION["userid"])){
        if(($_SESSION["userid"])=="" or $_SESSION['usertype']!='admin'){
            header("location: ../login.php");
        }else{
            $userid=$_SESSION["userid"];
            $studentid = $_SESSION["studentid"]??'';
        }

    }else{
        header("location: ../login.php");
    }
    // echo var_dump($_SESSION);
    $sql_stmnt3 = $pdo->prepare("SELECT * FROM sem");
    $sql_stmnt3->execute();
    $go = $sql_stmnt3->fetchAll();
    if($_POST){
        $studentid = $_POST['id'];

        // Use a placeholder in the query string and bind the parameter
        $db_report = $pdo->prepare("SELECT * FROM sem WHERE id = :id");
        $db_report->bindParam(':id', $id);
        $db_report->execute();
    
        $report_list = $db_report->fetch(PDO::FETCH_ASSOC);
    
        $sdate = $report_list['startdate'];
        $edate = $report_list['enddate'];
    
        // Use placeholders in the query string and bind the parameters
        $db_sql = $pdo->prepare("SELECT * FROM logbook WHERE date >= :start_date AND date <= :end_date AND userid = :id");
        $db_sql->bindParam(':id', $userid);
        $db_sql->bindParam(':start_date', $sdate);
        $db_sql->bindParam(':end_date', $edate);
        $db_sql->execute();
    
        $calculate_total = $db_sql->fetchAll(PDO::FETCH_ASSOC);
    
        $total = 0;
    
        // Loop through the result set and calculate the total time
        foreach ($calculate_total as $element) {
            $temp = explode(":", $element['totaltime']);
            $total += (int)$temp[0] * 3600 + (int)$temp[1] * 60;

    }}

    $sql_stmnt = $pdo->prepare("SELECT * FROM admin WHERE userid = '$userid'");
    $sql_stmnt->execute();
    $user_db = $sql_stmnt -> fetch(PDO::FETCH_ASSOC);

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
                        <img class="rounded-circle" style="width:40px;" src="log.jpg">
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
                    <!-- <li class="nav-item">
                        <a href="profile.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Profile</span></a>
                    </li> -->
                    <li class="nav-item">
                        <a href="supervisor-profile.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Supervisor</span></a>
                    </li>
                    <li  class="nav-item pcoded-hasmenu active">
                        <a href="javascript:" class="nav-link active"><span class="pcoded-micon active"><i class="bi bi-mortarboard-fill"></i></span><span class="pcoded-mtext">Student</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="student-profile.php" class="">Profile</a></li>
                            <li class="active"><a href="logbook.php" class="">Logbook</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="report.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Report</span></a>
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
                                <img src="profile.png" class="img-radius">
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
                                        <li class="breadcrumb-item"><a href="logbook.php">List of student</a></li>
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
                                <!-- [ Hover-table ] start -->
                                <div class="col">
                                    <div class="card" id="printableArea">
                                        <div class="card-header mb-3">
                                            <h5>Report</h5>
                                        </div>
                                        <div class="p-2 d-flex flex-row mb-3 gap-5" style="color: black;">
                                            <div class="p-2">
                                                <span> <a style="font-weight: bold;">Student Name : </a><?php echo strtoupper($user_db['uname']) ?></span>
                                            </div>
                                            <div class="p-2">
                                                <span> <a style="font-weight: bold;">Student ID : </a><?php echo $user_db['userid'] ?></span>
                                            </div>
                                            <div class="p-2">
                                                <span> <a style="font-weight: bold;">Program Code : </a><?php echo $user_db['pcode'] ?></span>
                                            </div>
                                            <div class="p-2">
                                                <span> <a style="font-weight: bold;">Semester : </a><?php echo $sdate .' '. '-' .' '. $edate ?></span>
                                            </div>
                                        </div>
                                        <div class="p-2 d-flex flex-row mb-3 gap-5" style="color: black;">
                                            <div class="p-2">
                                                <span> <a style="font-weight: bold;">Research Title : </a><?php echo $user_db['title'] ?></span>
                                            </div>
                                        </div>
                                        <div class="p-2 d-flex flex-row mb-3 gap-5" style="color: black;">
                                            <div class="p-2">
                                                <span> <a style="font-weight: bold;">Supervisor Name : </a><?php echo strtoupper($user_db['svname']) ?></span>
                                            </div>
                                        </div>
                                        <div class="p-2 d-flex flex-row mb-2 gap-5" style="color: black;">
                                            <div class="p-2">
                                                <span> <a style="font-weight: bold;">Co-Supervisor Name : </a><?php echo strtoupper($user_db['cosv']) ?></span>
                                            </div>
                                        </div>
                                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                        <div class="p-2 d-flex"style="font-weight: bold; color: black;">
                                            <div class="p-2 flex-fill w-25">Date</div>
                                            <div class="p-2 flex-fill w-25">Activity</div>
                                            <div class="p-2 flex-fill w-25">Duration</div>
                                        </div>
                                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                        <?php foreach($calculate_total as $logbook): ?>
                                            <div class="p-2 d-flex"style="color: black;">
                                                <div class="p-2 flex-fill w-25"><?php echo $logbook['date']?></div>
                                                <div class="p-2 flex-fill w-25"><?php echo $logbook['activity']?></div>
                                                <div class="p-2 flex-fill w-25"><?php echo $logbook['totaltime']?></div>
                                            </div>
                                        <?php endforeach; ?>
                                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                        <div class="p-2 d-flex"style="color: black;">
                                            <div class="p-2 flex-fill"></div>
                                            <div class="p-2 flex-fill"></div>
                                            <div class="p-2 flex-fill"><a style="font-weight: bold;">Total Hours : </a><?php echo $display." "."Hours" ?></div>
                                        </div>
                                        <hr class="mb-3" style="height:2px;border-width:0;color:gray;background-color:gray">
                                    </div>
                                    <a href="javascript:void(0);" class="m-2 btn btn-primary" onclick="printPageArea('printableArea')">Print</a>
                                </div>
                                <!-- [ Hover-table ] end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="\espres-code\public\assets/js/vendor-all.min.js"></script>
	<script src="\espres-code\public\assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="\espres-code\public\assets/js/pcoded.min.js"></script>
    <script src="\espres-code\node_modules\bootstrap\dist\js\bootstrap.min.js"></script>

</body>
</html>