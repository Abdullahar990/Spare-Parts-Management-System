<?php
session_start();
if (!isset($_SESSION['users'])) header('Location: login.php');

include('database/connection.php');

// Get counts of users, products, and suppliers
$stmt = $conn->prepare("SELECT COUNT(*) as user_count FROM users");
$stmt->execute();
$user_count = (int)$stmt->fetchColumn();

$stmt = $conn->prepare("SELECT COUNT(*) as product_count FROM products");
$stmt->execute();
$product_count = (int)$stmt->fetchColumn();

$stmt = $conn->prepare("SELECT COUNT(*) as supplier_count FROM suppliers");
$stmt->execute();
$supplier_count = (int)$stmt->fetchColumn();

// Prepare data for the pie graph
$results = [
    [
        'name' => 'Users',
        'y' => $user_count,
    ],
    [
        'name' => 'Products',
        'y' => $product_count,
    ],
    [
        'name' => 'Suppliers',
        'y' => $supplier_count,
    ],
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Spare Parts Management System</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="user_add.css">
    <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
</head>
<body>

<div id="dashboardMainContainer">
    <?php include('sidebar.php'); ?>
    <div class="dashboard_content_container" id="dashboard_content_container">
        <?php include('topnav.php'); ?>
        <div class="dashboard_content">
            <div class="dashboard_content_main">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <p class="highcharts-description" style="text-align: center;">
                        <b></b>
                    </p>
                </figure>
            </div>
        </div>
    </div>

</div>
<script src = "script.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    var graphData = <?= json_encode($results) ?>;
    Highcharts.chart('container', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Counts of Users, Products, and Suppliers'
        },
        series: [{
            name: 'Count',
            colorByPoint: true,
            data: graphData
        }]
    });
</script>
</body>
</html>
