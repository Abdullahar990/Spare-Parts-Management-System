<?php
include('database/connection.php');
$stmt = $conn->prepare("SELECT * FROM users ORDER BY CreatedAT DESC");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$results = $stmt->fetchAll();
return $results;
