<?php
include('../dbConnection.php');
session_start();
if (!isset($_SESSION['is_Login'])) {
    if (isset($_REQUEST['rEmail'])) {
        $rEmail = mysqli_real_escape_string($conn, trim($_REQUEST['rEmail']));
        $rPassword = mysqli_real_escape_string($conn, trim($_REQUEST['rPassword']));

        $sql = "SELECT r_email, r_password FROM requesterlogin_tb WHERE r_email = '" . $rEmail . "' AND r_password = '" . $rPassword . "' limit 1";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $_SESSION['is_Login'] = true;
            $_SESSION['rEmail'] = $rEmail;
            echo "<script> location.href='RequesterProfile.php';</script>";
            exit;
        } else {
            $msg = '<div class="alert alert-warning mt-2">Enter Valid Email and Password</div>';
        }
    }
} else {
    echo "<script> location.href='RequesterProfile.php';</script>";
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
    <title>Login</title>
    <style>
        body {
            background: linear-gradient(135deg, #1f1f1f, #343a40); /* Dark gradient background */
            color: #eaeaea; /* Light text color */
            font-family: Arial, sans-serif;
        }

        .form-control {
            border-radius: 0.375rem; /* Slightly rounded corners */
            border: 1px solid #495057; /* Dark border */
            background-color: #6c757d; /* Darker input background */
            color: #eaeaea; /* Light text color */
        }

        .form-control::placeholder {
            color: #ced4da; /* Placeholder text color */
        }

        .form-label {
            font-weight: bold;
            color: #eaeaea; /* Light label color */
        }

        .alert {
            display: none;
        }

        .shadow-lg {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        .bg-white {
            background-color: #495057; /* Dark background for form */
        }

        .btn-danger {
            background: linear-gradient(45deg, #dc3545, #c82333); /* Gradient red */
            border: none; /* Remove border */
        }

        .btn-danger:hover {
            background: linear-gradient(45deg, #c82333, #bd2130); /* Darker red on hover */
        }

        .btn-info {
            background: linear-gradient(45deg, #17a2b8, #138496); /* Gradient teal */
            border: none; /* Remove border */
        }

        .btn-info:hover {
            background: linear-gradient(45deg, #138496, #117a8b); /* Darker teal on hover */
        }

        .text-primary {
            color: #007bff; /* Primary color */
        }

        .text-muted {
            color: #6c757d; /* Muted text color */
        }

        .rounded {
            border-radius: 0.375rem; /* Rounded corners for form */
        }

        .custom-margin {
            margin-top: 8vh;
        }

        .form-group {
            margin-bottom: 1.5rem; /* Increased spacing between form groups */
        }

        .btn {
            border-radius: 0.25rem; /* Rounded corners for buttons */
            padding: 0.75rem 1.25rem; /* Padding for buttons */
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-sm-8 col-md-6 col-lg-4">
                <div class="text-center mb-4">
                    <i class="fas fa-stethoscope fa-4x text-primary"></i>
                    <h1 class="mt-3">Online Service Management System</h1>
                    <p class="text-muted">Customer Requested Area</p>
                </div>

                <form action="" method="post" class="shadow-lg p-4 rounded border bg-dark">
                    <div class="form-group mb-4">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> E-mail</label>
                        <input type="email" name="rEmail" class="form-control" placeholder="Enter your email" required>
                        <div class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="pass" class="form-label"><i class="fas fa-key"></i> Password</label>
                        <input type="password" name="rPassword" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-danger w-100 mb-3">Login</button>
                    <?php if (isset($msg)) { echo $msg; } ?>
                </form>

                <div class="text-center">
                    <a href="../index.php" class="btn btn-info">Back to Home</a>
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
