<?php
session_start(); // Start the session at the very beginning

define('TITLE', 'Dashboard');
define('PAGE', 'dashboard');

// Check if the admin is logged in
if (isset($_SESSION['is_adminLogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    // Redirect to the login page if not logged in
    echo "<script> location.href='adminLogin.php';</script>";
    exit();
}

include('includs/header.php'); // Include files after session start
include('../dbConnection.php');

// Fetch max request id
$sql = "SELECT max(request_id) FROM submitrequest_tb";
$result = $conn->query($sql);
$row = $result->fetch_row();
$submitrequest = $row[0];

// Fetch max assigned work id
$sql = "SELECT max(rno) FROM assignwork_tb";
$result = $conn->query($sql);
$row = $result->fetch_row();
$assignwork = $row[0];

// Fetch total technicians
$sql = "SELECT * FROM technician_tb";
$result = $conn->query($sql);
$totaltech = $result->num_rows;

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


<div class="col-sm-9 col-md-10">
    <div class="row text-center mx-5">
        <!-- Request Received Card -->
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Requests Received</div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $submitrequest; ?></h4>
                    <a href="request.php" class="btn btn-light">View</a>
                </div>
            </div>
        </div>

        <!-- Assigned Work Card -->
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Assigned Work</div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $assignwork; ?></h4>
                    <a href="work.php" class="btn btn-light">View</a>
                </div>
            </div>
        </div>

        <!-- No. of Technicians Card -->
        <div class="col-sm-4 mt-5">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">No. of Technicians</div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $totaltech; ?></h4>
                    <a href="technician.php" class="btn btn-light">View</a>
                </div>
            </div>
        </div>
    </div>

    <!-- List of Requesters Table -->
    <div class="mx-5 mt-5 text-center">
        <p class="bg-dark text-white p-2">List of Requesters</p>
        <?php
        $sql = "SELECT * FROM requesterlogin_tb";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo '
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Requester ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["r_login_id"] . '</td>';
                echo '<td>' . $row["r_name"] . '</td>';
                echo '<td>' . $row["r_email"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>
            </table>';
        } else {
            echo '<div class="alert alert-warning">No requesters found.</div>';
        }
        ?>
    </div>
</div>

<?php include('includs/footer.php') ?>