<?php
session_start(); // Start the session at the very beginning
define('TITLE', 'Requests');
define('PAGE', 'request');
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

<!-- Start second column -->
<div class="col-sm-4 mb-5">
    <div class="mt-5 mx-5">
        <?php if (isset($passmsg)) {
            echo $passmsg;
        } ?>
    </div>
    <?php
    $sql = "SELECT request_id, request_info, request_desc, request_date FROM submitrequest_tb";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="card mt-5 mx-5">';
            echo '<div class="card-header">';
            echo 'Request ID: ' . $row['request_id'];
            echo '</div>';

            // card body
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Request Info: ' . $row['request_info'] . '</h5>';
            echo '<p class="card-text">Request Description: ' . $row['request_desc'] . '</p>';
            echo '<p class="card-text">Request Date: ' . $row['request_date'] . '</p>';

            // Card button
            echo '<div class="d-flex justify-content-end">'; // Use flexbox utilities to align right
            echo '<form action="" method="POST">';
            echo '<input type="hidden" name="id" value="' . $row["request_id"] . '">';
            echo '<input class="btn btn-danger mx-3" type="submit" value="View Details" name="view"> ';
            echo '<input class="btn btn-secondary" type="submit" value="Close" name="close">';
            echo '</form>';
            echo '</div>';

            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</div>

