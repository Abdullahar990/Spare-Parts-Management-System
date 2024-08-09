<?php
include('database/connection.php');

$data = $_POST;
$user_id = (int) $data['user_id'];
$first_name = $data['f_name'];
$last_name = $data['l_name'];

try {
    $command = "DELETE FROM users WHERE id = :user_id";
    $stmt = $conn->prepare($command);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    echo json_encode([
        'success' => true,
        'message' => $first_name . ' ' . $last_name . ' Successfully Deleted'
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error Processing your Request.'
    ]);
}
?>
