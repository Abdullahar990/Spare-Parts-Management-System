<?php
session_start();
if (!isset($_SESSION['users'])) {
    header('Location: login.php');
    exit();
}
$_SESSION['table'] = 'products';
$products = include('show.php');
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
                    <h1 class="section_header"><i class="fa fa-list"></i> List of Products</h1>
                        <div class="section_content">
                            <div class="users">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image </th>
                                            <th>Product Name </th>
                                            <th width="20%">Description </th>
                                            <th width="10%">Suppliers </th>
                                            <th>Created by </th>
                                            <th>Created At </th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($products as $index => $product): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><img class="productImages" src="products/<?= $product['img']?>" alt=""></td>
                                            <td><?= $product['product_name'] ?></td>
                                            <td><?= $product['description'] ?></td>
                                            <td>
                                                <?php
                                                    $supplier_list = 'Not Set';
                                                    $pid = $product['id'];
                                                    $stmt = $conn->prepare("SELECT supplier_name FROM suppliers, product_supplier WHERE product_supplier.product = :pid AND product_supplier.supplier = suppliers.id");
                                                    if ($stmt->execute(['pid' => $pid])) {
                                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        if (!empty($results)) {
                                                            // Apply htmlspecialchars to each supplier name for safety
                                                            $supplier_names = array_map(function($item) {
                                                                return htmlspecialchars($item['supplier_name']);
                                                            }, $results);
                                                            // Create the list in HTML format
                                                            $supplier_list = '<ul style="padding-left: 20px;"><li>' . implode("</li><li>", $supplier_names) . '</li></ul>';

                                                        } else {
                                                            $supplier_list = 'No suppliers found';
                                                        }
                                                    } else {
                                                        $supplier_list = 'Error executing query';
                                                    }
                                                    echo $supplier_list; // This now contains safe HTML
                                                ?>
                                            </td>


                                            <?php
                                                include('database/connection.php');
                                                $uid = $product['created_by'];
                                                $stmt = $conn->prepare("SELECT * FROM users WHERE id = :pid");
                                                $stmt->execute(['pid' => $uid]);
                                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $created_by_name = $row['first_name'] . ' ' . $row['last_name'];
                                                echo "<td>$created_by_name</td>";
                                            ?>
                                            <td><?= date('M d,Y @ h:i:s A' , strtotime($product['CreatedAT'])) ?></td>
                                            <td>
                                                <a href="" class="deleteProduct" data-name="<?= $product['product_name']?>" data-pid="<?= $product['id'] ?>"> <i class="fa fa-trash"></i>Delete</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <p class="userCount"><?= count($products) ?> Products </p>

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
