<?php
include 'connection.php';

session_start();
$_SESSION["userid"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;
$error = [];

if($_POST){
    $userid = $_POST["userid"];
    $password = $_POST["password"];

    $sql_stmnt = $pdo->prepare("SELECT * FROM users WHERE userid = '$userid'");
    $sql_stmnt->execute();


    if($sql_stmnt -> rowCount() ==1 ){
        $utype = $sql_stmnt->fetch(PDO::FETCH_ASSOC);
        
        if($utype['usertype'] === "student"){
            $db_check = $pdo->prepare("SELECT * FROM student WHERE userid = '$userid' AND password = '$password'");
            $db_check->execute();

            if($db_check -> rowCount() >= 1){
                $_SESSION['userid']=$userid;
                $_SESSION['usertype']='student';
                
                header('location: users\student\dashboard.php');

            } else{
                $error[] = "Wrong credentials: Invalid ID or password";

            }

        } elseif($utype === "supervisor"){
            $db_check = $pdo->prepare("SELECT * FROM supervisor WHERE userid = '$userid' AND password = '$password'");
            $db_check->execute();

            if($db_check -> rowCount() >= 1){
                $_SESSION['userid']=$userid;
                $_SESSION['usertype']='supervisor';
                
                header('location: users\supervisor\dashboard.php');

            } else{
                $error[] = "Wrong credentials: Invalid ID or password";

            }

        } elseif($utype === "admin"){
            $db_check = $pdo->prepare("SELECT * FROM admin WHERE userid = '$userid' AND password = '$password'");
            $db_check->execute();

            if($db_check -> rowCount() >= 1){
                $_SESSION['userid']=$userid;
                $_SESSION['usertype']='admin';
                
                header('location: users\admin\dashboard.php');

            } else{
                $error[] = "Wrong credentials: Invalid ID or password";
                
            }

        }

        
    } elseif(empty($userid) && empty($userid)){
        $error[] = "Please insert ID and password";

    }

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
    <link rel="stylesheet" href="public/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="public/assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="public/assets/css/style.css">
    
    <title>Sign In</title>
</head>
<body>
    <?php if(!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible w-50 rounded m-auto" role="alert">   
            <div><?php foreach($error as $errmsg): ?>
                <li><?php echo $errmsg ?></li>
                <?php endforeach; ?>
            </div>   
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    }

    <?php endif; ?>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-unlock auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Login</h3>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="ID" name="userid">
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" class="form-control" placeholder="password" id="password" name="password">
                        </div>
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-fill d-inline">
                                <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" onclick="showPassword()">
                                <label for="checkbox-fill-a1" class="cr"> Show Password</label>
                            </div>
                        </div>
                        <button class="btn btn-primary shadow-2 mb-4" type="submit">Login</button>
                    </form>
                    <!-- <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html">Reset</a></p> -->
                    <p class="mb-0 text-muted">Don’t have an account? <a href="signup.php">Signup</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="public/assets/js/vendor-all.min.js"></script>
    <script src="public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="node_modules\bootstrap\dist\js\bootstrap.min.js"></script>
    <script>
        
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>