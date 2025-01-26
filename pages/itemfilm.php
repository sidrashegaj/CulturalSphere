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
    <!-- Include Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #1c1c1c, rgb(58, 26, 26));
            color: white;
        }
        .film-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
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
            color: rgb(83, 18, 33);
        }
        .action-buttons {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
        }
        .btn-secondary {
            background: #440e1b !important;
            border-color: #440e1b !important;
        }
        .btn-success {
            background: #440e1b !important;
            border-color: #440e1b !important;
        }
        .back-button {
            margin-left: 40%;
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
            background: #660000;
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

            <!-- Action Buttons -->
            <div class="action-buttons">
                <!-- Bootstrap Dropdown for collections -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Select a Collection
                    </button>
                    <ul class="dropdown-menu" id="collection-dropdown" aria-labelledby="dropdownMenuButton">
                        <!-- Options will be dynamically populated -->
                    </ul>
                </div>
                <button class="btn btn-success" onclick="addToCollection()">Add</button>
                <button class="back-button" onclick="window.history.back()">Go Back</button>
            </div>
        </div>
    </div>

    <script>
        // Fetch collections for the dropdown
        async function fetchCollections() {
            try {
                const response = await fetch('../api/collections.php', { method: 'GET', credentials: 'include' });
                const collections = await response.json();

                const dropdown = document.getElementById('collection-dropdown');
                dropdown.innerHTML = collections.map(c => `<li><a class="dropdown-item" href="#" data-id="${c.id}">${c.name}</a></li>`).join('');

                // Add click event for dropdown items
                document.querySelectorAll('.dropdown-item').forEach(item => {
                    item.addEventListener('click', function () {
                        const selected = document.getElementById('dropdownMenuButton');
                        selected.innerText = this.innerText;
                        selected.setAttribute('data-id', this.getAttribute('data-id'));
                    });
                });
            } catch (error) {
                console.error('Error fetching collections:', error);
            }
        }

        // Add the film to the selected collection
        async function addToCollection() {
            const collectionId = document.getElementById('dropdownMenuButton').getAttribute('data-id');
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
