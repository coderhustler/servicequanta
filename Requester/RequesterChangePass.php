<?php
define('TITLE', 'OSMS-Change Password');
define('PAGE', 'RequesterChangePass');
include('includes/header.php');
include('../dbConnection.php');

session_start();
if (isset($_SESSION['is_Login'])) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php';</script>";
    exit();
}

if(isset($_REQUEST['passupdate'])){
    if($_REQUEST['rPassword'] == ""){
        $passmsg = '<div class="alert alert-warning col-sm-6 ms-5 mt-2"  role="alert" >Fill All Fields.</div>';
    }else{
        $rPassword = $_REQUEST['rPassword'];
        $sql = "UPDATE requesterlogin_tb SET r_password = '$rPassword' WHERE r_email = '$rEmail'";
        if ($conn->query($sql) == TRUE) {
            $passmsg = '<div class="alert alert-success col-sm-6 ms-5 mt-2"  role="alert" >Updated Successfully.</div>';
        } else {
            $passmsg = '<div class="alert alert-danger col-sm-6 ms-5 mt-2"  role="alert" >Unable to Update.</div>';
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


<div class="col-sm-9 col-md-10">
    <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5" method="POST">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control text-dark" id="inputEmail" value=" <?php echo $rEmail ?>" style="background-color:beige;" readonly>
                </div>
                <div class="form-group">
                    <label for="inputnewpassword">New Password</label>
                    <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password" name="rPassword">
                </div>
                <button type="submit" class="btn btn-danger mr-4 mt-4" name="passupdate">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <?php if (isset($passmsg)) {
                    echo $passmsg;
                } ?>
            </form>

        </div>

    </div>

</div>

<?php include('includes/footer.php') ?>