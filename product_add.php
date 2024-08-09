<?php
session_start();
if (!isset($_SESSION['users'])) header('Location: login.php');
$_SESSION['table'] = 'products';
$_SESSION['redirect_to'] = 'product_add.php';
$user = $_SESSION['users'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Spare Parts Management System</title>
    <?php include('header_script.php') ?>
    </head>
<body>

<div id="dashboardMainContainer">
    <?php include('sidebar.php'); ?>
    <div class="dashboard_content_container" id="dashboard_content_container">
        <?php include('topnav.php'); ?>
        <div class="dashboard_content">

            
            <div class="dashboard_content_main">        
            
            <div class="row">
                <div class="column column-15">
                    <h1 class="section_header"><i class="fa fa-plus"></i> Create Product</h1>
                        <div class="userAddFormContainer">

                            <form action="add.php" method="POST" class="appForm" enctype="multipart/form-data">
                                <div class="appFormInputContainer">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="appFormInput" id="product_name" name="product_name">
                                </div>
                                <div class="appFormInputContainer">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="appFormInput productTexAreaInput" id="description" name="description"></textarea>
                                </div>
                                <div class="appFormInputContainer">
                                    <label for="price">price</label>
                                    <input type="text" class="appFormInput" id="price" name="price">
                                </div>
                                <div class="appFormInputContainer">
                                    <label for="stock">stock</label>
                                    <input type="text" class="appFormInput" id="stock" name="stock">
                                </div>
                                <div class="appFormInputContainer">
                                    <label for="description">Suppliers</label>
                                    <select name="suppliers[]" id="suppliersSelect"multiple="">
                                    <option value="">Select Supplier</option>
                                    <?php
                                        session_start();
                                        if (!isset($_SESSION['users'])) header('Location: login.php');

                                        // Fetch suppliers from the session or from the file, not both
                                        if (isset($_SESSION['suppliers'])) {
                                            $suppliers = $_SESSION['suppliers'];
                                        } else {
                                            $suppliers = include('showsupplier.php');
                                        }

                                        // Loop through suppliers and generate options
                                        foreach($suppliers as $supplier) {
                                            echo "<option value='" . $supplier['id'] . "'>" . $supplier['supplier_name'] . "</option>";
                                        }
                                    ?>

                                    </select>
                                </div>

                                <div class="appFormInputContainer">
                                    <label for="product_name">Product Image</label>
                                    <input type="file"  name="img"></i>
                                </div>
                                <button type="submit" class="appBtn"><i class="fa fa-plus"></i> Add Product</button>
                            </form>

                            <?php
                            // Check if there's a response message in the session
                            if (isset($_SESSION['response'])) {
                                $response_message = $_SESSION['response']['message'];
                                $is_success = $_SESSION['response']['success'];
                                ?>
                                <div class="responseMessage">
                                    <p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>">
                                        <?= $response_message ?>
                                    </p>
                                </div>
                                <?php
                                // Unset the session variable after displaying the message
                                unset($_SESSION['response']);
                            }
                            ?>

                        </div>
                </div> 
                </div>
            </div>                    
        </div>
    </div>
    
</div>
<script src="script.js"></script>
</body>
</html>
