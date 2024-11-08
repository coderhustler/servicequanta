<?php
session_start();
include('../dbConnection.php');

if (isset($_SESSION['is_adminLogin'])) {
    $aEmail = $_SESSION['aEmail'];
} else {
    echo "<script> location.href='adminLogin.php'; </script>";
    exit;
}

$sql = "SELECT * FROM customer_tb WHERE custid = {$_SESSION['myid']}";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Bill</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e1e1e;
            color: #ffffff;
        }
        .container {
            margin-top: 60px;
            background-color: #2c2c2c;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
        }
        .table th {
            width: 35%;
            background-color: #3b3b3b;
            color: #ffffff;
        }
        .table td {
            background-color: #2c2c2c;
            color: #dddddd;
        }
        .btn-print {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-close {
            background-color: #6c757d;
            color: #fff;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            echo "
            <div class='text-center mb-4'>
                <h2 class='fw-bold'>Customer Bill</h2>
                <hr style='border-color: #444444;'>
            </div>
            <table class='table table-bordered table-hover'>
                <tbody>
                    <tr>
                        <th>Customer ID</th>
                        <td>" . $row['custid'] . "</td>
                    </tr>
                    <tr>
                        <th>Customer Name</th>
                        <td>" . $row['custname'] . "</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>" . $row['custadd'] . "</td>
                    </tr>
                    <tr>
                        <th>Product</th>
                        <td>" . $row['cpname'] . "</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>" . $row['cpquantity'] . "</td>
                    </tr>
                    <tr>
                        <th>Price Each</th>
                        <td>" . $row['cpeach'] . "</td>
                    </tr>
                    <tr>
                        <th>Total Cost</th>
                        <td>" . $row['cptotal'] . "</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>" . $row['cpdate'] . "</td>
                    </tr>
                    <tr>
                        <td colspan='2' class='text-center'>
                            <button class='btn btn-print btn-lg d-print-none' onclick='window.print()'>Print</button>
                            
                            <a href='asset.php' class='btn btn-close btn-lg d-print-none ms-2'></a>
                        </td>
                    </tr>
                </tbody>
            </table>";
        } else {
            echo "<p class='text-center text-danger'>Failed to retrieve customer data.</p>";
        }
        ?>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
