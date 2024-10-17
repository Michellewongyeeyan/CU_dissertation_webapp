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
            <a href="index.php" class="logo">NLP Website</a>
            <ul class="nav-links">
                <li><a href="/Code_for_webapp/index.php">Home</a></li>
                <li><a href="/Code_for_webapp/aboutpj.php">About Project</a></li>
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

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([53.349805, -6.26031], 9); // Center on Dublin

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Function to convert decimal degrees to DMS format
        function toDMS(degrees) {
            const d = Math.floor(Math.abs(degrees));
            const m = Math.floor((Math.abs(degrees) - d) * 60);
            const s = ((Math.abs(degrees) - d - m / 60) * 3600).toFixed(1);
            const direction = degrees >= 0 ? (degrees === d ? '' : (degrees > 0 ? 'N' : 'S')) : 'S';
            return `${d}°${m}'${s}"${direction}`;
        }

        // Fetch the locations based on the current chapter
fetch('fetch_locations.php?chapter=<?php echo $currentChapter; ?>')
    .then(response => response.json())
    .then(data => {
        // Create a dictionary to store markers by GPE
        const locationMap = {};

        data.forEach(function(location) {
            const gpe = location.gpe;
            const lat = location.latitude;
            const lon = location.longitude;
            const partOfText = location.part_of_text;

            if (locationMap[gpe]) {
                locationMap[gpe].popupContent += `<br><br>${partOfText}`;
            } else {
                const formattedLatitude = toDMS(lat);
                const formattedLongitude = toDMS(lon);

                locationMap[gpe] = {
                    lat: lat,
                    lon: lon,
                    popupContent: `<b>${gpe}</b><br><b>${formattedLatitude}${formattedLongitude}</b><br>${partOfText}`
                };
            }
        });

        Object.values(locationMap).forEach(function(loc) {
            L.marker([loc.lat, loc.lon])
                .addTo(map)
                .bindPopup(loc.popupContent);
        });
    })
    .catch(error => console.log('Error fetching location data:', error));

    </script>

</body>
</html>