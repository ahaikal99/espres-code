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

    if($_POST){
        $id = $_POST['id'];

        $sql_logbook = $pdo->prepare("SELECT * FROM logbook WHERE id = '$id'");
        $sql_logbook->execute();
        $logbook = $sql_logbook -> fetch(PDO::FETCH_ASSOC);
        $_SESSION["id"]=$id;
    }

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
                    <li class="nav-item active">
                        <a href="history.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-clock"></i></span><span class="pcoded-mtext">History</span></a>
                    </li>
                    <li class="nav-item">
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
                <span class="badge text-bg-success">Student</span>
                </li>
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
                                        <?php if(empty($user_db['svname'])):?>
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
                                        <li class="breadcrumb-item"><a href="history.php">History</a></li>
                                        <li class="breadcrumb-item"><a href="view-history.php">Detail Logbook</a></li>
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
                                            <h5>Edit Logbook</h5>
                                        </div>
                                        <div class="card-body">
                                            <?php if(empty($user_db['svname'])):?>
                                                <div class="text-center">
                                                    <h4>Please add supervisor first</h4>
                                                    <a href="add-supervisor.php" class="btn label bg-success text-white f-12" style="border-radius: 10px; border-width: 0px; cursor:pointer">Add</a>
                                                </div>
                                            <?php else: ?>
                                                <form action="for-edit-logbook.php" method="POST" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="date">Date</label>
                                                            <input type="date" value="<?php echo $logbook['date'] ?>" class="form-control w-50" id="date" name="date" required>
                                                        </div>
                                                        <div class="form-group d-flex">
                                                            <div>
                                                                <label for="startTime">Start Time</label>
                                                                <input type="time" value="<?php echo $logbook['starttime'] ?>" class="form-control" id="startTime" name="startTime" required>
                                                            </div>
                                                            <div style="margin-left: 10px;">
                                                                <label for="endTime">End Time</label>
                                                                <input type="time" value="<?php echo $logbook['endtime'] ?>" class="form-control" id="endTime" name="endTime" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <label for="method">Method</label>
                                                                <select class="form-control w-50" id="method" name="method" value="<?php echo $logbook['method'] ?>">
                                                                    <option value="online">Online</option>
                                                                    <option value="Physical">Physical</option>
                                                                </select>
                                                            </div>
                                                        <div class="form-group">
                                                            <label for="activity">Activity</label>
                                                            <input type="text" value="<?php echo $logbook['activity'] ?>" class="form-control" id="activity" name="activity">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>File</label>
                                                            <input type="file"  class="form-control" style="width: 230px;" name="file">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="discussion">Discussion</label>
                                                            <textarea class="form-control" id="discussion" rows="5" name="discuss"><?php echo $logbook['discuss'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" value="<?php echo $logbook['id'] ?>" name="id" hidden>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
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
    <!-- [ Main Content ] start -->

    <!-- Required Js -->
    <script src="\espres-code\public\assets/js/vendor-all.min.js"></script>
	<script src="\espres-code\public\assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="\espres-code\public\assets/js/pcoded.min.js"></script>
    <script src="\espres-code\node_modules\bootstrap\dist\js\bootstrap.min.js"></script>
    <script src="\espres-code\node_modules\tinymce\tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#discussion'
        });
    </script>

</body>
</html>