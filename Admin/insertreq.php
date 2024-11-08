<?php
session_start(); // Start the session at the very beginning
define('TITLE', 'Requester - Add New Requester');
define('PAGE', 'requester');
include('includs/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_adminLogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    // Redirect to the login page if not logged in
    echo "<script> location.href='adminLogin.php';</script>";
    exit();
}

if (isset($_REQUEST['reqsubmit'])) {
    if (empty($_REQUEST['r_name']) || empty($_REQUEST['r_email']) || empty($_REQUEST['r_password'])) {
        // Added 'empty()' to check if any fields are missing, ensuring all fields are filled
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
    } else {
        // Sanitize input data to prevent SQL injection
        $r_name = $conn->real_escape_string($_REQUEST['r_name']);
        $r_email = $conn->real_escape_string($_REQUEST['r_email']);
        $r_password = $conn->real_escape_string($_REQUEST['r_password']);

        $sql = "INSERT INTO requesterlogin_tb (r_name, r_email, r_password) VALUES ('$r_name', '$r_email', '$r_password')";

        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Requester Added Successfully </div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-
            2" role="alert"> Unable to Add Requester </div>';
        }
    }
}
?>

<style>
    body {
        background-color: #2c2f33;
        /* Dark background for dashboard */
        color: #ffffff;
        /* White text */
        font-family: 'Arial', sans-serif;
    }

    .form-control {
        background-color: #3a3f44;
        /* Darker form background */
        color: #ffffff;
        /* White text */
        border: 1px solid #5a5e63;
        /* Subtle border */
    }

    .form-control:focus {
        background-color: #44494e;
        border-color: #6c757d;
        color: #ffffff;
    }

    .btn {
        border-radius: 20px;
        /* Rounded buttons for a modern look */
    }

    .btn-danger {
        background-color: #e74c3c;
        /* Bright red button */
        border-color: #e74c3c;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .alert {
        background-color: #3a3f44;
        /* Matching the dashboard's color theme */
        color: #ffffff;
        border: 1px solid #5a5e63;
    }

    .alert-warning {
        background-color: #f39c12;
        color: #2c2f33;
    }

    .alert-success {
        background-color: #2ecc71;
        color: #ffffff;
    }

    .alert-danger {
        background-color: #e74c3c;
        color: #ffffff;
    }

    .card {
        background-color: #23272b;
        border: none;
        border-radius: 10px;
        margin-bottom: 1.5rem;
        color: #ffffff;
    }

    .card-header {
        font-size: 1.2rem;
        font-weight: bold;
        background-color: transparent;
        border-bottom: none;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card .btn {
        margin-top: 1rem;
        border-radius: 20px;
        padding: 0.5rem 1rem;
    }

    .table {
        background-color: #2c2f33;
        color: #ffffff;
        /* Set table content text color to white */
        margin-top: 1.5rem;
    }

    .table thead {
        background-color: #23272b;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #33373c;
        color: white;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #2c2f33;
    }

    .table-hover tbody tr:hover {
        background-color: #44494e;
    }

    .bg-dark {
        background-color: #23272b !important;
    }

    .bg-dark p {
        color: #ffffff;
        padding: 1rem;
        border-radius: 10px;
    }
</style>

<div class="col-sm-6 mx-3 mt-5 bg-secondary text-white p-4 rounded">
    <h3 class="text-center">Add New Requester</h3>
    <form action="" method="post">
        <div class="form-group">
            <label for="r_name">Name</label>
            <input type="text" class="form-control" id="r_name" name="r_name">
        </div>

        <div class="form-group mt-2">
            <label for="r_email">Email</label>
            <input type="email" class="form-control" id="r_email" name="r_email">
        </div>

        <div class="form-group mt-2">
            <label for="r_password">Password</label>
            <input type="password" class="form-control" id="r_password" name="r_password">
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-danger" name="reqsubmit" id="reqsubmit">Submit</button>
            <a href="requester.php" class="btn btn-secondary">Close</a>

        </div>

        <?php if(isset($msg)) echo $msg; ?>
        


    </form>


</div>



<script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000); // Hide alert after 3 seconds
</script>
</body>

</html>

<?php include('includs/footer.php'); ?>