<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Details</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Film Details</h1>
    </header>
    <main>
        <?php
        $conn = new mysqli('localhost', 'username', 'password', 'cultural_sphere');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $film_id = intval($_GET['id']);
        $sql = "SELECT * FROM films WHERE id = $film_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $film = $result->fetch_assoc();
            echo '<h2>' . $film['title'] . '</h2>';
            echo '<img src="' . $film['cover_image'] . '" alt="' . $film['title'] . '">';
            echo '<p>' . $film['description'] . '</p>';
        } else {
            echo '<p>Film not found.</p>';
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <p>&copy; 2025 Cultural Sphere</p>
    </footer>
</body>
</html>
