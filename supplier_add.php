<?php
session_start();
if (!isset($_SESSION['users'])) header('Location: login.php');
$_SESSION['table'] = 'suppliers';
$_SESSION['redirect_to'] = 'supplier_add.php';
$user = $_SESSION['users'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Supplier - Car Spare Parts Management System</title>
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
                    <h1 class="section_header"><i class="fa fa-plus"></i> Create Supplier</h1>
                        <div class="userAddFormContainer">

                            <form action="add.php" method="POST" class="appForm" enctype="multipart/form-data">
                                <div class="appFormInputContainer">
                                    <label for="supplier_name">Supplier Name</label>
                                    <input type="text" class="appFormInput" id="supplier_name" name="supplier_name">
                                </div>
                                <div class="appFormInputContainer">
                                    <label for="supplier_location">Location </label>
                                    <input type="text" class="appFormInput" id="supplier_location" name="supplier_location">
                                </div>

                                <div class="appFormInputContainer">
                                    <label for="email">Email</label>
                                    <input type="text" class="appFormInput" id=email" name="email">
                                </div>
                                <button type="submit" class="appBtn"><i class="fa fa-plus"></i> Add Supplier</button>
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
