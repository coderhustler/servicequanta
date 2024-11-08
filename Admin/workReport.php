<?php
session_start(); // Start the session at the very beginning
define('TITLE', 'Work Report');
define('PAGE', 'workreport');
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

<style>
    body {
        background-color: #2c2f33;
        /* Dark background */
        color: #f8f9fa;
        /* Light text color for readability */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-control {
        background-color: #2c2c2c;
        /* Dark form fields */
        color: #f8f9fa;
        /* Light text */
        border: 1px solid #444;
        /* Darker borders */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        /* Soft shadow */
    }

    .form-control:focus {
        background-color: #333;
        border-color: #80bdff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        /* Blue focus effect */
    }

    .btn {
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
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

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #ffffff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #ffffff;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .table {
        background-color: #2c2c2c;
        color: #f8f9fa;
        margin-top: 1.5rem;
        border: 1px solid #444;
        /* Darker border */
    }

    .table thead {
        background-color: #343a40;
        color: #ffffff;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #242424;
        color: white;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #2c2c2c;
    }

    .table-hover tbody tr:hover {
        background-color: #3a3a3a;
        /* Hover effect */
    }

    .alert {
        background-color: #343a40;
        color: #ffffff;
        border: 1px solid #444;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border-radius: 0.25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    .alert-warning {
        background-color: #856404;
        color: #fff3cd;
        border-color: #ffeeba;
    }

    .alert-success {
        background-color: #155724;
        color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        background-color: #721c24;
        color: #f8d7da;
        border-color: #f5c6cb;
    }

    .card {
        background-color: #2c2c2c;
        border: 1px solid #444;
        border-radius: 0.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    .card-header {
        font-size: 1.2rem;
        font-weight: bold;
        background-color: #343a40;
        border-bottom: 1px solid #444;
        color: #ffffff;
    }

    .card-body {
        padding: 1.5rem;
        color: #f8f9fa;
    }

    .bg-dark {
        background-color: #343a40 !important;
        color: #ffffff;
        padding: 1rem;
        border-radius: 0.25rem;
    }

    .bg-dark p {
        color: #ffffff;
        padding: 1rem;
        border-radius: 0.25rem;
    }
</style>

<div class="col-sm-9 col-md-10 mt-5">
    <form action="" method="post">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="form-group col-md-4 mt-2">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
            <div class="form-group col-md-2 align-self-end mt-3">
                <input type="submit" class="btn btn-secondary" name="search_btn" value="Search">
            </div>
        </div>
    </form>

    <?php
    if (isset($_REQUEST['search_btn'])) {
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        $sql = "SELECT * FROM assignwork_tb WHERE assign_date BETWEEN '$start_date' AND '$end_date'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped table-hover mt-4">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Req ID</th>';
            echo '<th scope="col">Request Info</th>';
            echo '<th scope="col">Name</th>';
            echo '<th scope="col">Address</th>';
            echo '<th scope="col">City</th>';
            echo '<th scope="col">Mobile</th>';
            echo '<th scope="col">Technician</th>';
            echo '<th scope="col">Assigned Date</th>';
            echo '<th scope="col">Technician Mobile</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['request_id'] . '</td>';
                echo '<td>' . $row['request_info'] . '</td>';
                echo '<td>' . $row['requester_name'] . '</td>';
                echo '<td>' . $row['requester_add2'] . '</td>';
                echo '<td>' . $row['requester_city'] . '</td>';
                echo '<td>' . $row['requester_mobile'] . '</td>';
                echo '<td>' . $row['assign_tech'] . '</td>';
                echo '<td>' . $row['assign_date'] . '</td>';
                echo '<td>' . $row['assign_tech_mobile'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';

            // Add Print Button
            echo '<button class="btn btn-primary mt-3" onclick="printReport()">Print Report</button>';

        } else {
            echo "<div class='alert alert-warning col-sm-6 ml-5 mt-2' role='alert'> No Records Found ! </div>";
        }

        $conn->close();
    }
    ?>
</div>

<script>
function printReport() {
    // Create a new window
    var printWindow = window.open('', '', 'height=600,width=800');
    
    // Extract only the table content
    var tableContent = document.querySelector('table').outerHTML;
    
    // Write the content to the new window with print-specific styles
    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print Report</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('body { font-family: Arial, sans-serif; margin: 20px; }');
    printWindow.document.write('table { width: 100%; border-collapse: collapse; }');
    printWindow.document.write('th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }');
    printWindow.document.write('th { background-color: #f4f4f4; }');
    printWindow.document.write('</style>');
    printWindow.document.write('</head><body onload="window.print()">');
    printWindow.document.write(tableContent);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
}
</script>

<?php include('includs/footer.php'); ?>
