<?php 
include '../db.php'; // Include your database connection file

// Fetch art details based on ID
if (isset($_GET['id'])) {
    $artId = intval($_GET['id']);
    try {
        $query = "SELECT name, description, location, created_at, creator, image_path FROM art WHERE id = :id"; // Include image_path
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $artId, PDO::PARAM_INT);
        $stmt->execute();
        $art = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$art) {
            die("Art not found.");
        }
    } catch (PDOException $e) {
        die("Error fetching art details: " . $e->getMessage());
    }
} else {
    die("Invalid art ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($art['name']); ?></title>
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

        .art-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            min-height: 100vh;
            padding: 40px;
            gap: 40px;
            position: relative; /* Required for positioning */
        }

        .art-image {
            flex: 1;
            max-width: 400px;
            text-align: center;
        }

        .art-image img {
            max-width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .art-info {
            flex: 2;
            background: rgba(255, 255, 255, 0.72);
            border-radius: 15px;
            padding: 20px 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative; /* Context for positioning */
        }

        .art-info h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #440e1b;
            text-shadow: 1px 1px 2px black;
        }

        .art-info p {
            margin: 10px 0;
            line-height: 1.8;
            font-size: 1.2rem;
        }

        .art-info strong {
            color: rgb(83, 18, 33);
        }

        .back-button {
            position: absolute; /* Allows precise placement */
            top: 380px; /* Adjust spacing from the top */
            right: 120px; /* Push the button outside the right of the card */
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

        .btn-secondary {
            background: #440e1b !important;
        }

        .btn-success {
            background: #440e1b !important;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="art-container">
        <div class="art-image">
            <img src="../<?php echo htmlspecialchars($art['image_path']); ?>" 
                 alt="<?php echo htmlspecialchars($art['name']); ?>" 
                 onerror="this.src='../images/art/fallback.jpg'">
        </div>
        <div class="art-info">
            <h1><?php echo htmlspecialchars($art['name']); ?></h1>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($art['description']); ?></p>
            <p><strong>Creator:</strong> <?php echo htmlspecialchars($art['creator']); ?></p>
            <p><strong>Location:</strong> <?php echo htmlspecialchars($art['location']); ?></p>
            
            <!-- Bootstrap Dropdown for collections -->
            <div class="dropdown mb-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Select a Collection
                </button>
                <ul class="dropdown-menu" id="collection-dropdown" aria-labelledby="dropdownMenuButton">
                    <!-- Options dynamically populated -->
                </ul>
            </div>
            <button class="btn btn-success" onclick="addToCollection()">Add</button>
        </div>
        <button class="back-button" onclick="window.history.back()">Go Back</button>
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

        // Add the artwork to the selected collection
        async function addToCollection() {
            const collectionId = document.getElementById('dropdownMenuButton').getAttribute('data-id');
            const artId = <?php echo $artId; ?>;

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
                        item_type: 'art',
                        item_id: artId
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
