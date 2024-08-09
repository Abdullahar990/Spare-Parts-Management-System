<?php
include('database/connection.php');

$data = $_POST;
$id = (int) $data['id'];
$table = $data['table'];

try {

    //delete junction table
    if($table === 'suppliers')
    {
        $supplier_id= $id;
        $command = "DELETE FROM product_supplier WHERE supplier = {$id}";
        $conn->exec($command);
    }
    if($table === 'products')
    {
        $supplier_id= $id;
        $command = "DELETE FROM product_supplier WHERE product = {$id}";
        $conn->exec($command);
    }

    //delete main table
    $command = "DELETE FROM $table WHERE id = {$id}";


    $conn->exec($command);

    echo json_encode([
        'success' => true,
        'message' => 'Successfully Deleted'
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error Processing your Request.'
    ]);
}
?>
