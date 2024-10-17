<?php

$host = 'localhost';
$dbname = 'nlp'; 
$username = 'root'; 
$password = '';   

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $chapter = isset($_GET['chapter']) ? (int)$_GET['chapter'] : 1; // Default to chapter 1 if not provided

    $stmt = $pdo->prepare("SELECT gpe, latitude, longitude, part_of_text FROM place_name_spacy WHERE chapter = :chapter AND enabled = 1");
    $stmt->execute(['chapter' => $chapter]);
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($locations);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}4
?>
