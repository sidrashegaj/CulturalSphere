<?php 
include '../db.php'; // Include your database connection file

// Fetch film details based on ID
if (isset($_GET['id'])) {
    $filmId = intval($_GET['id']);
    try {
        $query = "SELECT title, description, director, release_year, cover_image FROM films WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $filmId, PDO::PARAM_INT);
        $stmt->execute();
        $film = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$film) {
            die("Film not found.");
        }
    } catch (PDOException $e) {
        die("Error fetching film details: " . $e->getMessage());
    }
} else {
    die("Invalid film ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($film['title']); ?></title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #1c1c1c,rgb(58, 26, 26));
            color: white;
        }
        .film-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px;
            gap: 40px;
        }
        .film-image {
            flex: 1;
            max-width: 400px;
            text-align: center;
        }
        .film-image img {
            max-width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
        .film-info {
            flex: 2;
            background: rgba(255, 255, 255, 0.72);
            border-radius: 15px;
            padding: 20px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .film-info h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #440e1b;
            text-shadow: 1px 1px 2px black;
        }
        .film-info p {
            margin: 10px 0;
            line-height: 1.8;
            font-size: 1.2rem;
        }
        .film-info strong {
            color:rgb(83, 18, 33);
        }
        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #440e1b;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            text-transform: uppercase;
            font-weight: bold;
            transition: background 0.3s;
        }
        .back-button:hover {
            background: #440e1b;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="film-container">
        <div class="film-image">
            <img src="<?php echo htmlspecialchars($film['cover_image'] ?: '../images/Avatar.jpg'); ?>" 
                 alt="<?php echo htmlspecialchars($film['title']); ?>">
        </div>
        <div class="film-info">
            <h1><?php echo htmlspecialchars($film['title']); ?></h1>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($film['description']); ?></p>
            <p><strong>Director:</strong> <?php echo htmlspecialchars($film['director']); ?></p>
            <p><strong>Release Year:</strong> <?php echo htmlspecialchars($film['release_year']); ?></p>
            <label for="collection-select">Add to Collection:</label>
    <select id="collection-select">
    </select>
    <button onclick="addToCollection()">Add</button>

            <button class="back-button" onclick="window.history.back()">Go Back</button>
        </div>
    </div>
    <script>
    // Fetch collections for the dropdown
    async function fetchCollections() {
        try {
            const response = await fetch('../api/collections.php', { method: 'GET', credentials: 'include' });
            const collections = await response.json();

            const select = document.getElementById('collection-select');
            select.innerHTML = collections.map(c => `<option value="${c.id}">${c.name}</option>`).join('');
        } catch (error) {
            console.error('Error fetching collections:', error);
        }
    }

    // Add the film to the selected collection
    async function addToCollection() {
        const collectionId = document.getElementById('collection-select').value;
        const filmId = <?php echo $filmId; ?>;

        if (!collectionId) {
            alert('Please select a collection.');
            return;
        }

        try {
            const response = await fetch('../api/add_to_collection.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    collection_id: collectionId,
                    item_type: 'film',
                    item_id: filmId
                }),
                credentials: 'include'
            });

            const result = await response.json();
            alert(result.message || result.error);
        } catch (error) {
            console.error('Error adding to collection:', error);
        }
    }

    // Fetch collections on page load
    fetchCollections();
</script>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
