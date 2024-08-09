<?php
include('database/connection.php');

$stmt = $conn->prepare("SELECT * FROM products ORDER BY CreatedAT DESC");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$results = $stmt->fetchAll();
return $results;
