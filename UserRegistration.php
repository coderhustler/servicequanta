<?php
include('dbConnection.php');

if (isset($_REQUEST['rSignup'])) {
    if (($_REQUEST['rName'] == "") || ($_REQUEST['rEmail'] == "") || ($_REQUEST['rPassword'] == "")) {
        $regmsg = '<div class="alert alert-warning mt-2" role="alert">Please fill all the fields.</div>';
    } else {
        // Corrected the key from 'r_email' to 'rEmail'
        $sql = "SELECT r_email FROM requesterlogin_tb WHERE r_email='" . $_REQUEST['rEmail'] . "'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $regmsg = '<div class="alert alert-warning mt-2" role="alert">Email ID already registered.</div>';
        } else {
            $rName = $_REQUEST['rName'];
            $rEmail = $_REQUEST['rEmail'];
            $rPassword = $_REQUEST['rPassword'];

            // Insert into database
            $sql = "INSERT INTO requesterlogin_tb(r_name, r_email, r_password) VALUES('$rName', '$rEmail', '$rPassword')";
            if ($conn->query($sql) == TRUE) {
                $regmsg = '<div class="alert alert-success mt-2" role="alert">Account successfully created. </div>';
            } else {
                $regmsg = '<div class="alert alert-danger mt-2" role="alert">Unable to create account. </div>';
            }
        }
    }
}

?>

<!-- JavaScript to make the alert message disappear after 3 seconds -->
<script>
    setTimeout(function() {
        var alert = document.querySelector('.alert');
        if (alert) {
            alert.style.display = 'none';
        }
    }, 3000); // 3 seconds
</script>

<!-- registration form -->
<div class="container pt-5 text-white" id="registration">
    <h2 class="text-center">Create an Account</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" method="post" class="shadow-lg p-4">
                <!-- Name field -->
                <div class="form-group mt-3">
                    <i class="fas fa-user"></i>
                    <label for="name" class="fw-bold ps-2">Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="rName" style="background-color: wheat;">
                </div>

                <!-- Email field with icon inside the input field -->
                <div class="form-group mt-3">
                    <i class="fas fa-envelope"></i>
                    <label for="email" class="fw-bold ps-2">E-mail</label>
                    <input type="email" class="form-control" placeholder="Email" name="rEmail" style="background-color: wheat;">
                    <small class="form-text">We'll never share your email with anyone else.</small>
                </div>

                <!-- Password field -->
                <div class="form-group mt-3">
                    <i class="fas fa-key"></i>
                    <label for="pass" class="fw-bold ps-2">New Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="rPassword" style="background-color: wheat;">
                </div>

                <button type="submit" class="btn btn-danger mt-5 w-100 shadow-sm fw-bold" name="rSignup">Sign Up</button>
                <em style="font-size: 10px;">Notes - By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy</em>
                <?php if (isset($regmsg)) {
                    echo $regmsg;
                } ?>
            </form>
        </div>
    </div>
</div>