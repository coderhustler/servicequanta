<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/custom.css">

    <style>
        /* Set sidebar background and link spacing */
        .sidebar {
            background-color: #343a40;
            height: 100%;
        }

        /* Style the navigation links with padding */
        .nav-link {
            border-left: 3px solid transparent;
            transition: border-color 0.3s;
        }

        /* Set hover effect for links */
        .nav-link.active,
        .nav-link:hover {
            border-left: 3px solid #007bff;
            background-color: #212529;
        }

        /* Style the navbar */
        .navbar {
            font-size: 18px;
            padding: 15px;
            background-color: #C63C51;
            border-bottom: 2px solid #fff;
        }

        #logoutLink {
            margin-top: 20px;
            padding: 12px 15px;
            font-weight: bold;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.nav-link').click(function() {
                $('.nav-link').removeClass('active'); // Remove active class from all links
                $(this).addClass('active'); // Add active class to the clicked link
            });

            $('#logoutLink').click(function(event) {
                event.preventDefault(); // Prevent the default action (navigation)
                var confirmed = confirm("Are you sure you want to log out?");
                if (confirmed) {
                    window.location.href = $(this).attr('href'); // Redirect to the logout page
                }
            });
        });
    </script>


    <title> <?php echo TITLE; ?></title>
</head>

<body>


    <!-- Navbar -->
    <nav class="navbar navbar-dark fixed-top p-0 shadow">
        <a href="RequesterProfile.php" class="navbar-brand col-md-2 ms-3">ServiceQuanta
        </a>
    </nav>

    <!-- Sidebar and content -->
    <!-- Sidebar and content -->
    <div class="container-fluid" style="margin-top: 56px;">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-sm-2 bg-dark sidebar py-5">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-light <?php if (PAGE == 'RequesterProfile') {
                                                                echo 'active';
                                                            } ?>" href="RequesterProfile.php">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light <?php if (PAGE == 'SubmitRequest') {
                                                                echo 'active';
                                                            } ?>" href="SubmitRequest.php">
                                <i class="fab fa-accessible-icon"></i> Submit Request
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light <?php if (PAGE == 'CheckStatus') {
                                                                echo 'active';
                                                            } ?>" href="CheckStatus.php">
                                <i class="fas fa-align-center"></i> Service Status
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light <?php if (PAGE == 'RequesterChangePass') {
                                                                echo 'active';
                                                            } ?>" href="RequesterChangePass.php">
                                <i class="fas fa-key"></i> Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="logoutLink" class="nav-link text-light" href="../logout.php">
                                <i class="fas fa-sign-out-alt"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>