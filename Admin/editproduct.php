<?php
session_start(); // Start the session at the very beginning
define('TITLE', 'Assets - Edit');
define('PAGE', 'assets');
include('includs/header.php');
include('../dbConnection.php');
if (isset($_SESSION['is_adminLogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    // Redirect to the login page if not logged in
    echo "<script> location.href='adminLogin.php';</script>";
    exit();
}

if (isset($_REQUEST['pupdate'])) {
    // Checking for empty fields
    if (($_REQUEST['pname'] == "") || ($_REQUEST['pdop'] == "") || ($_REQUEST['pavail'] == "") || ($_REQUEST['ptotal'] == "") || ($_REQUEST['pOrgCost'] == "") || ($_REQUEST['pSellCost'] == "")) {
        $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2">Fill All Fields</div>';
    } else {
        $pid = $_REQUEST['pid'];
        $pname = $_REQUEST['pname'];
        $pdop = $_REQUEST['pdop'];
        $pavail = $_REQUEST['pavail'];
        $ptotal = $_REQUEST['ptotal'];
        $pOrgCost = $_REQUEST['pOrgCost'];
        $pSellCost = $_REQUEST['pSellCost'];

        $sql = "UPDATE assets_tb SET pname = '$pname', pdop = '$pdop', pavail = '$pavail', ptotal = '$ptotal', pOrgCost = '$pOrgCost', pSellCost = '$pSellCost' WHERE pid = '$pid'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2">Updated Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2">Unable to Update</div>';
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
    }, 3000); // Hide alert after 3 seconds
</script>

<div class="col-sm-6 mx-3 ms-5 mt-5 bg-secondary text-white p-4 rounded">
    <h3 class="Add New Product">Update Product Details</h3>

    <?php

    if (isset($_REQUEST['edit'])) {
        $sql = "SELECT * FROM assets_tb WHERE pid = {$_REQUEST['id']}"; 
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }


    ?>
    <form action="" method="post">

        <div class="form-group">
            <label for="pname" class="form-label">Product ID</label>
            <input type="text" class="form-control text-dark" id="pid" name="pid" readonly value="<?php if(isset($row['pid'])){
                echo $row['pid']; } ?>">
        </div>

        <div class="form-group">
            <label for="pname" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="pname" name="pname"
                value="<?php if(isset($row['pname'])){ echo $row['pname']; } ?>">
        </div>

        <div class="form-group mt-2">
            <label for="pdop" class="form-label">Date of Purchase</label>
            <input type="date" class="form-control" id="pdop" name="pdop"
                value="<?php if(isset($row['pdop'])){ echo $row['pdop']; } ?>">
        </div>

        <div class="form-group mt-2">
            <label for="pavail" class="form-label">Available</label>
            <input type="number" class="form-control" id="pavail" name="pavail"
                value="<?php if(isset($row['pavail'])){ echo $row['pavail']; } ?>">
        </div>

        <div class="form-group mt-2">
            <label for="ptotal" class="form-label">Total</label>
            <input type="number" class="form-control" id="ptotal" name="ptotal"
                value="<?php if(isset($row['ptotal'])){ echo $row['ptotal']; } ?>">
        </div>

        <div class="form-group mt-2">
            <label for="pOrgCost" class="form-label">Original Cost</label>
            <input type="number" class="form-control" id="pOrgCost" name="pOrgCost"
                value="<?php if(isset($row['pOrgCost'])){ echo $row['pOrgCost']; } ?>">
        </div>

        <div class="form-group mt-2">
            <label for="pSellCost" class="form-label">Selling Cost</label>
            <input type="number" class="form-control" id="pSellCost" name="pSellCost"
                value="<?php if(isset($row['pSellCost'])){ echo $row['pSellCost']; } ?>">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-danger mt-3" name="pupdate" id="pupdate">Update</button>
            <a href="asset.php" class="btn btn-secondary mt-3">Close</a>
        </div>


        <?php if (isset($msg)) {
            echo $msg;
        } ?>

    </form>

</div>


<?php include('includs/footer.php'); ?>