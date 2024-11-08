<?php
session_start(); // Start the session at the very beginning
define('TITLE', 'Work Order - View');
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
        background-color: #1e1f26;
        /* Darker background for dashboard */
        color: #f5f6fa;
        /* Off-white text for readability */
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        margin-top: 50px;
    }

    h3 {
        color: #00a8ff;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Card Styles */
    .card {
        background-color: #2c2f33;
        border-radius: 10px;
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
        padding: 20px;
        color: #ffffff;
    }

    .card-header {
        font-size: 1.2rem;
        font-weight: bold;
        background-color: transparent;
        color: #00a8ff;
    }

    .card-body {
        padding: 1.5rem;
        color: #ffffff;
    }

    /* Table Styles */
    .table {
        background-color: #2c2f33;
        color: #ffffff;
        /* Set table content text color to white */
        margin-top: 20px;
        border-radius: 5px;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #44494e;
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

    /* Form Control Styles */
    .form-control {
        background-color: #3a3f44;
        color: #ffffff;
        border: 1px solid #5a5e63;
    }

    .form-control:focus {
        background-color: #44494e;
        border-color: #6c757d;
        color: #ffffff;
    }

    /* Button Styles */
    .btn {
        border-radius: 20px;
        padding: 10px 20px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-secondary {
        background-color: #7f8c8d;
        border-color: #7f8c8d;
    }

    .btn-secondary:hover {
        background-color: #5a6b6b;
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    

    /* Print Button */
    #printableArea {
        background-color: #23272b;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .text-center {
        text-align: center;
        margin-top: 20px;
    }

    /* Footer Styles */
    .bg-dark p {
        color: #ffffff;
        padding: 1rem;
        border-radius: 10px;
    }

    /* Media Query for Responsive Design */
    @media (max-width: 768px) {
        .table {
            font-size: 14px;
        }

        .btn {
            font-size: 14px;
            padding: 8px 16px;
        }
    }
</style>


<div class="col-sm-6 mt-5 mx-5 text-center " id="printableArea">
    <h3 class="text-center text-info">Assigned Work Details</h3>

    <?php
    if (isset($_REQUEST['view'])) {
        $sql = "SELECT * FROM assignwork_tb WHERE request_id = {$_REQUEST['id']}";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc(); ?>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Request_ID</td>
                    <td><?php echo $row['request_id'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Request Info</td>
                    <td><?php echo $row['request_info'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Request Description</td>
                    <td><?php echo $row['request_desc'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo $row['requester_name'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Address 1</td>
                    <td><?php echo $row['requester_add1'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Address 2</td>
                    <td><?php echo $row['requester_add2'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><?php echo $row['requester_city'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><?php echo $row['requester_state'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Pin Code</td>
                    <td><?php echo $row['requester_zip'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $row['requester_email'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td><?php echo $row['requester_mobile'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Assigned Technician</td>
                    <td><?php echo $row['assign_tech'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Assigned Date</td>
                    <td><?php echo $row['assign_date'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Contact With Technician</td>
                    <td><?php echo $row['assign_tech_mobile'] ?? ''; ?></td>
                </tr>
                <tr>
                    <td>Customer Sign</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Technician Sign</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <!-- Centered Print Button -->
        <div class="text-center">
            <button class="btn btn-primary mt-3" onclick="printDiv('printableArea')">Print</button>
            <a href="work.php" class="btn btn-secondary mt-3">Back</a>
        </div>
</div>


<?php
    }
?>
</div>


<?php include('includs/footer.php') ?>


<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>