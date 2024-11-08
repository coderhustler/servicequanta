<?php
define('TITLE', 'OSMS-Submit Request');
define('PAGE', 'SubmitRequest');
include('includes/header.php');
include('../dbConnection.php');

session_start();
if (isset($_SESSION['is_Login'])) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php';</script>";
    exit();
}

if (isset($_REQUEST['submitrequest'])) {
    // Checking for empty fields
    if (empty($_REQUEST['requestinfo']) || empty($_REQUEST['requestdesc']) || empty($_REQUEST['requestername']) || empty($_REQUEST['requesteradd1']) || empty($_REQUEST['requesteradd2']) || empty($_REQUEST['requestercity']) || empty($_REQUEST['requesterstate']) || empty($_REQUEST['requesterzip']) || empty($_REQUEST['requesteremail']) || empty($_REQUEST['requestermobile']) || empty($_REQUEST['requestdate'])) {
        $msg = '<div class="alert alert-warning col-sm-8 mt-2 mx-auto" role="alert">Please fill all the fields.</div>';
    } else {
        // Sanitizing input data
        $rinfo = $conn->real_escape_string($_REQUEST['requestinfo']);
        $rdesc = $conn->real_escape_string($_REQUEST['requestdesc']);
        $rname = $conn->real_escape_string($_REQUEST['requestername']);
        $radd1 = $conn->real_escape_string($_REQUEST['requesteradd1']);
        $radd2 = $conn->real_escape_string($_REQUEST['requesteradd2']);
        $rcity = $conn->real_escape_string($_REQUEST['requestercity']);
        $rstate = $conn->real_escape_string($_REQUEST['requesterstate']);
        $rzip = $conn->real_escape_string($_REQUEST['requesterzip']);
        $remail = $conn->real_escape_string($_REQUEST['requesteremail']);
        $rmobile = $conn->real_escape_string($_REQUEST['requestermobile']);
        $rdate = $conn->real_escape_string($_REQUEST['requestdate']);

        $sql = "INSERT INTO submitrequest_tb (request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_zip, requester_email, requester_mobile, request_date) 
                VALUES ('$rinfo', '$rdesc', '$rname', '$radd1', '$radd2', '$rcity', '$rstate', '$rzip', '$remail', '$rmobile', '$rdate')";

        if ($conn->query($sql) === TRUE) {
            $genid = $conn->insert_id;
            $_SESSION['myid'] = $genid;
            echo "<script> location.href='SubmitRequestSuccess.php'; </script>";
            exit();
        } else {
            $msg = '<div class="alert alert-danger col-sm-8 mt-2 mx-auto" role="alert">Unable to submit. Please try again.</div>';
        }
    }
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

    .alert-success {
        background-color: #28a745;
        color: #ffffff;
        border-color: #218838;
    }

    .alert-danger {
        background-color: #dc3545;
        color: #ffffff;
        border-color: #c82333;
    }

    .form-label {
        color: #ffffff;
    }

    .col-sm-9, .col-md-10 {
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 8px;
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

<!-- Service Request Form -->
<div class="col-sm-9 col-md-10 mt-5">
    <form class="mx-5" action="" method="POST">
        <div class="mb-3">
            <label for="inputRequestInfo" class="form-label">Request Info</label>
            <input type="text" class="form-control" id="inputRequestInfo" placeholder="Request Info" name="requestinfo">
        </div>
        <div class="mb-3">
            <label for="inputRequestDescription" class="form-label">Description</label>
            <input type="text" class="form-control" id="inputRequestDescription" placeholder="Write Description" name="requestdesc">
        </div>
        <div class="mb-3">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control" id="inputName" placeholder="Name" name="requestername">
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="inputAddress" class="form-label">Address Line 1</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="House No. 123" name="requesteradd1">
            </div>
            <div class="mb-3 col-md-6">
                <label for="inputAddress2" class="form-label">Address Line 2</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Railway Colony" name="requesteradd2">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" class="form-control" id="inputCity" name="requestercity">
            </div>
            <div class="mb-3 col-md-4">
                <label for="inputState" class="form-label">State</label>
                <input type="text" class="form-control" id="inputState" name="requesterstate">
            </div>
            <div class="mb-3 col-md-2">
                <label for="inputZip" class="form-label">Zip</label>
                <input type="text" class="form-control" id="inputZip" name="requesterzip" onkeypress="isInputNumber(event)">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="requesteremail">
            </div>
            <div class="mb-3 col-md-3">
                <label for="inputMobile" class="form-label">Mobile</label>
                <input type="text" class="form-control" id="inputMobile" name="requestermobile" onkeypress="isInputNumber(event)">
            </div>
            <div class="mb-3 col-md-3">
                <label for="inputDate" class="form-label">Date</label>
                <input type="date" class="form-control" id="inputDate" name="requestdate">
            </div>
        </div>
        <button type="submit" class="btn btn-danger mt-3" name="submitrequest">Submit</button>
        <button type="reset" class="btn btn-secondary mt-3">Reset</button>
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
    </form>
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

<?php include('includes/footer.php'); ?>
