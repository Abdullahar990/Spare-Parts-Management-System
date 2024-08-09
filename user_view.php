<?php
session_start();
if (!isset($_SESSION['users'])) header('Location: login.php');
$_SESSION['table'] = 'users';
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
            
                <div class="column column-17">
                    <h1 class="section_header"><i class="fa fa-list"></i> List of Users</h1>
                        <div class="section_content">
                            <div class="users">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name </th>
                                            <th>Last Name </th>
                                            <th>Email </th>
                                            <th>Created At </th>
                                            <th>Updated At </th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($users as $index=> $user){?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td class='firstName'><?= $user['first_name'] ?></td>
                                            <td class='lastName'><?= $user['last_name'] ?></td>
                                            <td class='email'><?= $user['email'] ?></td>
                                            <td><?= date('M d,Y @ h:i:s A' , strtotime($user['CreatedAT'])) ?></td>
                                            <td><?= date('M d,Y @ h:i:s A' , strtotime($user['UpdatedAT'])) ?></td>
                                            <td>
                                                <a href="" class ="updateUser" data-userid="<?= $user['id'] ?>"><i class="fa fa-pencil"></i>Edit</a>
                                                <a href="" class ="deleteUser" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['first_name'] ?>" data-lname="<?= $user['last_name'] ?>"><i class="fa fa-trash"></i>Delete</a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                                <p class = "userCount"><?= count($users) ?> Users </p>

                            </div>

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


