<?php
include('database/connection.php');

$data = $_POST;
$user_id = (int) $data['userId'];
$first_name = $data['f_name'];
$last_name = $data['l_name'];
$email = $data['email'];
$UpdatedAT = date('Y-m-d H:i:s'); 

try {
    $command = "UPDATE users SET email = :email, last_name = :last_name, first_name = :first_name, UpdatedAT = :UpdatedAT WHERE id = :user_id";
    $stmt = $conn->prepare($command);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':UpdatedAT', $UpdatedAT);
    $stmt->execute();

    echo json_encode([
        'success' => true,
        'message' => $first_name . ' ' . $last_name . ' Successfully Updated'
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>
