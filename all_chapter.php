<?php
// Get the chapter number from the URL, default to 1 if not set
$currentChapter = isset($_GET['chapter']) ? (int)$_GET['chapter'] : 1;

// Define the total number of chapters
$totalChapters = 18;

// Define the next and previous chapter numbers
$nextChapter = $currentChapter < $totalChapters ? $currentChapter + 1 : null;
$previousChapter = $currentChapter > 1 ? $currentChapter - 1 : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter <?php echo $currentChapter; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">  <!-- General styling -->
    <link rel="stylesheet" type="text/css" href="mapping.css"> <!-- Map styling -->

    <!-- Leaflet CSS (for OpenStreetMap) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php" class="logo">NLP Website</a> <!-- Links back to the main index -->
            <ul class="nav-links">
                <li><a href="/NLP/index.php">Home</a></li>
                <li><a href="#">About Project</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Chapter <?php echo $currentChapter; ?> Locations Map</h1>
        <p>This map shows all the locations mentioned in Chapter <?php echo $currentChapter; ?>.</p>

        <div class="nav-buttons">
            <?php if ($previousChapter): ?>
                <a href="all_chapter.php?chapter=<?php echo $previousChapter; ?>" class="nav-button-inline">Previous Chapter</a>
            <?php endif; ?>
            <?php if ($nextChapter): ?>
                <a href="all_chapter.php?chapter=<?php echo $nextChapter; ?>" class="nav-button-inline">Next Chapter</a>
            <?php endif; ?>
        </div>

        <!-- Map container for OpenStreetMap -->
        <div id="map"></div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 My Website. All rights reserved.</p>
        </div>
    </footer>

    <!-- Leaflet JavaScript (for OpenStreetMap) -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([53.349805, -6.26031], 6); // Center on Dublin

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Fetch the locations based on the current chapter
        fetch('fetch_locations.php?chapter=<?php echo $currentChapter; ?>')
            .then(response => response.json())
            .then(data => {
                data.forEach(function(location) {
                    L.marker([location.latitude, location.longitude])
                        .addTo(map)
                        .bindPopup(`<b>${location.gpe}</b><br>${location.part_of_text}`);
                });
            })
            .catch(error => console.log('Error fetching location data:', error));
    </script>

</body>
</html>
