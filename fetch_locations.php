<?php
// Database connection
$host = 'localhost';
$dbname = 'nlp'; // Your database name
$username = 'root'; // Your MySQL username
$password = '';     // Your MySQL password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get chapter from query string
    $chapter = isset($_GET['chapter']) ? (int)$_GET['chapter'] : 1; // Default to chapter 1 if not provided

    // Query to fetch location data for the specific chapter
    $stmt = $pdo->prepare("SELECT gpe, latitude, longitude, part_of_text FROM place_name_spacy WHERE chapter = :chapter AND enabled = 1");
    $stmt->execute(['chapter' => $chapter]);
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the data in JSON format
    echo json_encode($locations);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
