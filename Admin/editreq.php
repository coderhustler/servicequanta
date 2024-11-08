<?php
session_start(); // Start the session at the very beginning
define('TITLE', 'Requester - Edit');
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

<script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000); // Hide alert after 3 seconds
</script>

<!-- Start second column -->
<div class="col-sm-6 mx-3 ms-5 mt-5 bg-secondary text-white p-4 rounded">
    <h3 class="text-center">Update Requester Details</h3>
    <?php
    if (isset($_REQUEST['edit'])) {
        // Sanitize the ID input to prevent SQL injection
        $id = $conn->real_escape_string($_REQUEST['id']); // Changed to sanitize the input
        $sql = "SELECT * FROM requesterlogin_tb WHERE r_login_id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            // Added this check to handle cases where the ID is invalid
            echo '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Invalid Requester ID </div>';
        }
    }

    if (isset($_REQUEST['requpdate'])) { // Changed to check for the correct button name 'requpdate'
        if (empty($_REQUEST['r_login_id']) || empty($_REQUEST['r_name']) || empty($_REQUEST['r_email'])) {
            // Added 'empty()' to check if any fields are missing, ensuring all fields are filled
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
        } else {
            // Sanitize input data to prevent SQL injection
            $r_login_id = $conn->real_escape_string($_REQUEST['r_login_id']); // Sanitize input
            $r_name = $conn->real_escape_string($_REQUEST['r_name']);         // Sanitize input
            $r_email = $conn->real_escape_string($_REQUEST['r_email']);       // Sanitize input

            $sql = "UPDATE requesterlogin_tb SET r_name = '$r_name', r_email = '$r_email' WHERE r_login_id = '$r_login_id'";
            // Removed 'r_login_id' update in the SET clause because it should not be changed

            if ($conn->query($sql) === TRUE) {
                $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
            } else {
                $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
            }
        }
    }
    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="r_login_id">Requester ID</label>
            <input type="text" class="form-control text-dark" id="r_login_id" name="r_login_id" 
            value="<?php if (isset($row['r_login_id'])) { echo $row['r_login_id']; } ?>" 
            readonly style="background-color: #87CEEB;">
            <!-- Kept 'readonly' to prevent changing ID and added light blue background for clarity -->
        </div>

        <div class="form-group mt-2">
            <label for="r_name">Name</label>
            <input type="text" class="form-control" id="r_name" name="r_name" 
            value="<?php if (isset($row['r_name'])) { echo $row['r_name']; } ?>">
        </div>

        <div class="form-group mt-2">
            <label for="r_email">Email ID</label>
            <input type="email" class="form-control" id="r_email" name="r_email" 
            value="<?php if (isset($row['r_email'])) { echo $row['r_email']; } ?>">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger mt-3" id="requpdate" name="requpdate">Update</button>
            <!-- Changed button name to 'requpdate' to match the POST check in PHP -->
            <a href="requester.php" class="btn btn-primary mt-3">Close</a>
        </div>

        <?php if (isset($msg)) { echo $msg; } ?>
        <!-- Display the message if it's set, showing feedback to the user -->
    </form>
</div>

<?php include('includs/footer.php'); ?>
