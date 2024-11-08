<?php
session_start();
define('TITLE', 'OSMS-Status');
define('PAGE', 'CheckStatus');
include('includes/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_Login'])) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php';</script>";
    exit();
}
?>

<style>
    body {
        background-color: #121212;
        color: #ffffff;
        font-family: Arial, sans-serif;
    }

    .form-control {
        background-color: #1e1e1e;
        color: #ffffff;
        border: 1px solid #333333;
    }

    .form-control:focus {
        background-color: #1e1e1e;
        color: #ffffff;
        border-color: #555555;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-danger {
        background-color: #ff4d4d;
        border-color: #ff4d4d;
        color: #ffffff;
    }

    .btn-danger:hover {
        background-color: #e60000;
        border-color: #e60000;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004a9b;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #ffffff;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }

    .alert {
        background-color: #333333;
        color: #ffffff;
        border: 1px solid #444444;
        border-radius: 0.25rem;
    }

    .alert-warning {
        background-color: #ffcc00;
        color: #000000;
        border-color: #e0a800;
    }

    .alert-info {
        background-color: #17a2b8;
        color: #ffffff;
        border-color: #138496;
    }

    .table {
        background-color: #1a1a1a;
        color: #ffffff;
    }

    .table-bordered {
        border-color: #333333;
    }

    .table-bordered td, .table-bordered th {
        border-color: #333333;
    }

    .col-sm-6 {
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 8px;
    }

    .text-center {
        text-align: center;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    .mt-5 {
        margin-top: 3rem;
    }
</style>

<!-- second column -->
<div class="col-sm-6 mt-5 mx-3">
    <form action="" method="post" class="d-flex align-items-center">
        <div class="form-group me-3">
            <label for="checkid" class="me-2">Enter Request ID: </label>
            <input type="number" name="checkid" id="checkid" class="form-control" placeholder="e.g., 12345">
        </div>
        <button type="submit" class="btn btn-danger mt-4">Search</button>
    </form>

    <?php
    if (isset($_REQUEST['checkid'])) {
        if ($_REQUEST['checkid'] == "") {
            echo '<div class="alert alert-warning mt-4">Fill All Fields.</div>';
        } else {
            $sql = "SELECT * FROM assignwork_tb WHERE request_id = {$_REQUEST['checkid']}";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();

                if ($row) { ?>

                    <h3 class="text-center mt-5 text-info">Assigned Work Details</h3>
                    <div id="printableArea">
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
                    </div>
                    <!-- Centered Print Button -->
                    <div class="text-center">
                        <button class="btn btn-primary mt-3" onclick="printDiv('printableArea')">Print</button> 
                        <a href="RequesterProfile.php" class="btn btn-secondary mt-3">Back</a>
                    </div>
    <?php
                }
            } else {
                echo '<div class="alert alert-info mt-4">Your Request is Still Pending.</div>';
            }
        }
    } ?>
</div>

<?php include('includes/footer.php') ?>

<script>
function printDiv(divName) {
    // Get the content of the div to print
    var printContents = document.getElementById(divName).innerHTML;
    // Save the original page contents
    var originalContents = document.body.innerHTML;

    // Replace the body content with the content to print
    document.body.innerHTML = printContents;

    // Trigger the print dialog
    window.print();

    // Restore the original contents of the page after printing
    document.body.innerHTML = originalContents;

    // Reload the page to ensure everything works correctly again
    window.location.reload();
}
</script>
