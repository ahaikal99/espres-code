<?php
include 'connection.php';

session_start();

    if(isset($_SESSION["userid"])){
        if(($_SESSION["userid"])=="" or $_SESSION['usertype']!='admin'){
            header("location: ../login.php");
        }else{
            $userid=$_SESSION["userid"];
            $_SESSION["studentid"]="";
        }

    }else{
        header("location: ../login.php");
    }
    // echo var_dump($_SESSION);
    $sql_stmnt = $pdo->prepare("SELECT * FROM admin WHERE userid = '$userid'");
    $sql_stmnt->execute();
    $user_db = $sql_stmnt -> fetch(PDO::FETCH_ASSOC);

    // $db_list = $pdo->prepare("SELECT * FROM student");
    // $db_list->execute();
    // $student_list = $db_list -> fetchAll();
// ----------------------------------
    $per_page = 10; // number of results per page
    $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page number
    $start = ($page-1) * $per_page; // starting limit for query

        $search = $_GET['search']?? "";

        if($search){
            $query = $pdo->prepare("SELECT * FROM student WHERE email LIKE '%$search%' OR uname LIKE '%$search%' OR pcode LIKE '%$search%' OR userid LIKE '%$search%' ORDER BY uname DESC");
            $total_results = $pdo->query("SELECT COUNT(*) FROM student WHERE email LIKE '%$search%' OR uname LIKE '%$search%' OR pcode LIKE '%$search%' OR userid LIKE '%$search%'")->fetchColumn();
        } else{
            $query = $pdo->prepare("SELECT * FROM student LIMIT :start, :per_page");
            $query->bindValue(':start', $start, PDO::PARAM_INT);
            $query->bindValue(':per_page', $per_page, PDO::PARAM_INT);
            $total_results = $pdo->query("SELECT COUNT(*) FROM student")->fetchColumn();
        }

        $per_page = 10; // number of results per page
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1; // current page number
        $start = ($page-1) * $per_page; // starting limit for query

        $query->execute();
        $student_list = $query->fetchAll();

        // number of pages
        $num_pages = ceil($total_results / $per_page);

        $count = ($page-1) * $per_page + 1; // current number
        
        $program = $pdo->prepare("SELECT DISTINCT pcode FROM student");
        $program->execute();
        $programlist = $program->fetchAll();

        
        if (isset($_POST['new-hour']) && isset($_POST['program-code'])) {
            foreach ($_POST['new-hour'] as $pcode => $total_time) {
                $update = $pdo->prepare("UPDATE student SET total_time = :total_time WHERE pcode = :pcode");
                $update->execute([
                    ':total_time' => $total_time,
                    ':pcode' => $pcode,
                ]);
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Meeting Hour</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" style="margin-left: 100px;">
                <?php foreach($programlist as $code): ?>
                    <?php
                        $hr = $code['pcode'];
                        $newhour = $pdo->prepare("SELECT total_time FROM student WHERE pcode = :hr");
                        $newhour->execute([':hr' => $hr]);
                        $new = $newhour->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="input-group flex-nowrap mb-2" style="max-width: 300px;">
                        <span class="input-group-text" id="addon-wrapping"><?php echo $code['pcode']; ?></span>
                        <input type="text" class="form-control" name="new-hour[<?php echo $code['pcode']; ?>]" value="<?php echo $new['total_time'] ?? ''; ?> Hour">
                        <input type="hidden" class="form-control" name="program-code[<?php echo $code['pcode']; ?>]" value="<?php echo $code['pcode']; ?>">
                    </div>
                <?php endforeach; ?>
                <input type="submit" value="Update" class="btn btn-primary">
            </form>
        </div>
    </div>
    </div>

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
                                            <h5>Student</h5>
                                        </div>
                                        <form action="" method="get">
                                            <div class="input-group mb-3 m-auto" style="max-width: 600px;">
                                                <input type="text" class="form-control" placeholder="Search" name="search">
                                                <button class="btn bg-primary" type="submit" id="button-addon2"><i style="color: white; font-size: 20px; margin: auto" class="feather icon-search"></i></button>
                                            </div>
                                            <div style="margin-left: 20px;">
                                                <!-- Button trigger modal -->
                                                <button style="right: 0px" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Meeting Hour</button>
                                            </div>
                                        </form>
                                        <?php if(!$student_list): ?>
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
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Program Code</th>
                                                            <th>Detail</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($student_list as $data): ?>
                                                        <tr>
                                                            <td scope="row"><?php echo $count++ ?></td>
                                                            <td><?php echo $data['userid'] ?></td>
                                                            <td><?php echo strtoupper($data['uname']) ?></td>
                                                            <td><?php echo $data['pcode'] ?></td>
                                                            <td>
                                                                <form action="list-logbook.php" method="post">
                                                                    <input type="hidden" name="id" value="<?php echo $data['userid'] ?>">
                                                                    <button type="submit" class="label bg-primary text-white f-12" style="border-radius: 10px; border-width: 0px;">View</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <?php if($total_results>10): ?>
                                                    <nav>
                                                        <ul class="pagination">
                                                            <li class="<?php echo ($page <= 1) ? 'page-item disabled':'page-item' ?>"><a class="page-link" href="?page=<?php echo $page-1; ?>" >Previous</a></li>
                                                            <?php for($i = 1; $i <= $num_pages; $i++): ?>
                                                            <li class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                                                                <a class="page-link" href="?page=<?php echo $i; ?>">
                                                                    <?php echo $i; ?>
                                                                </a>
                                                            </li>
                                                            <?php endfor; ?>
                                                            <li class="<?php echo ($page >= $num_pages) ? 'page-item disabled' : 'page-item'; ?>"><a class="page-link" href="?page=<?php echo $page+1; ?>">Next</a></li>
                                                        </ul>
                                                    </nav>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
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