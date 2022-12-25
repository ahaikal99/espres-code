<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fontawesome icon -->
    <link rel="stylesheet" href="public/assets/fonts/fontawesome/css/fontawesome-all.min.css">
    <!-- animation css -->
    <link rel="stylesheet" href="public/assets/plugins/animation/css/animate.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="public/assets/css/style.css">

    <title>Sign Up</title>
</head>
<body>
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
                        <i class="feather icon-user-plus auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Sign up</h3>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Full Name" name="fname" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Student ID" name="userid" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Program Code" name="code" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                        </div>
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-fill d-inline">
                                <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-1" onclick="showPassword()">
                                <label for="checkbox-fill-1" class="cr"> Show Password</label>
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control" placeholder="Confirm Password" id="cpassword" name="cpassword" required>
                        </div>
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-fill d-inline">
                                <input type="checkbox" name="checkbox-fill-2" id="checkbox-fill-2" onclick="showcPassword()">
                                <label for="checkbox-fill-2" class="cr"> Show Password</label>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary shadow-2 mb-4" type="submit">Sign up</button>
                    </form>
                    <p class="mb-0 text-muted">Allready have an account? <a href="auth-signin.php"> Log in</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src="public/assets/js/vendor-all.min.js"></script>
	<script src="public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
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