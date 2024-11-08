<?php
include('../dbConnection.php');
session_start();
if (!isset($_SESSION['is_adminLogin'])) {
    if (isset($_REQUEST['aEmail'])) {
        $aEmail = mysqli_real_escape_string($conn, trim($_REQUEST['aEmail']));
        $aPassword = mysqli_real_escape_string($conn, trim($_REQUEST['aPassword']));
    
        $sql = "SELECT a_email, a_password FROM adminlogin_tb WHERE a_email = '" . $aEmail . "' AND a_password = '" . $aPassword . "' LIMIT 1";
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {
            $_SESSION['is_adminLogin'] = true;
            $_SESSION['aEmail'] = $aEmail;
            echo "<script> location.href='dashboard.php';</script>";
            exit;
        } else {
            $msg = '<div class="alert alert-warning mt-2">Enter Valid Email and Password</div>';
        }
    }
} else {
    echo "<script> location.href='dashboard.php';</script>";
}
?>

<script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000); // 3 seconds
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <style>
        body {
            background-color: #212121; /* Dark background color */
            color: #e0e0e0; /* Light text color */
            font-family: 'Arial', sans-serif;
        }
        .container-fluid {
            background-color: #333; /* Darker background for the form container */
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6); /* Subtle shadow for depth */
            max-width: 500px;
            margin-top: 5vh;
        }
        .form-control {
            background-color: #444; /* Darker input background */
            color: #e0e0e0; /* Light text color */
            border: 1px solid #555; /* Slightly lighter border */
        }
        .form-control::placeholder {
            color: #888; /* Placeholder text color */
        }
        .btn-outline-danger {
            border-color: #dc3545; /* Button border color */
            color: #dc3545; /* Button text color */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
        }
        .btn-outline-danger:hover {
            background-color: #dc3545; /* Button background on hover */
            color: #fff; /* Button text color on hover */
        }
        .alert {
            color: #856404; /* Alert text color */
            background-color: #d4edda; /* Alert background color */
            border-color: #c3e6cb; /* Alert border color */
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
        }
        .custom-margin {
            margin-top: 8vh;
        }
        .brand-icon {
            font-size: 50px;
            color: #dc3545; /* Accent color */
        }
        .brand-text {
            font-size: 24px;
            color: #e0e0e0; /* Light text color */
        }
        .footer-link {
            color: #17a2b8; /* Link color */
            font-weight: bold;
        }
        .footer-link:hover {
            text-decoration: underline; /* Underline on hover */
        }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="mb-3 mt-5 text-center">
        <i class="fas fa-stethoscope brand-icon"></i>
        <span class="brand-text">Online Service Management System</span>
    </div>

    <p class="text-center" style="font-size: 20px;"><i class="fas fa-user-secret text-danger"></i> Admin Area</p>

    <div class="container-fluid">
        <div class="row justify-content-center custom-margin">
            <div class="col-sm-12 col-md-10">
                <form action="" method="post" class="shadow-lg p-4">
                    <div class="form-group">
                        <label for="email" class="fw-bold ps-2"><i class="fas fa-envelope"></i> E-mail</label>
                        <input type="email" name="aEmail" class="form-control" placeholder="Email">
                        <small class="form-text">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group mt-2">
                        <label for="pass" class="fw-bold ps-2"><i class="fas fa-key"></i> Password</label>
                        <input type="password" name="aPassword" class="form-control" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-outline-danger w-100 mt-5 shadow-sm fw-bold" name="rLogin">Login</button>
                    <?php if (isset($msg)) { echo $msg; } ?>

                </form>

                <div class="text-center">
                    <a href="../index.php" class="btn footer-link mt-3 fw-bold shadow-sm">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript dependencies -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>
</body>

</html>
