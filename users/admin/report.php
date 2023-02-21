<?php
include 'connection.php';

session_start();

if (isset($_SESSION["userid"])) {
    if (($_SESSION["userid"]) == "" or $_SESSION['usertype'] != 'admin') {
        header("location: ../login.php");
    } else {
        $userid = $_SESSION["userid"];
    }
} else {
    header("location: ../login.php");
}

$sql_stmnt = $pdo->prepare("SELECT * FROM admin WHERE userid = '$userid'");
$sql_stmnt->execute();
$user_db = $sql_stmnt->fetch(PDO::FETCH_ASSOC);

$sv_sql = $pdo->prepare("SELECT * FROM supervisor");
$sv_sql->execute();
$svlist = $sv_sql->fetchAll();

$program = $pdo->prepare("SELECT DISTINCT pcode FROM student");
$program->execute();
$programlist = $program->fetchAll();

if ($_POST) {
    $filter = $_POST['filter'] ?? '';
    $user = $_POST['user'];

    $sql = $pdo->prepare("SELECT * FROM student WHERE pcode = '$user'");
    $sql->execute();
    $result = $sql->fetchAll();

    if ($user == 1) {
        $sql = $pdo->prepare("SELECT * FROM student");
        $sql->execute();
        $result = $sql->fetchAll();
    }
} else {
    $sql = $pdo->prepare("SELECT * FROM student");
    $sql->execute();
    $result = $sql->fetchAll();
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
                    <!-- <li class="nav-item">
                        <a href="profile.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Profile</span></a>
                    </li> -->
                    <li class="nav-item">
                        <a href="supervisor-profile.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Supervisor</span></a>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i class="bi bi-mortarboard-fill"></i></span><span class="pcoded-mtext">Student</span></a>
                        <ul class="pcoded-submenu">
                            <li class=""><a href="student-profile.php" class="">Profile</a></li>
                            <li class=""><a href="logbook.php" class="">Logbook</a></li>
                        </ul>
                    </li>
                    <li class="nav-item active">
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

                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Report</h5>
                                        </div>
                                        <div class="col-sm-12 p-0" style="overflow: scroll;">
                                            <hr>
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Student</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Supervisor</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content p-0 shadow-none " id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <nav class="navbar navbar-expand-lg ">
                                                        <div class="container-fluid" style="width: 100%;">
                                                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                                <form action="" method="post" style="padding-top: 20px;">
                                                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                                        <li class="nav-item">
                                                                            <select class="form-select" aria-label="Disabled select example" name="user">
                                                                                <option value="1">All</option>
                                                                                <?php foreach ($programlist as $p) : ?>
                                                                                    <option value="<?php echo $p['pcode'] ?>"><?php echo $p['pcode'] ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <p class="nav-link active">Sort by :</p>
                                                                        </li>
                                                                        <div class="form-check" style="padding-top: 10px; margin-left: 15px; color: black">
                                                                            <input class="form-check-input" type="radio" name="filter" id="flexRadioDefault1" value="1">
                                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                                Complete
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check" style="padding-top: 10px; margin-left: 15px; color: black">
                                                                            <input class="form-check-input" type="radio" name="filter" id="flexRadioDefault2" value="2">
                                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                                Not Complete
                                                                            </label>
                                                                        </div>
                                                                        <li class="nav-item" style="padding: 12px;">
                                                                            <button type="submit" class="btn btn-primary btn-sm" style="padding: 5px; width: 55px">Sort</button>
                                                                        </li>
                                                                    </ul>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </nav>
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">ID</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Program Code</th>
                                                                <th scope="col">Supervisor</th>
                                                                <th scope="col">Co-Supervisor</th>
                                                                <th scope="col">Research Title</th>
                                                                <th scope="col">Total Hour This Month</th>
                                                                <th scope="col">Total Hour</th>
                                                                <th scope="col">Total Logbook</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($result as $student) :
                                                                $user_id = $student['userid'];
                                                                $current_month = date("m");
                                                                $current_year = date("Y");

                                                                $logbook_query = $pdo->prepare("SELECT * FROM logbook WHERE userid = ? AND MONTH(date) = ? AND YEAR(date) = ?");
                                                                $logbook_query->execute([$user_id, $current_month, $current_year]);
                                                                $logbook_this_month = $logbook_query->fetchAll();

                                                                $total_seconds_this_month = 0;
                                                                foreach ($logbook_this_month as $log) :
                                                                    $time = explode(":", $log['totaltime']);
                                                                    $total_seconds_this_month += (int) $time[0] * 3600 + (int) $time[1] * 60;
                                                                endforeach;
                                                                $total_time_this_month = sprintf('%02d:%02d', ($total_seconds_this_month / 3600), ($total_seconds_this_month / 60 % 60));

                                                                // ----------------------------
                                                                $logbook_query2 = $pdo->prepare("SELECT * FROM logbook WHERE userid = ? AND YEAR(date) = ?");
                                                                $logbook_query2->execute([$user_id, $current_year]);
                                                                $logbook_this_month2 = $logbook_query2->fetchAll();

                                                                $total_seconds_this_month2 = 0;
                                                                foreach ($logbook_this_month2 as $log) :
                                                                    $time = explode(":", $log['totaltime']);
                                                                    $total_seconds_this_month2 += (int) $time[0] * 3600 + (int) $time[1] * 60;
                                                                endforeach;
                                                                $total_time_this_month2 = sprintf('%02d:%02d', ($total_seconds_this_month2 / 3600), ($total_seconds_this_month2 / 60 % 60));
                                                                // ----------------------------

                                                                $user_query = $pdo->prepare("SELECT * FROM student WHERE userid = ?");
                                                                $user_query->execute([$user_id]);
                                                                $user_info = $user_query->fetch(PDO::FETCH_ASSOC);
                                                                $time_to_achieve = $user_info['total_time'];

                                                                $logbook_query = $pdo->prepare("SELECT * FROM logbook WHERE userid = ?");
                                                                $logbook_query->execute([$user_id]);
                                                                $logbook = $logbook_query->fetchAll();

                                                                $total_seconds = 0;
                                                                foreach ($logbook as $log) :
                                                                    $time = explode(":", $log['totaltime']);
                                                                    $total_seconds += (int) $time[0] * 3600 + (int) $time[1] * 60;
                                                                endforeach;
                                                                $total_time = sprintf('%02d:%02d', ($total_seconds / 3600), ($total_seconds / 60 % 60));

                                                                $total_logbook = $logbook_query->rowCount();

                                                                $report_query = $pdo->prepare("SELECT * FROM report WHERE userid = ?");
                                                                $report_query->execute([$user_id]);
                                                                $reports = $report_query->fetchAll(); ?>
                                                                <?php if (isset($filter)) : ?>
                                                                    <?php if ($filter == 1) : ?>

                                                                        <?php if ($total_seconds_this_month / 3600 >= $time_to_achieve) : ?>
                                                                            <tr>
                                                                                <td><?php echo $student['userid']; ?></td>
                                                                                <td><?php echo strtoupper($student['uname']) ?></td>
                                                                                <td><?php echo $student['pcode']; ?></td>
                                                                                <td><?php echo strtoupper($student['svname']) ?></td>
                                                                                <td><?php echo strtoupper($student['cosv']) ?></td>
                                                                                <td><?php echo $student['title'] ?></td>
                                                                                <td><?php echo $total_time_this_month ?></td>
                                                                                <td><?php echo $total_time_this_month2 ?></td>
                                                                                <td><?php echo $total_logbook ?></td>
                                                                            </tr>
                                                                        <?php endif; ?>

                                                                    <?php elseif ($filter == 2) : ?>

                                                                        <?php if ($total_seconds_this_month / 3600 < $time_to_achieve) : ?>
                                                                            <tr>
                                                                                <td><?php echo $student['userid']; ?></td>
                                                                                <td><?php echo strtoupper($student['uname']) ?></td>
                                                                                <td><?php echo $student['pcode']; ?></td>
                                                                                <td><?php echo strtoupper($student['svname']) ?></td>
                                                                                <td><?php echo strtoupper($student['cosv']) ?></td>
                                                                                <td><?php echo $student['title'] ?></td>
                                                                                <td><?php echo $total_time_this_month ?></td>
                                                                                <td><?php echo $total_time_this_month2 ?></td>
                                                                                <td><?php echo $total_logbook ?></td>
                                                                            </tr>
                                                                        <?php endif; ?>

                                                                    <?php else : ?>

                                                                        <tr>
                                                                            <td><?php echo $student['userid']; ?></td>
                                                                            <td><?php echo strtoupper($student['uname']) ?></td>
                                                                            <td><?php echo $student['pcode']; ?></td>
                                                                            <td><?php echo strtoupper($student['svname']) ?></td>
                                                                            <td><?php echo strtoupper($student['cosv']) ?></td>
                                                                            <td><?php echo $student['title'] ?></td>
                                                                            <td><?php echo $total_time_this_month ?></td>
                                                                                <td><?php echo $total_time_this_month2 ?></td>
                                                                            <td><?php echo $total_logbook ?></td>
                                                                        </tr>

                                                                    <?php endif; ?>
                                                                <?php else : ?>
                                                                    <tr>
                                                                        <td><?php echo $student['userid']; ?></td>
                                                                        <td><?php echo strtoupper($student['uname']) ?></td>
                                                                        <td><?php echo $student['pcode']; ?></td>
                                                                        <td><?php echo strtoupper($student['svname']) ?></td>
                                                                        <td><?php echo strtoupper($student['cosv']) ?></td>
                                                                        <td><?php echo $student['title'] ?></td>
                                                                        <td><?php echo $total_time_this_month ?></td>
                                                                                <td><?php echo $total_time_this_month2 ?></td>
                                                                        <td><?php echo $total_logbook ?></td>
                                                                    </tr>
                                                                <?php endif; ?>

                                                            <?php endforeach; ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <table class="table text-center">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">ID</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">Phone</th>
                                                                <th scope="col">Total Student</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($svlist as $sv) : ?>
                                                                <?php
                                                                $svid = $sv['userid'];
                                                                $cosvid = $sv['userid'];
                                                                $student_query = $pdo->prepare("SELECT * FROM student WHERE svid = :svid OR cosvid = :cosvid");
                                                                $student_query->bindParam(':svid', $svid, PDO::PARAM_STR);
                                                                $student_query->bindParam(':cosvid', $cosvid, PDO::PARAM_STR);
                                                                $student_query->execute();

                                                                $student = $student_query->fetchAll();
                                                                $total_student = $student_query->rowCount();
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $sv['userid']; ?></td>
                                                                    <td><?php echo strtoupper($sv['uname']) ?></td>
                                                                    <td><?php echo $sv['email']; ?></td>
                                                                    <td><?php echo $sv['phone'] ?></td>
                                                                    <td><?php echo $total_student; ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
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
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="\espres-code\public\assets/js/vendor-all.min.js"></script>
    <script src="\espres-code\public\assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="\espres-code\public\assets/js/pcoded.min.js"></script>
    <script src="\espres-code\node_modules\bootstrap\dist\js\bootstrap.min.js"></script>

</body>

</html>