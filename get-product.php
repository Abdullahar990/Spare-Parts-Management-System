<?php
include('database/connection.php');

// Check if the 'id' parameter is set in the URL
if (!isset($_GET['id'])) {
    // If 'id' is not set, return an error response
    echo json_encode(['success' => false, 'message' => 'Product ID is missing']);
    exit();
}

// Get the product ID from the URL query parameters
$id = $_GET['id'];

// Prepare and execute the SQL query to fetch product details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();

// Fetch the product details as an associative array
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the product was found
if (!$product) {
    // If the product was not found, return an error response
    echo json_encode(['success' => false, 'message' => 'Product not found']);
    exit();
}

// If the product was found, encode the product details as JSON and return it
echo json_encode(['success' => true, 'product' => $product]);
?>
