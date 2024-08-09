<?php
session_start();
if (!isset($_SESSION['users'])) header('Location: login.php');
$_SESSION['table'] = 'users';
$_SESSION['redirect_to'] = 'user_add.php';
$user = $_SESSION['users'];
$users = include('show-users.php')
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
                    <h1 class="section_header"><i class="fa fa-plus"></i> Create User</h1>
                        <div class="userAddFormContainer">

                            <form action="add.php" method="POST" class="appForm">
                                <div class="appFormInputContainer">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="appFormInput" id="first_name" name="first_name">
                                </div>
                                <div class="appFormInputContainer">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="appFormInput" id="last_name" name="last_name">
                                </div>
                                <div class="appFormInputContainer">
                                    <label for="Email">Email</label>
                                    <input type="text" class="appFormInput" id="email" name="email">
                                </div>
                                <div class="appFormInputContainer">
                                    <label for="password">Password</label>
                                    <input type="password" class="appFormInput" id="password" name="password">
                                </div>
                                <input type="hidden" name="table" value="users"/>
                                <button type="submit" class="appBtn"><i class="fa fa-send"></i> Add User</button>
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
<?php include('app_scripts.php') ?>
</body>
</html>
