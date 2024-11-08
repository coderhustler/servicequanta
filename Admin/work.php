<?php
session_start(); // Start the session at the very beginning
define('TITLE', 'Work Order');
define('PAGE', 'work');
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





<!-- start 2nd column -->
 <div class="col-sm-9 col-md-10 mt-5">
    <?php 
    $sql = "SELECT * FROM assignwork_tb";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Request ID</th>';
        echo '<th scope="col">Request Info</th>';
        echo '<th scope="col">Name</th>';
        echo '<th scope="col">Address</th>';
        echo '<th scope="col">City</th>';
        echo '<th scope="col">Mobile</th>';
        echo '<th scope="col">Technician</th>';
        echo '<th scope="col">Assigned Date</th>';
        echo '<th scope="col">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<th scope="row">'.$row['request_id'].'</th>';
            echo '<td>'.$row['request_info'].'</td>';
            echo '<td>'.$row['requester_name'].'</td>';
            echo '<td>'.$row['requester_add2'].'</td>';
            echo '<td>'.$row['requester_city'].'</td>';
            echo '<td>'.$row['requester_mobile'].'</td>';
            echo '<td>'.$row['assign_tech'].'</td>';
            echo '<td>'.$row['assign_date'].'</td>';
            
            echo '<td>';
            echo '<form action="viewassignwork.php" method="POST" class="d-inline">';
            echo '<input type="hidden" name="id" value='.$row["request_id"].'>';
            echo '<button type="submit" class="btn btn-warning" name="view" value="View">
            <i class="far fa-eye"></i>
            </button>';
            echo '</form>';

            echo '<form action="" method="POST" class="d-inline">';
            echo '<input type="hidden" name="id" value='.$row["request_id"].'>';
            echo '<button type="submit" class="btn btn-secondary ms-2" name="delete" value="Delete">
            <i class="far fa-trash-alt"></i>
            </button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "0 result";
    }

    if (isset($_REQUEST['delete'])) {
        $sql = "DELETE FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
        if ($conn->query($sql) == TRUE) {
            echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
            exit();
        } else {
            echo "Unable to delete";
        }
    }

    ?>
 </div>

<?php include('includs/footer.php') ?>