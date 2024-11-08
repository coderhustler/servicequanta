<?php
session_start(); // Start the session at the very beginning
define('TITLE', 'Technician - Edit');
define('PAGE', 'technician');
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
    <h3 class="text-center">Update Technician Details</h3>
    <?php
    if (isset($_REQUEST['edit'])) {
        // Sanitize the ID input to prevent SQL injection
        $id = $conn->real_escape_string($_REQUEST['id']); // Changed to sanitize the input
        $sql = "SELECT * FROM technician_tb WHERE empid = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            // Added this check to handle cases where the ID is invalid
            echo '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Invalid Requester ID </div>';
        }
    }

    if (isset($_REQUEST['empupdate'])) { // Changed to check for the correct button name 'empupdate'
        if (empty($_REQUEST['empid']) || empty($_REQUEST['empName']) || empty($_REQUEST['empCity']) || empty($_REQUEST['empMobile'])|| empty($_REQUEST['empEmail'])) {
            // Added 'empty()' to check if any fields are missing, ensuring all fields are filled
            $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
        } else {
            // Sanitize input data to prevent SQL injection
            $empid = $conn->real_escape_string($_REQUEST['empid']); // Sanitize input
            $empName = $conn->real_escape_string($_REQUEST['empName']);         // Sanitize input

            $empCity = $conn->real_escape_string($_REQUEST['empCity']);

            $empMobile = $conn->real_escape_string($_REQUEST['empMobile']);
            

            $empEmail = $conn->real_escape_string($_REQUEST['empEmail']);       // Sanitize input

            $sql = "UPDATE technician_tb SET empName = '$empName', empEmail = '$empEmail', empCity = '$empCity', empMobile='$empMobile' WHERE empid = '$empid'";
            // Removed 'empid' update in the SET clause because it should not be changed

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
            <label for="empid">Employee ID</label>
            <input type="number" class="form-control text-dark" id="empid" name="empid" 
            value="<?php if (isset($row['empid'])) { echo $row['empid']; } ?>" 
            readonly style="background-color: #87CEEB;">
            <!-- Kept 'readonly' to prevent changing ID and added light blue background for clarity -->
        </div>

        <div class="form-group mt-2">
            <label for="empName">Name</label>
            <input type="text" class="form-control" id="empName" name="empName" 
            value="<?php if (isset($row['empName'])) { echo $row['empName']; } ?>">
        </div>

        <div class="form-group mt-2">
            <label for="empCity">City</label>
            <input type="text" class="form-control" id="empCity" name="empCity" 
            value="<?php if (isset($row['empCity'])) { echo $row['empCity']; } ?>">
        </div>

        <div class="form-group mt-2">
            <label for="empMobile">Mobile</label>
            <input type="number" class="form-control" id="empMobile" name="empMobile" 
            value="<?php if (isset($row['empMobile'])) { echo $row['empMobile']; } ?>">
        </div>

        <div class="form-group mt-2">
            <label for="empEmail">Email ID</label>
            <input type="email" class="form-control" id="empEmail" name="empEmail" 
            value="<?php if (isset($row['empEmail'])) { echo $row['empEmail']; } ?>">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger mt-3" id="empupdate" name="empupdate">Update</button>
            <!-- Changed button name to 'empupdate' to match the POST check in PHP -->
            <a href="technician.php" class="btn btn-primary mt-3">Close</a>
        </div>

        <?php if (isset($msg)) { echo $msg; } ?>
        <!-- Display the message if it's set, showing feedback to the user -->
    </form>
</div>

<?php include('includs/footer.php'); ?>
