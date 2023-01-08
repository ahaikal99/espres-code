<?php
include 'connection.php';

session_start();

    if(isset($_SESSION["userid"])){
        if(($_SESSION["userid"])=="" or $_SESSION['usertype']!='supervisor'){
            header("location: ../login.php");
        }else{
            $userid=$_SESSION["userid"];
        }

    }else{
        header("location: ../login.php");
    }

$error = "";

    if($_POST){
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $check_email = $pdo->prepare("SELECT * FROM supervisor WHERE userid = '$userid'");
        $check_email->execute();
        $result = $check_email -> fetch(PDO::FETCH_ASSOC);

        if($password == $cpassword){
            $update = $pdo->prepare("UPDATE supervisor SET password = '$password' WHERE userid = '$userid'");
            $update->execute();
            
            header('Location: dashboard.php');
        } else{
            $error = "Password not match";
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
    <link rel="stylesheet" href="\espres-code/public\assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="\espres-code/public\assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="\espres-code/public\assets\css\style.css">

    <title>Home</title>
</head>
<body>
    <div class="auth-wrapper" style="background-color: rgb(255, 255, 255);">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <form action="" method="post">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-mail auth-icon"></i>
                    </div>
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="height: 55px;">
                            <p><?php echo $error ?></p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <h3 class="mb-4">Change Password</h3>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="New Password" name="password" id="password">
                    </div>
                    <div class="form-group text-left">
                        <div class="checkbox checkbox-fill d-inline">
                            <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-1" onclick="showPassword()">
                            <label for="checkbox-fill-1" class="cr"> Show Password</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword" id="cpassword">
                    </div>
                    <div class="form-group text-left">
                        <div class="checkbox checkbox-fill d-inline">
                            <input type="checkbox" name="checkbox-fill-2" id="checkbox-fill-2" onclick="showcPassword()">
                            <label for="checkbox-fill-2" class="cr"> Show Password</label>
                        </div>
                    </div>
                    <button class="btn btn-primary mb-4 shadow-2">Confirm</button>
                    <a href="dashboard.php" class="btn btn-danger mb-4 shadow-2" style="color: white;">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Required Js -->
    <script src="\espres-code\public\assets/js/vendor-all.min.js"></script>
	<script src="\espres-code\public\assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="\espres-code\public\assets/js/pcoded.min.js"></script>
    <script src="\espres-code\node_modules\bootstrap\dist\js\bootstrap.min.js"></script>
    <script>
        
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
        }

        function showcPassword() {
            var x = document.getElementById("cpassword");
            if (x.type === "password") {
            x.type = "text";
            } else {
            x.type = "password";
            }
        }
    </script>

    

</body>
</html>