<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Items</title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow-x: hidden; /* Only prevent horizontal scrolling */
        }

        .bg-video {
            position: fixed; /* Keep the video fixed to the viewport */
            top: 0;
            left: 0;
            width: 100vw; /* Full width of the viewport */
            height: 100vh; /* Full height of the viewport */
            object-fit: cover; /* Ensures the video scales properly without distortion */
            z-index: -2; /* Keep it behind all other content */
        }

        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.55); /* Transparent black overlay */
            z-index: -1; /* Between video and content */
        }

        .head{
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden; /* Prevents video overflow */
            z-index: 1; /* Place the content above the overlay */
        }

        .head h1 {
            font-size: 4rem;
            font-family: "Cinzel", serif;
            font-weight: 400;
            text-transform: uppercase;
            margin-top: 5%;
            position: relative;
            color: var(--header-font);
        }

        .back-button {
            background: linear-gradient(135deg, #6D152B, #8B213F);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            margin: 10px 0 20px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 15%;
        }

        .back-button:hover {
            background: linear-gradient(135deg, #8B213F, #6D152B);
            transform: scale(1.05);
        }

        #items-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            z-index: 1;
        }

        .grid-item {
            background: var(--header-font);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            text-align: center;
            z-index: 1;
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
            color: black;
        }

    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <video autoplay muted loop class="bg-video">
        <source src="../images/collectionsbackg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="bg-overlay"></div>

    <div class="head">
        <h1 class="display-3 fw-bold text-uppercase">Items in This Collections</h1>
        <button class="back-button" onclick="window.location.href='collections.php'">Back to Collections</button>
    </div>
    
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
