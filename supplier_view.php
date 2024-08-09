<?php
session_start();
if (!isset($_SESSION['users'])) {
    header('Location: login.php');
    exit();
}
$_SESSION['table'] = 'suppliers';
$suppliers = include('show_supplier.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Spare Parts Management System</title>
    <?php include('header_script.php'); ?>
</head>
<body>

<div id="dashboardMainContainer">
    <?php include('sidebar.php'); ?>
    <div class="dashboard_content_container" id="dashboard_content_container">
        <?php include('topnav.php'); ?>
        <div class="dashboard_content">

            <div class="dashboard_content_main">        
            
                <div class="row">
                    <div class="column column-17">
                        <h1 class="section_header"><i class="fa fa-list"></i> List of Suppliers</h1>
                        <div class="section_content">
                            <div class="users">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Supplier Name</th>
                                            <th>Location</th>
                                            <th>Email</th>
                                            <th>Products</th>
                                            <th>Created by</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($suppliers as $index => $supplier): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $supplier['supplier_name'] ?></td>
                                                <td><?= $supplier['supplier_location'] ?></td>
                                                <td><?= $supplier['email'] ?></td>
                                                <td>
                                                    <?php
                                                    $product_list = 'Not Set';
                                                    $sid = $supplier['id'];
                                                    $stmt = $conn->prepare("SELECT product_name FROM products, product_supplier WHERE product_supplier.supplier = :sid AND product_supplier.product = products.id");
                                                    if ($stmt->execute(['sid' => $sid])) {
                                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        if (!empty($results)) {
                                                            // Apply htmlspecialchars to each supplier name for safety
                                                            $product_names = array_map(function($item) {
                                                                return htmlspecialchars($item['product_name']);
                                                            }, $results);
                                                            // Create the list in HTML format
                                                            $product_list = '<ul style="padding-left: 20px;"><li>' . implode("</li><li>", $product_names) . '</li></ul>';
                                                        } else {
                                                            $product_list = 'No Products Found';
                                                        }
                                                    } else {
                                                        $product_list = 'Error executing query';
                                                    }
                                                    echo $product_list; // This now contains safe HTML
                                                    ?>
                                                </td>
                                                <?php
                                                include('database/connection.php');
                                                $uid = $supplier['created_by'];
                                                $stmt = $conn->prepare("SELECT * FROM users WHERE id = :pid");
                                                $stmt->execute(['pid' => $uid]);
                                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $created_by_name = $row['first_name'] . ' ' . $row['last_name'];
                                                echo "<td>$created_by_name</td>";
                                                ?>
                                                <td><?= date('M d,Y @ h:i:s A' , strtotime($supplier['CreatedAT'])) ?></td>
                                                <td>
                                                    <a href="" class="deleteSupplier" data-name="<?= $supplier['supplier_name']?>" data-sid="<?= $supplier['id'] ?>"> <i class="fa fa-trash"></i>Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <p class="userCount"><?= count($suppliers) ?> Suppliers </p>
                            </div>
                        </div>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>
<?php include('app_scripts.php'); ?>
</body>
</html>
