<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Collections</title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        #collections-container {
            max-width: 1200px;
            margin: 20px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .collection-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .collection-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .collection-card h3 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #333;
        }

        .collection-card p {
            color: #666;
            margin: 0 0 20px;
        }

        .collection-card button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .collection-card button:hover {
            background-color: #2980b9;
        }

        .pinterest-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .grid-item {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .grid-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .grid-item img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .grid-item p {
            margin: 0;
            font-size: 1em;
            color: #333;
        }

        button.back-button {
            display: block;
            margin: 20px auto;
            background-color: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button.back-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>My Collections</h1>

    <div id="collections-container"></div>

    <script>
        async function fetchCollections() {
            try {
                const response = await fetch('../api/collections.php', {
                    method: 'GET',
                    credentials: 'include'
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch collections');
                }

                const collections = await response.json();

                const container = document.getElementById('collections-container');
                if (collections.length > 0) {
                    container.innerHTML = collections.map(collection => `
                        <div class="collection-card">
                            <h3>${collection.name}</h3>
                            <p>${collection.description || "No description provided."}</p>
                            <button onclick="viewCollection(${collection.id})">View Collection</button>
                        </div>
                    `).join('');
                } else {
                    container.innerHTML = `<p>No collections found.</p>`;
                }
            } catch (error) {
                console.error('Error fetching collections:', error);
                alert('Error fetching collections. Please try again.');
            }
        }

        async function viewCollection(collectionId) {
            try {
                const response = await fetch(`../api/collections.php?id=${collectionId}`, {
                    method: 'GET',
                    credentials: 'include',
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch collection items');
                }

                const items = await response.json();

                const container = document.getElementById('collections-container');
                if (items.length > 0) {
                    container.innerHTML = `
                        <h2>Collection Items</h2>
                        <div class="pinterest-grid">
                            ${items.map(item => `
                                <div class="grid-item">
                                    ${item.item_type === 'film' ? `<img src="../images/films/${item.film_title.replace(/ /g, "_")}.jpg" alt="${item.film_title}">` : ''}
                                    ${item.item_type === 'book' ? `<img src="../images/books/${item.book_title.replace(/ /g, "_")}.jpg" alt="${item.book_title}">` : ''}
                                    <p>${item.item_type === 'film' ? `Film: ${item.film_title}` : `Book: ${item.book_title}`}</p>
                                </div>
                            `).join('')}
                        </div>
                        <button class="back-button" onclick="fetchCollections()">Back to Collections</button>
                    `;
                } else {
                    container.innerHTML = `
                        <h2>No Items Found in Collection</h2>
                        <button class="back-button" onclick="fetchCollections()">Back to Collections</button>
                    `;
                }
            } catch (error) {
                console.error('Error fetching collection items:', error);
                alert('An error occurred while fetching collection items. Please try again.');
            }
        }

        fetchCollections();
    </script>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
