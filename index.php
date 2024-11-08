<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <title>ServiceQuanta</title>
</head>

<body class="bg-dark">
    <!-- navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-danger ps-4 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">ServiceQuanta</a>
            <span class="navbar-text">Customer's Happiness Is Our Aim</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ps-5 custom-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#registration">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Requester/RequesterLogin.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>


    <!-- hearder jumotron -->
    <header class="bg-light text-dark p-5 mb-4 rounded-3 back-image" style="background-image: url(images/osms.webp);">
        <div class="container-fluid py-5 mainHeading myClass">
            <h1 class="text-uppercase text-danger fw-bold">Welcome to ServiceQuanta</h1>
            <p class="font-italic text-white" style="font-style: italic;">Customer's Happiness Is Our Aim</p>
            <a href="Requester/RequesterLogin.php" class="btn btn-success ms-4">Login</a>
            <a href="#registration" class="btn btn-danger ms-4">Sign Up</a>
        </div>
    </header>


    <div class="container-fluid">
        <div class="bg-info text-dark p-5 rounded-3">
            <h3 class="text-center">OSMS Services</h3>
            <p>
                OSMS Services is India’s leading chain of multi-brand Electronics and Electrical service
                workshops offering
                wide array of services. We focus on enhancing your uses experience by offering world-class
                Electronic
                Appliances maintenance services. Our sole mission is “To provide Electronic Appliances care
                services to
                keep the devices fit and healthy and customers happy and smiling”.

                With well-equipped Electronic Appliances service centres and fully trained mechanics, we
                provide quality
                services with excellent packages that are designed to offer you great savings.

                Our state-of-art workshops are conveniently located in many cities across the country. Now you
                can book
                your service online by doing Registration.
            </p>
        </div>
    </div>


    <!-- start services section -->
    <div class="container text-center border-bottom mt-4 text-white" id="services">
        <h2>Our Services</h2>
        <div class="row mt-4">
            <div class="col-sm-4 mb-4">
                <a href="#"><i class="fas fa-tv fa-8x text-success"></i></a>
                <h4 class="mt-4">Electronic Appliances</h4>
            </div>
            <div class="col-sm-4 mb-4">
                <a href="#"><i class="fas fa-sliders-h fa-8x text-primary"></i></a>
                <h4 class="mt-4">Preventive Maintenance</h4>
            </div>
            <div class="col-sm-4 mb-4">
                <a href="#"><i class="fas fa-cogs fa-8x text-info"></i></a>
                <h4 class="mt-4">Fault Repair</h4>
            </div>
        </div>
    </div>


    <!-- registration form -->
    <?php include('UserRegistration.php')?>



    <!-- happy customer -->
    <div class="bg-danger text-dark p-5 rounded">
        <!-- Content goes here -->
        <div class="container-fluid">
            <h2 class="text-center text-white">Happy Customers</h2>
            <div class="row mt-5">
                <div class="col-lg-3 col-sm-6">
                    <div class="card shadow-lg mb-2">
                        <div class="card-body text-center">
                            <img src="images/avtar1.jpeg" alt="avt1" class="img-fluid" style="border-radius: 100px;">
                            <h4 class="card-title">Sugyanta Sahu</h4>
                            <p class="card-text">Itaque illo explicabo voluptatum, saepe libero rerum, ad
                                ducimus voluptas
                                nesciunt debitis numquam.</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-sm-6">
                    <div class="card shadow-lg mb-2">
                        <div class="card-body text-center">
                            <img src="images/avtar2.jpeg" alt="avt2" class="img-fluid" style="border-radius: 100px;">
                            <h4 class="card-title">Alisha Nayak</h4>
                            <p class="card-text">Itaque illo explicabo voluptatum, saepe libero rerum, ad
                                ducimus voluptas
                                nesciunt debitis numquam.</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-sm-6">
                    <div class="card shadow-lg mb-2">
                        <div class="card-body text-center">
                            <img src="images/avtar3.jpeg" alt="avt3" class="img-fluid" style="border-radius: 100px;">
                            <h4 class="card-title">Shubham Senapati</h4>
                            <p class="card-text">Itaque illo explicabo voluptatum, saepe libero rerum, ad
                                ducimus voluptas
                                nesciunt debitis numquam.</p>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-sm-6">
                    <div class="card shadow-lg mb-2">
                        <div class="card-body text-center">
                            <img src="images/avtar4.jpeg" alt="avt4" class="img-fluid" style="border-radius: 100px;">
                            <h4 class="card-title">Basudha Behera</h4>
                            <p class="card-text">Itaque illo explicabo voluptatum, saepe libero rerum, ad
                                ducimus voluptas
                                nesciunt debitis numquam.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- contact us -->
    <div class="container mt-4 text-white" id="contact">
        <h2 class="text-center mb-4">Contact US</h2>
        <div class="row">
            <!-- 1st column -->
             <?php include('contactform.php') ?>

            <div class="col-md-4 text-center">
                <strong>Headquarter:</strong><br>
                ServiceQuanta pvt. Ltd,<br>
                Rourkela, <br>
                Odisha - 769042 <br>
                Phone: 0123456789 <br>
                
                <br><br>
                <strong>Branch:</strong><br>
                ServiceQuanta pvt. Ltd,<br>
                Jalandhar, <br>
                Punjab - 144023 <br>
                Phone: 0123456789 <br>
                
            </div>
        </div>
    </div>




    <!-- footer -->
    <footer class="container-fluid text-white bg-dark mt-5">
        <div class="container">
            <div class="row py-3">
                <div class="col-md-6">
                    <span class="me-2">Follow Us: </span>
                    <a href="#" target="_blank" class="me-2 fi-color"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank" class="me-2 fi-color"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank" class="me-2 fi-color"><i class="fab fa-youtube"></i></a>
                    <a href="#" target="_blank" class="me-2 fi-color"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" target="_blank" class="me-2 fi-color"><i class="fas fa-rss"></i></a>
                </div>


                <div class="col-md-6 text-end">
                    <small>Copyright &copy; ServiceQuanta 2024</small>
                    <small class="ms-2 admin"><a href="Admin/adminLogin.php">Admin Login</a></small>
                </div>

            </div>



        </div>
    </footer>








    <!-- JavaScript dependencies -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/all.min.js"></script>
</body>

</html>