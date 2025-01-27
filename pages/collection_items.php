<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Items</title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: var(--header-font);
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            color: #333;
        }

        .back-button {
            display: block;
            align-items: center;
            margin: 20px auto;
            background-color: #8b0000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #660000;
        }

        #items-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .grid-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .grid-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .grid-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .grid-item p {
            margin: 10px 0;
            font-size: 1rem;
            color: #555;
        }

    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Collection Items</h1>
    <button class="back-button" onclick="window.location.href='collections.php'">Back to Collections</button>

    <div id="items-container"></div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const collectionId = urlParams.get('collection_id');

        async function fetchCollectionItems() {
            try {
                const response = await fetch(`../api/collections.php?id=${collectionId}`, {
                    method: 'GET',
                    credentials: 'include',
                });

                if (!response.ok) throw new Error('Failed to fetch collection items');

                const items = await response.json();
                const container = document.getElementById('items-container');

                if (items.length > 0) {
                    container.innerHTML = items.map(item => {
                        let title, imagePath;

                        if (item.item_type === 'film') {
                            title = `🎥 Film: ${item.film_title}`;
                            imagePath = `../images/films/${encodeURIComponent(item.film_title)}.jpg`;
                        } else if (item.item_type === 'book') {
                            title = `📖 Book: ${item.book_title}`;
                            imagePath = item.book_cover_image 
                                ? `../${item.book_cover_image}` 
                                : '../images/default-book.jpg';
                        } else if (item.item_type === 'art') {
                            title = `🖼️ Art: ${item.art_name}`;
                            imagePath = `../${item.art_image_path}`;
                        }

                        return `
                            <div class="grid-item">
                                <img src="${imagePath}" alt="${title}" onerror="this.onerror=null; this.src='../images/default-image.jpg';">
                                <p>${title}</p>
                            </div>
                        `;
                    }).join('');
                } else {
                    container.innerHTML = '<p style="text-align: center; font-size: 1.2rem; color: #666;">No items found in this collection.</p>';
                }
            } catch (error) {
                alert('Error fetching collection items');
                console.error(error);
            }
        }

        fetchCollectionItems();
    </script>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
