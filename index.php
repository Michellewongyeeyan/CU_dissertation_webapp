<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapters Index Page</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/Code_for_webapp/index.php" class="logo">NLP Website</a>
            <ul class="nav-links">
                <li><a href="/Code_for_webapp/index.php">Home</a></li>
                <li><a href="/Code_for_webapp/aboutpj.php">About Project</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Ulysses<br>Novel by James Joyce</h1>
        <h2>Chapters Index</h2>

        <!-- Search Form -->
        <form action="search.php" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Search for a place..." required>
            <button type="submit">Search</button>
        </form>

        <div class="chapter-grid">
            <?php
            // Loop to generate 18 buttons for 18 chapters with the correct path
            for ($i = 1; $i <= 18; $i++) {
                echo "<a href='all_chapter.php?chapter=$i' class='chapter-button'>Chapter $i</a>";
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 My Website. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
