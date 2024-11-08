<?php
include('../dbConnection.php');

session_start();
if (isset($_SESSION['is_Login'])) {
    $rEmail = $_SESSION['rEmail'];
} else {
    echo "<script> location.href='RequesterLogin.php';</script>";
    exit();
}

$sql = "SELECT * FROM submitrequest_tb WHERE request_id = {$_SESSION['myid']}";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Request Details</title>
        <!-- Add Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <!-- Custom Dark Mode CSS -->
        <style>
            body {
                background-color: #121212;
                color: #e0e0e0;
                font-family: 'Roboto', sans-serif;
            }

            .request-details {
                max-width: 800px;
                margin: 50px auto;
                padding: 30px;
                background-color: #1e1e1e;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
                border: 1px solid #333;
            }

            .request-details h2 {
                text-align: center;
                margin-bottom: 30px;
                font-weight: bold;
                color: #00acc1;
                /* Accent color */
            }

            .request-details th {
                width: 30%;
                background-color: #333;
                color: #00acc1;
                /* Accent color */
                font-weight: 500;
                border: none;
            }

            .request-details td {
                background-color: #1e1e1e;
                color: #e0e0e0;
                border: none;
                padding: 15px;
            }

            .request-details tr {
                border-bottom: 1px solid #333;
            }

            .btn-action {
                display: flex;
                justify-content: center;
                margin-top: 30px;
            }

            .btn-action .btn {
                margin-right: 10px;
                transition: background-color 0.3s;
            }

            .btn-action .btn:hover {
                color: #fff;
            }

            /* Print Styling */
            @media print {
                body {
                    background-color: #fff;
                    color: #000;
                }

                .request-details {
                    background-color: #fff;
                    box-shadow: none;
                    border: none;
                }

                .request-details th,
                .request-details td {
                    color: #000;
                    border: 1px solid #000;
                }

                .btn-action,
                nav,
                footer {
                    display: none;
                    /* Hide buttons and extra elements when printing */
                }
            }
        </style>
    </head>

    <body>

        <div class="container request-details">
            <h2>Request Details</h2>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Request ID</th>
                        <td><?php echo $row['request_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $row['requester_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Email ID</th>
                        <td><?php echo $row['requester_email']; ?></td>
                    </tr>
                    <tr>
                        <th>Request Info</th>
                        <td><?php echo $row['request_info']; ?></td>
                    </tr>
                    <tr>
                        <th>Request Description</th>
                        <td><?php echo $row['request_desc']; ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="btn-action">
                <button class="btn btn-primary" onclick="window.print()">Print</button>
                <a href="SubmitRequest.php" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <!-- Add Bootstrap 5 JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    </body>

    </html>

<?php
} else {
    echo "<div class='alert alert-danger text-center'>Failed to retrieve request details.</div>";
}
?>