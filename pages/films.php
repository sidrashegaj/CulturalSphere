<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Catalog</title>
    <!-- Adjusted the CSS file location -->
    <link rel="stylesheet" href="../css/pagesstyles.css">
</head>
<body>
    <section class="hero">
        <div class="hero-content">
            <div class="hero-images">
                <img src="../images/films/filmscene.jpg" alt="CitizenKane" class="image-tablet">
                <img src="../images/films/filmscene2.jpg" alt="TheGodfather" class="image-dog">
                <img src="../images/films/filmscene3.jpg" alt="DrStrangelove" class="image-man">
                <img src="../images/films/filmscene4.jpg" alt="TheBookThief" class="image-book">
            </div>
            <div class="hero-circle">
                <p>CULTURAL SPHERE</p>
                <div class="arrow">↓</div>
            </div>
        </div>
    </section>


    <main class="catalog">
        <?php
        // Hardcoded array of films
        $films = [
            [
                "id" => 1,
                "title" => "The Great Gatsby",
                "cover_image" => "greatgatsbybook.jpg"
            ],
            [
                "id" => 2,
                "title" => "The Matrix",
                "cover_image" => "https://via.placeholder.com/150?text=The+Matrix"
            ],
            [
                "id" => 3,
                "title" => "Interstellar",
                "cover_image" => "https://via.placeholder.com/150?text=Interstellar"
            ],
            [
                "id" => 4,
                "title" => "The Grand Budapest Hotel",
                "cover_image" => "https://via.placeholder.com/150?text=Grand+Budapest"
            ],
            [
                "id" => 5,
                "title" => "Pulp Fiction",
                "cover_image" => "https://via.placeholder.com/150?text=Pulp+Fiction"
            ],
            [
                "id" => 6,
                "title" => "The Dark Knight",
                "cover_image" => "https://via.placeholder.com/150?text=Dark+Knight"
            ]
        ];

        // Display films
        foreach ($films as $film) {
            echo '<div class="film">';
            echo '<a href="itemfilm.php?id=' . $film['id'] . '">';
            echo '<img src="' . $film['cover_image'] . '" alt="' . $film['title'] . '">';
            echo '<p>' . $film['title'] . '</p>';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2025 Cultural Sphere</p>
    </footer>
</body>
</html>
