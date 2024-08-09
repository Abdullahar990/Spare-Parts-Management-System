<?php
    include('database/connection.php');
    
    session_start();
    if(isset($_SESSION['users'])) header('Location: dashboard.php');

    $error_message = '';
    if($_POST){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $users = $stmt->fetchAll();

        $user_exist = false;
        foreach($users as $user){
            $upass = $user['password'];
        
            if(password_verify($password,$upass)){
                $user_exist = true;
                $_SESSION['users'] = $user;
                break;
            }
        }
        
        if($user_exist) header('Location: dashboard.php');
        else $error_message = 'Please make sure that username and password are correct.';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Spare Parts Management System</title>
</head>
<body class="loginbody">
    <?php
        if(!empty($error_message)){ ?>
            <div class="errormessage">
                <strong>ERROR: </strong><p><?= $error_message ?> </p>
            </div>
    <?php } ?>
    <div class="container">
        <div class="loginheader">
            <h1>SPMS</h1>
            <p>Spare Parts Management System</p>
        </div>
        <div class="loginbody">
            <form action="login.php" method="POST">
                <div class="logininputcontainer">
                    <label for="">User Name</label>
                    <input placeholder="username" name="username" type="text">
                </div>
                <div class="logininputcontainer">
                    <label for="">password</label>
                    <input placeholder="password" name="password" type="password">
                </div>
                <div class="loginbtn">
                    <button>log in</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>