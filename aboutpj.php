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
            <a href="#" class="logo">NLP Website</a>
            <ul class="nav-links">
                <li><a href="/NLP/index.php">Home</a></li>
                <li><a href="/NLP/aboutpj.php">About Project</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Ulysses<br>Novel by James Joyce</h1>
        <h2>About Project</h2>

  
        <div class="text-container">
            <h2>Introduction</h2>
            <p>This web application is designed to present the geographic locations mentioned in 
                James Joyce's novel "Ulysses." During the data processing phase, I utilize Named 
                Entity Recognition (NER) techniques, specifically SpaCy, to identify and extract 
                geographic names from the text. Subsequently, the extracted geographic names are 
                converted into geographic coordinates using the 
                geocoding technology GeoPy, and the mentioned locations are visualised using 
                OpenStreetMap. This application allows users to intuitively view the extracted 
                locations on an interactive map, providing a valuable tool for spatial analysis 
                and exploration, enabling users to gain deeper insights from the geographic distribution
                 within the text.</p>
            <h2>User Guide:</h2>
            <p>Users can click on the chapter button to view the map, which is zoomable, allowing them to 
                adjust the view as needed. By clicking on the map markers, users can see the place names 
                mentioned in that chapter, their coordinates, and the relevant sentences containing those 
                place names.</p>
            <h2>Additional Features:</h2>
            <p>This webpage offers a search function, enabling users to enter a place name and see which 
                chapter of the novel it is mentioned in, as well as the frequency of mentions.</p>
            <h2><b>Enjoy your journey of exploring the text!</b></h2>
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
