<?php
include 'connection.php';

session_start();

    if(isset($_SESSION["userid"])){
        if(($_SESSION["userid"])=="" or $_SESSION['usertype']!='student'){
            header("location: ../login.php");
        }else{
            $userid=$_SESSION["userid"];
        }

    }else{
        header("location: ../login.php");
    }

    
    $sql_stmnt = $pdo->prepare("SELECT * FROM student WHERE userid = '$userid'");
    $sql_stmnt->execute();
    $user_db = $sql_stmnt -> fetch(PDO::FETCH_ASSOC);

    $sql_stmnt3 = $pdo->prepare("SELECT * FROM sem");
    $sql_stmnt3->execute();
    $go = $sql_stmnt3->fetchAll();


    if($_POST){
        $id = $_POST['userid'];
        $year = $_POST['year'];
        $month = $_POST['month'];

        $check_db = $pdo->prepare("SELECT * FROM report WHERE userid = '$userid' && month = '$month' && year = '$year' ");
        $check_db->execute();
        $report = $check_db -> fetch(PDO::FETCH_ASSOC);

        if($year =='Choose...' && $month=='Choose...'){
            header('Location: report.php');

        } elseif($report){
            if($month === $report['month'] && $year === $report['year']){
                header('Location: report.php');
            } 
        } else{

            $check_report = $pdo->prepare("SELECT * FROM logbook WHERE YEAR(date)='$year' AND MONTH(date)='$month' AND userid='$id'");
            $check_report->execute();

            if($check_report->rowCount() < 1){
                echo "<script>alert('No data');</script>";

            } else{
                $report_check = $pdo->prepare("SELECT * FROM report WHERE year='$year' AND month='$month' AND userid='$id'");
                $report_check->execute();

                if($report_check->rowCount() >= 1){
                    echo "<script>alert('Already generate');</script>";

                } else{
                    $insert_db = $pdo->prepare("INSERT INTO report(userid,year,month) VALUES('$id','$year','$month')");
                    $insert_db->execute();

                }

            }

            }
    }
    

    $report_db = $pdo->prepare("SELECT * FROM report WHERE userid = '$userid' ORDER BY year DESC");
    $report_db->execute();
    $report_data = $report_db->fetchAll();

    // $db_sql = $pdo->prepare("SELECT * FROM logbook WHERE MONTH(date) = 1 && YEAR(date) = 2022 && userid = '$userid';");
    // $db_sql->execute();
    // $calculate_total = $db_sql -> fetchAll();

    // foreach($report_data as $newdata){
    //     $month = $newdata['month'];
    //     $year = $newdata['year'];
    //     $db_sql = $pdo->prepare("SELECT * FROM logbook WHERE userid = '$userid' && MONTH(date) = '$month' && YEAR(date) = '$year' ");
    //     $db_sql->execute();
    //     $calculate_total = $db_sql -> fetchAll();

    //     $total = 0;
    //     // ------calculate total hour------------------------------
    //     // Loop the data items
    //     foreach( $calculate_total as $element):
            
    //         // Explode by separator :
    //         $temp = explode(":", $element['totaltime']);
            
    //         // Convert the hours into seconds
    //         // and add to total
    //         $total+= (int) $temp[0] * 3600;
            
    //         // Convert the minutes to seconds
    //         // and add to total
    //         $total+= (int) $temp[1] * 60;
            
    //     endforeach;
        
    //     // Format the seconds back into HH:MM:SS
    //     $display = sprintf('%02d:%02d',($total / 3600),($total / 60 % 60),$total % 60);
    // }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap -->
    <link rel="stylesheet" href="\espres-code/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="\espres-code\public\assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="\espres-code\public\assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="\espres-code\public\assets\css\style.css">

    <title>ESPRES</title>
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
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Profile</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="logbook.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-book"></i></span><span class="pcoded-mtext">Logbook</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="history.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clock"></i></span><span class="pcoded-mtext">History</span></a>
                    </li>
                    <li class="nav-item active">
                        <a href="report.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file"></i></span><span class="pcoded-mtext">Report</span></a>
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
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown">
                        
                            <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown"><i class="icon feather icon-bell"></i></a>
                            <?php if(empty($user_db['faculty'] && $user_db['phone'] && $user_db['address']&& $user_db['svname'] )): ?>
                                <a style="position: absolute; right:20px; bottom: 6px; font-size:30px; color:red">&#x2022;</a>
                                <div class="dropdown-menu dropdown-menu-right notification">
                                    <div class="noti-head">
                                        <h6 class="d-inline-block m-b-0">Notifications</h6>
                                    </div>
                                    <ul class="noti-body">
                                            <?php if(empty($user_db['faculty'] && $user_db['phone'] && $user_db['address'])):?>
                                        <li class="notification">
                                            <div class="media">
                                                <a class="media-body" href="profile.php">
                                                    <p><strong><i class="icon feather icon-user" style="font-size: 15px;"></i>&nbsp;&nbsp;&nbsp;Please Complete Your Profile</strong></p>
                                                </a>
                                            </div>
                                        </li>
                                            <?php endif; ?>
                                            <?php if(empty($user_db['supervisor'])):?>
                                        <li class="notification">
                                            <div class="media">
                                                <a class="media-body" href="logbook.php">
                                                    <p><strong><i class="icon feather icon-user" style="font-size: 15px;"></i>&nbsp;&nbsp;&nbsp;Please Add Your Supervisor</strong></p>
                                                </a>
                                            </div>
                                        </li>
                                            <?php endif; ?>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <div class="dropdown-menu dropdown-menu-right notification">
                                    <div class="noti-head">
                                        <h6 class="d-inline-block m-b-0">You have no new notification</h6>
                                    </div>
                                </div>
                            <?php endif; ?>
                    </div>
                </li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="<?php echo $user_db['pic'] ?>" class="img-radius">
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
    <div class="pcoded-main-container">
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
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Report</h5>
                                        </div>
                                        <div class="card-body">
                                        
                                        <div class="col-sm-12">
                                            <hr>
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Month</a>
                                                </li>
                                                <!-- <li class="nav-item">
                                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Semester</a>
                                                </li> -->
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th>Year</th>
                                                                    <th>Month</th>
                                                                    <th>Total Hour</th>
                                                                    <th>Detail</th>
                                                                </tr>
                                                            </thead>
                                                            <?php if(empty($report_data)):?>
                                                                <td></td>
                                                                <td><?php echo "No Data";?></td>
                                                                <td></td>
                                                            <?php else: ?>
                                                                <tbody>
                                                                <?php foreach($report_data as $data): ?>
                                                                    <?php
                                                                        $month = $data['month'];
                                                                        $year = $data['year'];
                                                                        $db_sql = $pdo->prepare("SELECT * FROM logbook WHERE userid = '$userid' && MONTH(date) = '$month' && YEAR(date) = '$year' ");
                                                                        $db_sql->execute();
                                                                        $calculate_total = $db_sql -> fetchAll();
                                                                
                                                                        $total = 0;
                                                                        // ------calculate total hour------------------------------
                                                                        // Loop the data items
                                                                        foreach( $calculate_total as $element):
                                                                            
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
                                                                    <tr>
                                                                        <td><?php echo $data['year'] ?></td>
                                                                        <td><?php 
                                                                        
                                                                        if($data['month']==1){
                                                                            echo "January";
                                                                        } elseif($data['month']==2){
                                                                            echo "February";
                                                                        } elseif($data['month']==3){
                                                                            echo "March";
                                                                        } elseif($data['month']==4){
                                                                            echo "April";
                                                                        } elseif($data['month']==5){
                                                                            echo "May";
                                                                        } elseif($data['month']==6){
                                                                            echo "June";
                                                                        } elseif($data['month']==7){
                                                                            echo "July";
                                                                        } elseif($data['month']==8){
                                                                            echo "August";
                                                                        } elseif($data['month']==9){
                                                                            echo "September";
                                                                        } elseif($data['month']==10){
                                                                            echo "October";
                                                                        } elseif($data['month']==11){
                                                                            echo "November";
                                                                        } else{
                                                                            echo "December";
                                                                        }

                                                                        ?></td>
                                                                        <td><?php echo $display ?></td>
                                                                        <td>
                                                                            <form style="display: inline-block;" action="report-detail.php" method="post">
                                                                                <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                                                                                <input type="hidden" name="year" value="<?php echo $data['year'] ?>">
                                                                                <input type="hidden" name="month" value="<?php echo $data['month'] ?>">
                                                                                <button type="submit" class="label bg-primary text-white f-12" style="border-radius: 10px; border-width: 0px;">View</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            </tbody>
                                                            <?php endif; ?>
                                                        </table>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                    <table class="table table-hover text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Semester</th>
                                                                <th>Detail</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        $b = 1; // Move this line outside of the foreach loop
                                                        foreach ($go as $i): ?>
                                                            <tr>
                                                                <td scope="col"><?php echo $b++; ?></td> <!-- Increment $b after outputting its value -->
                                                                <td scope="col"><?php echo $i['startdate'] .' '. '-' .' '. $i['enddate']; ?></td>
                                                                <td>
                                                                    <form action="sem.php" method="post">
                                                                        <input type="hidden" value="<?php echo $i['id'] ?>" name="id">
                                                                        <button type="submit" class="label bg-primary text-white f-12" style="border-radius: 10px; border-width: 0px;">View</button>                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Button trigger modal -->
                                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Generate Report</button> -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Generate Report</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            <div class="input-group mb-4">
                                                                <label class="input-group-text" for="year">Year</label>
                                                                <select class="form-select" id="year" name="year">
                                                                    <option selected>Choose...</option>
                                                                    <option value="2022">2022</option>
                                                                    <option value="2023">2023</option>
                                                                    <option value="2024">2024</option>
                                                                    <option value="2025">2025</option>
                                                                    <option value="2026">2026</option>
                                                                    <option value="2027">2027</option>
                                                                </select>
                                                            </div>
                                                            <div class="input-group mb-3">
                                                                <label class="input-group-text" for="month">Month</label>
                                                                <select class="form-select" id="month" name="month">
                                                                    <option selected>Choose...</option>
                                                                    <option value="1">January</option>
                                                                    <option value="2">February</option>
                                                                    <option value="3">March</option>
                                                                    <option value="4">April</option>
                                                                    <option value="5">May</option>
                                                                    <option value="6">June</option>
                                                                    <option value="7">July</option>
                                                                    <option value="8">August</option>
                                                                    <option value="9">September</option>
                                                                    <option value="10">October</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">December</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" value="<?php echo $userid ?>" name="userid">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
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
            </div>
        </div>
    </div>
    <!-- [ Main Content ] start -->

    <!-- Required Js -->
    <script src="\espres-code\public\assets/js/vendor-all.min.js"></script>
	<script src="\espres-code\public\assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="\espres-code\public\assets/js/pcoded.min.js"></script>
    <script src="\espres-code\node_modules\bootstrap\dist\js\bootstrap.min.js"></script>

</body>
</html>