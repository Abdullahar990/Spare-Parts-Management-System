<?php
session_start();

include('table_columns.php');
$table_name = $_SESSION['table'];
$columns = $table_columns_mapping[$table_name];

$db_arr = [];
$user = $_SESSION['users'];
$placeholders = []; // Array to store placeholders
foreach ($columns as $column) {
    if(in_array($column, ['CreatedAT','UpdatedAT'])) $value = date('Y-m-d H:i:s');
    else if($column == 'created_by') $value = $user['id'];
    else if($column == 'img') {
        $target_dir = "products/";
        $file_data = $_FILES[$column];

        // Check if file was uploaded without errors
        if($file_data['error'] === UPLOAD_ERR_OK) {
            $file_name = $file_data["name"];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = 'product-' . time() .'.'. $file_ext;
            
            // Move uploaded file to target directory
            if(move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)){
                $value = $file_name;
            } else {
                // Error in moving file
                echo "Error in moving file.";
                exit();
            }
        } else {
            // Error in file upload
            echo "Error in file upload.";
            exit();
        }
    }
    else if($column == 'password' ){
        $password = $_POST[$column];
        if(strlen($password) < 4) {
            $response = [
                'success' => false,
                'message' => 'Password length should be greater than 4 characters.',
            ];
            $_SESSION['response'] = $response;
            header('Location:'.$_SESSION['redirect_to']);
            exit();
    }
    $value = password_hash($password, PASSWORD_DEFAULT);
}
else if($column == 'email') {
    $username = $_POST[$column];
    if(!strpos($username, '@')) {
        $response = [
            'success' => false,
            'message' => 'Username must contain "@" symbol.',
        ];
        $_SESSION['response'] = $response;
        header('Location:'.$_SESSION['redirect_to']);
        exit();
    }
    $value = $username;
}
    else $value = isset($_POST[$column]) ? $_POST[$column] : '';

    $db_arr[$column] = $value;
    $placeholders[] = ":$column"; // Create placeholders without prefixing with :
}

$table_properties = implode(", ", array_keys($db_arr));
$table_placeholders = implode(", ", $placeholders); // Use placeholders without prefixing with :

try {
    $sql = "INSERT INTO $table_name($table_properties) VALUES ($table_placeholders)";

    include('database/connection.php');
    $stmt = $conn->prepare($sql);
    // Bind values to placeholders
    foreach ($db_arr as $column => $value) {
        $stmt->bindValue(":$column", $value);
    }
    $stmt->execute();

    $product_id=$conn->lastInsertId();

    // Corrected code to insert into 'productsuppliers' table
if($table_name === 'products') {
    $suppliers = isset($_POST['suppliers']) ? $_POST['suppliers'] : [];
    if($suppliers) {
        foreach($suppliers as $supplier) {
            $supplier_data = [
                'supplier_id' => $supplier,
                'product_id' => $product_id,
                'UpdatedAT' => date('Y-m-d H:i:s'),
                'CreatedAT' => date('Y-m-d H:i:s')
            ];

            $sql = "INSERT INTO product_supplier(supplier, product, UpdatedAT, CreatedAT) VALUES (:supplier_id, :product_id, :UpdatedAT, :CreatedAT)";
            $stmt = $conn->prepare($sql);
            // Bind values to placeholders
            foreach ($supplier_data as $column => $value) {
                $stmt->bindValue(":$column", $value);
            }
            $stmt->execute();
        }
    }
}


    // Check if the insertion was successful
    if($stmt->rowCount() > 0) {
        // Get the last inserted ID
        $last_insert_id = $conn->lastInsertId();

        $response = [
            'success' => true,
            'message' => 'successfully added to the system',
        ];
        $_SESSION['response'] = $response;
        header('Location:'.$_SESSION['redirect_to']);
        exit();
    } else {
        // Insertion failed
        echo "Insertion failed. No rows were affected.";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
