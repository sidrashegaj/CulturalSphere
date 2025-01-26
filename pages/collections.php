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
            background-color: rgba(178, 91, 78, 0.89);
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #fff;
        }

        #collections-container {
            max-width: 1200px;
            margin: 20px auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .collection-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .collection-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .collection-card h3 {
            margin: 15px;
            font-size: 1.4em;
            color: #333;
        }

        .collection-card p {
            margin: 0 15px 20px;
            color: #666;
            font-size: 1em;
        }

        .collection-card button {
            display: block;
            width: calc(100% - 30px);
            margin: 0 auto 20px;
            padding: 10px 15px;
            background-color: #8b0000;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .collection-card button:hover {
            background-color: #660000;
        }

        #new-collection-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        #new-collection-modal input,
        #new-collection-modal textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        #new-collection-modal button {
            background-color: #8b0000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        #new-collection-modal button:hover {
            background-color: #660000;
        }

        #new-collection-btn {
            display: block;
            margin: 20px auto;
            background-color: #8b0000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
        }

        #new-collection-btn:hover {
            background-color: #660000;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>My Collections</h1>
    <button id="new-collection-btn">+ Add New Collection</button>
    <div id="collections-container"></div>

    <!-- Add New Collection Modal -->
    <div id="new-collection-modal">
        <h2>Add New Collection</h2>
        <form id="new-collection-form">
            <input type="text" name="name" placeholder="Collection Name" required>
            <textarea name="description" placeholder="Collection Description"></textarea>
            <button type="submit">Create Collection</button>
        </form>
        <button onclick="closeModal()">Close</button>
    </div>

    <script>
        const modal = document.getElementById('new-collection-modal');
        document.getElementById('new-collection-btn').addEventListener('click', () => {
            modal.style.display = 'block';
        });

        function closeModal() {
            modal.style.display = 'none';
        }

        document.getElementById('new-collection-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);

            try {
                const response = await fetch('../api/collections.php', {
                    method: 'POST',
                    body: formData,
                    credentials: 'include',
                });

                if (!response.ok) throw new Error('Failed to create collection');

                alert('Collection created successfully');
                closeModal();
                fetchCollections();
            } catch (error) {
                alert('Error creating collection');
                console.error(error);
            }
        });

        async function fetchCollections() {
            try {
                const response = await fetch('../api/collections.php', { method: 'GET', credentials: 'include' });
                if (!response.ok) throw new Error('Failed to fetch collections');

                const collections = await response.json();
                const container = document.getElementById('collections-container');
                container.innerHTML = collections.map(collection => `
                    <div class="collection-card">
                        <h3>${collection.name}</h3>
                        <p>${collection.description || "No description provided."}</p>
                        <button onclick="viewCollection(${collection.id})">View Collection</button>
                    </div>
                `).join('');
            } catch (error) {
                alert('Error fetching collections');
                console.error(error);
            }
        }

        function viewCollection(id) {
            window.location.href = `collection_items.php?collection_id=${id}`;
        }

        fetchCollections();
    </script>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
