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

    $sql = $pdo->prepare("SELECT * FROM admin WHERE userid ='$userid'");
    $sql->execute();
    $admin_data = $sql->fetch(PDO::FETCH_ASSOC);

    $sem = $pdo->prepare("SELECT * FROM sem");
    $sem->execute();
    $semdata = $sem->fetchAll();

    if ($_POST) {
        $start = $_POST['start'];
        $end = $_POST['end'];
    
        // Use placeholders in the prepared statement to prevent SQL injection
        $check = $pdo->prepare("SELECT * FROM sem WHERE startdate = :start AND enddate = :end");
        $check->bindParam(':start', $start);
        $check->bindParam(':end', $end);
        $check->execute();
        
        // Check if the query returned any rows, not just if the statement executed successfully
        if ($check->rowCount() > 0) {
            $mssg = 'The Semester Already Exist';
            echo '<script type="text/javascript">alert("' . $mssg . '");</script>';
        } else {
            // Use placeholders in the SQL statement to prevent SQL injection
            $insert = "INSERT INTO sem(startdate, enddate) VALUES(:start, :end)";
            $sql1 = $pdo->prepare($insert);
            $sql1->bindParam(':start', $start);
            $sql1->bindParam(':end', $end);
            $sql1->execute();

            header('Location: profile.php');
        }
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
                    <!-- <li class="nav-item active">
                        <a href="profile.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Profile</span></a>
                    </li> -->
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
                                <img src="<?php echo $admin_data['pic'] ?>" class="img-radius">
                                <span><?php echo $admin_data['uname'] ?></span>
                                
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
                            <div class="row">
                                <!-- [ basic-table ] start -->
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Semester</h5>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Semester
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Semester</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                <div class="input-group mb-5">
                                                    <span class="input-group-text" id="basic-addon1">Start Date</span>
                                                    <input type="date" class="form-control" name="start">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">End Date</span>
                                                    <input type="date" class="form-control" name="end">
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                        <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">Semester</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $b = 1; // Move this line outside of the foreach loop
                                        foreach ($semdata as $i): ?>
                                            <tr>
                                                <td scope="col"><?php echo $b++; ?></td> <!-- Increment $b after outputting its value -->
                                                <td scope="col"><?php echo $i['startdate'] .' '. '-' .' '. $i['enddate']; ?></td>
                                                <td>
                                                    <form action="deletesem.php" method="post">
                                                        <input type="hidden" value="<?php echo $i['id'] ?>" name="id">
                                                        <button class="btn bg-danger" style="color: white" type="submit">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        </table>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ basic-table ] end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="\espres-code\public\assets/js/vendor-all.min.js"></script>
	<script src="\espres-code\public\assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="\espres-code\public\assets/js/pcoded.min.js"></script>
    <script src="\espres-code\node_modules\bootstrap\dist\js\bootstrap.min.js"></script>

</body>
</html>