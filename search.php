<?php
// Database connection details
$servername = "localhost";  // Change if different
$username = "root";         // Change if different
$password = "";             // Change if different
$dbname = "nlp";            // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the form
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Sanitize the search query to prevent SQL injection
$searchQuery = $conn->real_escape_string($searchQuery);

// Updated query to get total mentions and mentions by chapter
$sql = "SELECT chapter, gpe, COUNT(DISTINCT part_of_text) AS mentions_count, 
               (SELECT COUNT(DISTINCT part_of_text) 
                FROM place_name_spacy 
                WHERE gpe LIKE '%$searchQuery%') AS total_mentions
        FROM place_name_spacy 
        WHERE gpe LIKE '%$searchQuery%' 
        GROUP BY chapter, gpe
        ORDER BY chapter ASC";

$result = $conn->query($sql);

// Fetch total mentions (from the first row, since it's the same for all rows)
$total_mentions = 0;
if ($result->num_rows > 0) {
    $first_row = $result->fetch_assoc();
    $total_mentions = $first_row['total_mentions'];
    $result->data_seek(0); // Reset result pointer back to the beginning
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="search.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php" class="logo">NLP Website</a>
            <ul class="nav-links">
                <li><a href="/NLP/index.php">Home</a></li>
                <li><a href="#">About Project</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div class="result-container">
        <h1>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h1>

        <!-- Display total mentions -->
        <p><strong>Total mentions:</strong> <?php echo $total_mentions; ?></p>

        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li>
                        Place: <strong><?php echo htmlspecialchars($row['gpe']); ?></strong> 
                        mentioned <strong><?php echo $row['mentions_count']; ?></strong> times in 
                        <a href="all_chapter.php?chapter=<?php echo $row['chapter']; ?>">Chapter <?php echo $row['chapter']; ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No results found for "<?php echo htmlspecialchars($searchQuery); ?>"</p>
        <?php endif; ?>

        <a href="index.php" class="back-button">Back to Chapters</a>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 My Website. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