<?php
if (isset($_REQUEST['view'])) {
    $sql = "SELECT * FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if (isset($_REQUEST['close'])) {
    $sql = "DELETE FROM submitrequest_tb WHERE request_id = {$_REQUEST['id']}";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
        echo "<script> location.href='request.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

if (isset($_REQUEST['assign'])) {
    if (
        empty($_REQUEST['request_id']) || empty($_REQUEST['request_info']) || empty($_REQUEST['requestdesc']) ||
        empty($_REQUEST['requestername']) || empty($_REQUEST['address1']) || empty($_REQUEST['address2']) ||
        empty($_REQUEST['requestercity']) || empty($_REQUEST['requesterstate']) || empty($_REQUEST['requesterzip']) ||
        empty($_REQUEST['requesteremail']) || empty($_REQUEST['requestermobile']) || empty($_REQUEST['assigntech']) ||
        empty($_REQUEST['inputDate']) || empty($_REQUEST['assigntechmobile'])
    ) {
        $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">All Fields are Required</div>';
    } else {
        $rid = $_REQUEST['request_id'];
        $rinfo = $_REQUEST['request_info'];
        $rdesc = $_REQUEST['requestdesc'];
        $rname = $_REQUEST['requestername'];
        $radd1 = $_REQUEST['address1'];
        $radd2 = $_REQUEST['address2'];
        $rcity = $_REQUEST['requestercity'];
        $rstate = $_REQUEST['requesterstate'];
        $rzip = $_REQUEST['requesterzip'];
        $remail = $_REQUEST['requesteremail'];
        $rmob = $_REQUEST['requestermobile'];
        $tech = $_REQUEST['assigntech'];
        $date = $_REQUEST['inputDate'];
        $techmob = $_REQUEST['assigntechmobile'];

        $sql = "INSERT INTO assignwork_tb(request_id, request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_zip, requester_email, requester_mobile, assign_tech, assign_date, assign_tech_mobile) VALUES ('$rid', '$rinfo', '$rdesc', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$rzip', '$remail', '$rmob', '$tech', '$date', '$techmob')";
        if ($conn->query($sql) === TRUE) {
            $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Request Assigned Successfully.</div>';
        } else {
            $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Assign Request.</div>';
        }
    }
}
?>

<style>
    body {
        background-color: #2c2f33;
        color: #ffffff;
        font-family: 'Arial', sans-serif;
    }

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

    .btn {
        border-radius: 20px;
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .alert {
        background-color: #3a3f44;
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

    .bg-secondary {
        background-color: #6c757d;
    }

    .bg-secondary p {
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
    }, 3000); // 3 seconds
</script>

<!-- third column -->
<div class="col-sm-5 mt-5 mx-auto">
    <div class="bg-secondary text-light p-4 rounded">
        <form action="" method="POST" class="text-white">
            <h4 class="text-center">Assign Work Order Request</h4>
            <div class="form-group mb-3">
                <label for="request_id">Request ID</label>
                <input type="text" class="form-control text-dark" id="request_id" name="request_id" value="<?php if (isset($row['request_id'])) { echo $row['request_id']; } ?>" readonly style="background-color: beige;">
            </div>

            <div class="mb-3">
                <label for="request_info" class="form-label">Request Info</label>
                <input type="text" class="form-control text-dark" id="request_info" name="request_info" value="<?php if (isset($row['request_info'])) { echo $row['request_info']; } ?>" readonly style="background-color: beige;">
            </div>

            <div class="mb-3">
                <label for="requestdesc" class="form-label">Request Description</label>
                <textarea class="form-control text-dark" id="requestdesc" name="requestdesc" rows="3" readonly style="background-color: beige;"><?php if (isset($row['request_desc'])) { echo $row['request_desc']; } ?></textarea>
            </div>

            <div class="mb-3">
                <label for="requestername" class="form-label">Requester Name</label>
                <input type="text" class="form-control text-dark" id="requestername" name="requestername" placeholder="Requester Name" value="<?php if (isset($row['requester_name'])) { echo $row['requester_name']; } ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="address1" class="form-label">Address Line 1</label>
                <input type="text" class="form-control text-dark" id="address1" name="address1" placeholder="Address Line 1" value="<?php if (isset($row['requester_add1'])) { echo $row['requester_add1']; } ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="address2" class="form-label">Address Line 2</label>
                <input type="text" class="form-control text-dark" id="address2" name="address2" placeholder="Address Line 2" value="<?php if (isset($row['requester_add2'])) { echo $row['requester_add2']; } ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="requestercity" class="form-label">City</label>
                <input type="text" class="form-control text-dark" id="requestercity" name="requestercity" placeholder="City" value="<?php if (isset($row['requester_city'])) { echo $row['requester_city']; } ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="requesterstate" class="form-label">State</label>
                <input type="text" class="form-control text-dark" id="requesterstate" name="requesterstate" placeholder="State" value="<?php if (isset($row['requester_state'])) { echo $row['requester_state']; } ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="requesterzip" class="form-label">Zip Code</label>
                <input type="text" class="form-control text-dark" id="requesterzip" name="requesterzip" placeholder="Zip Code" value="<?php if (isset($row['requester_zip'])) { echo $row['requester_zip']; } ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="requesteremail" class="form-label">Email</label>
                <input type="email" class="form-control text-dark" id="requesteremail" name="requesteremail" placeholder="Email" value="<?php if (isset($row['requester_email'])) { echo $row['requester_email']; } ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="requestermobile" class="form-label">Mobile</label>
                <input type="text" class="form-control text-dark" id="requestermobile" name="requestermobile" placeholder="Mobile" value="<?php if (isset($row['requester_mobile'])) { echo $row['requester_mobile']; } ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="assigntech" class="form-label">Assign Technician</label>
                <input type="text" class="form-control" id="assigntech" name="assigntech" placeholder="Technician Name">
            </div>

            <div class="mb-3">
                <label for="inputDate" class="form-label">Date</label>
                <input type="date" class="form-control" id="inputDate" name="inputDate">
            </div>

            <div class="mb-3">
                <label for="assigntechmobile" class="form-label">Technician Mobile</label>
                <input type="text" class="form-control" id="assigntechmobile" name="assigntechmobile" placeholder="Technician Mobile">
            </div>

            <div class="d-flex justify-content-end">
                <input type="submit" class="btn btn-success" name="assign" value="Assign Request">
                <button type="reset" class="btn btn-secondary ms-2">Reset</button>
            </div>
        </form>

        <?php
        if (isset($passmsg)) {
            echo $passmsg;
        }
        ?>
    </div>
</div>

<!-- Only Number Input Validation -->
<script>
    function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);
        if (!/[0-9]/.test(ch)) {
            evt.preventDefault();
        }
    }
</script>

<?php
include('includs/footer.php');
?>
