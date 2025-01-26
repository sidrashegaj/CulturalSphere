<?php 
include '../db.php'; 

if (isset($_GET['id'])) {
    $bookId = intval($_GET['id']);
    try {
        $query = "SELECT title, author, description, publication_year, cover_image FROM books WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $bookId, PDO::PARAM_INT);
        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            die("Book not found.");
        }
    } catch (PDOException $e) {
        die("Error fetching book details: " . $e->getMessage());
    }
} else {
    die("Invalid book ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?></title>
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

        .book-image {
            flex: 1;
            max-width: 400px;
            text-align: center;
        }
        .book-image img {
            max-width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
    
        .book-info h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #440e1b;
            text-shadow: 1px 1px 2px black;
        }
        .book-info p {
            margin: 10px 0;
            line-height: 1.8;
            font-size: 1.2rem;
        }
        .book-info strong {
            color: rgb(83, 18, 33);
        }
        .book-container {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between; /* Ensures spacing between content */
    min-height: 100vh;
    padding: 40px;
    gap: 40px;
    position: relative; /* Required for absolute positioning */
}

.book-info {
    flex: 2;
    background: rgba(255, 255, 255, 0.72);
    border-radius: 15px;
    padding: 20px 30px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative; /* Context for positioning */
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
        .btn-success{
            background: #440e1b !important;

        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="book-container">
    <div class="book-image">
        <img src="<?php echo htmlspecialchars($book['cover_image'] ?: '../images/The Iliad.jpeg'); ?>" 
             alt="<?php echo htmlspecialchars($book['title']); ?>">
    </div>
    <div class="book-info">
        <div class="info-content">
            <h1><?php echo htmlspecialchars($book['title']); ?></h1>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
            <p><strong>Publication Year:</strong> <?php echo htmlspecialchars($book['publication_year']); ?></p>
            
            <!-- Bootstrap Dropdown for collections -->
            <div class="dropdown mb-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Select a Collection
                </button>
                <ul class="dropdown-menu" id="collection-dropdown" aria-labelledby="dropdownMenuButton">
                    <!-- Options will be dynamically populated -->
                </ul>
            </div>
            <button class="btn btn-success" onclick="addToCollection()">Add</button>
        </div>
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

        // Add the book to the selected collection
        async function addToCollection() {
            const collectionId = document.getElementById('dropdownMenuButton').getAttribute('data-id');
            const bookId = <?php echo $bookId; ?>;

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
                        item_type: 'book',
                        item_id: bookId
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
