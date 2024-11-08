<?php
define('TITLE', 'OSMS-Profile');
define('PAGE', 'RequesterProfile');
include('includes/header.php');
include('../dbConnection.php');

session_start();
if ($_SESSION['is_Login']) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php';</script>";
}

$sql = "SELECT r_name, r_email FROM requesterlogin_tb WHERE r_email='$rEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $rName = $row['r_name'];
}

if (isset($_REQUEST['update'])) {
    if ($_REQUEST['rName'] == "") {
        $passmsg = '<div class="alert alert-warning col-sm-6 ms-5 mt-2" role="alert">Fill All Fields.</div>';
    } else {
        $rName = $_REQUEST['rName'];
        $sql = "UPDATE requesterlogin_tb SET r_name = '$rName' WHERE r_email = '$rEmail'";
        if ($conn->query($sql) === TRUE) {
            $passmsg = '<div class="alert alert-success col-sm-6 ms-5 mt-2" role="alert">Updated Successfully.</div>';
        } else {
            $passmsg = '<div class="alert alert-danger col-sm-6 ms-5 mt-2" role="alert">Unable to Update.</div>';
        }
    }
}
?>

<style>
    body {
        background-color: #121212;
        color: #ffffff;
    }
    .form-control {
        background-color: #333333;
        color: #ffffff;
        border: 1px solid #444444;
    }
    .form-control:focus {
        background-color: #333333;
        color: #ffffff;
        border-color: #555555;
    }
    .btn-danger {
        background-color: #ff4d4d;
        border-color: #ff4d4d;
    }
    .btn-danger:hover {
        background-color: #e60000;
        border-color: #e60000;
    }
    .alert {
        background-color: #222222;
        color: #ffffff;
        border: 1px solid #444444;
    }
    .alert-warning {
        background-color: #ffcc00;
        color: #000000;
    }
    .alert-success {
        background-color: #28a745;
        color: #ffffff;
    }
    .alert-danger {
        background-color: #dc3545;
        color: #ffffff;
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

<!-- profile area -->
<div class="col-sm-6 mt-5">
    <form action="" method="post" class="ms-5">
        <div class="form-group">
            <label for="inputEmail" class="text-light">Email </label>
            <input class="form-control" type="email" name="rEmail" id="rEmail" value="<?php echo $rEmail ?>" readonly style="background-color: #555555;">
        </div>
        <div class="form-group mt-2">
            <label for="rName" class="text-light">Name </label>
            <input class="form-control" value="<?php echo $rName ?>" type="text" name="rName" id="rName">
        </div>
        <button type="submit" class="btn btn-danger mt-3" name="update">Update</button>
        <?php if (isset($passmsg)) {
            echo $passmsg;
        } ?>
    </form>
</div>

<?php include('includes/footer.php') ?>
