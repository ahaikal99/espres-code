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

    $id = $_POST['id'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $db_list = $pdo->prepare("SELECT * FROM logbook WHERE MONTH(date) = '$month' AND YEAR(date) = '$year' AND userid = '$id'");
    $db_list->execute();
    $logbook_list = $db_list -> fetchAll();

    $detail = $pdo->prepare("SELECT * FROM student WHERE userid = '$id'");
    $detail->execute();
    $detail_logbook = $detail -> fetch(PDO::FETCH_ASSOC);


    $sql_stmnt = $pdo->prepare("SELECT * FROM admin WHERE userid = '$userid'");
    $sql_stmnt->execute();
    $user_db = $sql_stmnt -> fetch(PDO::FETCH_ASSOC);

    $total = 0;
        // ------calculate total hour------------------------------
        // Loop the data items
        foreach( $logbook_list as $element):
            
            // Explode by separator :
            $temp = explode(":", $element['totaltime']);
            
            // Convert the hours into seconds
            // and add to total
            $total+= (int) $temp[0] * 3600;
            
            // Convert the minutes to seconds
            // and add to total
            $total+= (int) $temp[1] * 60;
            
        endforeach;
        
        // Format the seconds back into HH:MM:SS
        $display = sprintf('%02d:%02d',($total / 3600),($total / 60 % 60),$total % 60);

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
                    <li class="nav-item active">
                        <a href="dashboard.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Profile</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="supervisor-profile.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Supervisor</span></a>
                    </li>
                    <li  class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="bi bi-mortarboard-fill"></i></span><span class="pcoded-mtext">Student</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="student-profile.php" class="">Profile</a></li>
                            <li class=""><a href="logbook.php" class="">Logbook</a></li>
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
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Logbook</h5>
                                        </div>
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home">List of Logbook</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile">Report</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" >
                                            <form action="" method="get">
                                                <div class="input-group mb-3 m-auto" style="max-width: 600px;">
                                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                                    <button class="btn bg-primary" type="submit" id="button-addon2"><i style="color: white; font-size: 20px; margin: auto" class="feather icon-search"></i></button>
                                                </div>
                                            </form>
                                                <?php if(!$logbook_list): ?>
                                                    <div class="text-center" style="padding: 20px;">
                                                        <h4><?php echo "No Data"?></h4>
                                                    </div>
                                                <?php else: ?>
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive text-center">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Date</th>
                                                                    <th>Activity</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach($logbook_list as $i => $data): ?>
                                                                    <tr>
                                                                    <td scope="row"><?php echo $i + 1 ?></td>
                                                                    <td><?php echo $data['date'] ?></td>
                                                                    <td><?php echo strtoupper($data['activity']) ?></td>
                                                                    <td><?php echo $data['status'] ?></td>
                                                                    <td>
                                                                        <form action="view-logbook-detail.php" method="post">
                                                                            <input type="hidden" name="uid" value="<?php echo $data['userid'] ?>">
                                                                            <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                                                                            <button type="submit" class="label bg-primary text-white f-12" style="border-radius: 10px; border-width: 0px;">View</button>
                                                                        </form>
                                                                    </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                        <nav aria-label="..." style="width: 245px; height: 60px;  object-fit: fill;display: block; margin-left: auto; margin-right: auto; border-radius: 100px;">
                                                            <ul class="pagination">
                                                                <li class="page-item disabled">
                                                                    <a class="page-link">Previous</a>
                                                                </li>
                                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                                <li class="page-item" aria-current="page">
                                                                    <a class="page-link" href="#">2</a>
                                                                </li>
                                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                <li class="page-item">
                                                                    <a class="page-link" href="#">Next</a>
                                                                </li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="p-2 d-flex flex-row mb-3 gap-5" style="color: black;">
                                                    <div class="p-2">
                                                        <span> <a style="font-weight: bold;">Student Name : </a><?php echo $detail_logbook['uname'] ?></span>
                                                    </div>
                                                    <div class="p-2">
                                                        <span> <a style="font-weight: bold;">Student ID : </a><?php echo $detail_logbook['userid'] ?></span>
                                                    </div>
                                                    <div class="p-2">
                                                        <span> <a style="font-weight: bold;">Month : </a>
                                                            <?php
                                                                if($month==1){
                                                                    echo "January";
                                                                } elseif($month==2){
                                                                    echo "February";
                                                                } elseif($month==3){
                                                                    echo "March";
                                                                } elseif($month==4){
                                                                    echo "April";
                                                                } elseif($month==5){
                                                                    echo "May";
                                                                } elseif($month==6){
                                                                    echo "June";
                                                                } elseif($month==7){
                                                                    echo "July";
                                                                } elseif($month==8){
                                                                    echo "August";
                                                                } elseif($month==9){
                                                                    echo "September";
                                                                } elseif($month==10){
                                                                    echo "October";
                                                                } elseif($month==11){
                                                                    echo "November";
                                                                } else{
                                                                    echo "December";
                                                                }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="p-2">
                                                        <span> <a style="font-weight: bold;">Year : </a><?php echo $year ?></span>
                                                    </div>
                                                </div>
                                                <div class="p-2 d-flex flex-row mb-3 gap-5" style="color: black;">
                                                    <div class="p-2">
                                                        <span> <a style="font-weight: bold;">Supervisor Name : </a><?php echo $detail_logbook['svname'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="p-2 d-flex flex-row mb-2 gap-5" style="color: black;">
                                                    <div class="p-2">
                                                        <span> <a style="font-weight: bold;">Co-Supervisor Name : </a><?php echo strtoupper($detail_logbook['cosv']) ?></span>
                                                    </div>
                                                </div>
                                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                                <div class="p-2 d-flex"style="font-weight: bold; color: black;">
                                                    <div class="p-2 flex-fill w-25">Date</div>
                                                    <div class="p-2 flex-fill w-25">Activity</div>
                                                    <div class="p-2 flex-fill w-25">Duration</div>
                                                </div>
                                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                                <?php foreach($logbook_list as $logbook): ?>
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
                                                <div class="d-flex mb-3">
                                                    <div class="p-2"></div>
                                                    <div class="p-2"></div>
                                                    <div class="ms-auto p-2">
                                                        <a href="report2.php" type="button" class="m-2 btn btn-primary">Print</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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