<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Collections</title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include '../includes/header.php'; ?>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: rgba(178, 91, 78, 0.89);
        }

        #collections-container {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--header-font);
            overflow: hidden; /* Prevents video overflow */
        }

        #collections-container h1 {
            font-size: 7rem;
            font-family: "Cinzel", serif;
            font-weight: 400;
            text-transform: uppercase;
            position: relative;
            animation: slow-fade-loop 10s linear infinite;
            color: var(--header-font);
        }

        #collections-container p {
            font-size: 1.5rem;
            font-family: 'Georgia', serif;
            font-style: italic;
            color: var(--header-font);
        }


        #new-collection-btn {
            display: inline-block;
            margin: 20px auto; /* Center the button horizontally */
            background: linear-gradient(135deg, #6D152B, #8B213F); /* Gradient for depth */
            color: white;
            padding: 25px; /* Spacious padding */
            border: none;
            border-radius: 50px; /* Rounded corners */
            font-size: 1.2rem; /* Larger font size */
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px; /* Slight letter spacing for better readability */
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Soft shadow for elevation */
        }

        #new-collection-btn:hover {
            background: linear-gradient(135deg, #8B213F, #6D152B); /* Reverse gradient on hover */
            transform: translateY(-3px); /* Slight lift effect */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); /* Enhanced shadow */
        }

        #new-collection-btn:active {
            transform: translateY(1px); /* Button press effect */
            box-shadow: 0 3px 7px rgba(0, 0, 0, 0.2); /* Reduced shadow */
        }


        #new-collection-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: var(--header-font);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            font-family: 'Arial', sans-serif;
            width: 400px;
            color: #333; /* Neutral text color for contrast */
        }

        #new-collection-modal h2 {
            font-size: 1.8rem;
            color: #6D152B;
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #8B213F;
            padding-bottom: 10px;
        }

        #new-collection-modal input,
        #new-collection-modal textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            background: var(--header-font);
            color: #333;
            font-size: 1rem;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        #new-collection-modal textarea {
            resize: none;
            height: 80px;
        }

        #new-collection-modal button {
            background: linear-gradient(135deg, #6D152B, #8B213F);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: all 0.3s ease-in-out;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        #new-collection-modal button:hover {
            background: linear-gradient(135deg, #8B213F, #6D152B);
            transform: scale(1.02);
        }

        #new-collection-modal form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        #new-collection-modal button:last-of-type {
            background: transparent;
            color: #6D152B;
            border: 2px solid #6D152B;
            margin-top: 10px;
        }

        #new-collection-modal button:last-of-type:hover {
            background: #6D152B;
            color: white;
        }



        #new-collection-btn {
            display: block;
            margin: 20px auto;
            background-color: #8b0000;
            color: white;
            padding: 20px 30px;
            border: none;
            border-radius: 30px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
        }

        #new-collection-btn:hover {
            background-color: #660000;
        }

        #collections-list {
            display: flex;
            flex-wrap: wrap; /* Allows wrapping on smaller screens */
            justify-content: center; /* Centers the cards horizontally */
            gap: 20px; /* Adds space between cards */
            padding: 20px; /* Adds some padding around the cards */
        }

        .collection-card {
            background: var(--header-font);
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: 0; /* Removed margin, gap is handling spacing */
            width: 250px; /* Fixed width for consistency */
            text-align: center;
        }

        .collection-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .collection-card h3 {
            font-size: 1.6em;
            color: #6D152B;
            margin: 20px 15px 10px;
            font-weight: bold;
        }

        .collection-card p {
            margin: 0 15px 20px;
            color: black !important;
            font-size: 1rem !important;
            font-style: italic;
        }

        .collection-card button {
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
            width: 80%;
        }

        .collection-card button:hover {
            background: linear-gradient(135deg, #8B213F, #6D152B);
            transform: scale(1.05);
        }



        /* Animation */
        @keyframes slow-fade-loop {
            0% {
                transform: translateX(0);
                opacity: 1;}
            45% {
                transform: translateX(50vw);
                opacity: 1;}
            50% {
                transform: translateX(100vw);
                opacity: 0;}
            55% {
                transform: translateX(-100vw);
                opacity: 0;}
            60% {
                transform: translateX(-50vw);
                opacity: 1;
            }
            100% {
                transform: translateX(0);
                opacity: 1;}
        }


    </style>
</head>
<body>
    <div id="collections-container">
        <h1 class="display-3 fw-bold text-uppercase">My Collections</h1>
        <p class="lead mt-3">Save your favorite cultural pieces to revisit and be inspired by them anytime.</p>
        <button id="new-collection-btn">+ Add New Collection</button>
        <div id="collections-list">
            <!-- Dynamic collection content will be inserted here -->
        </div>
    </div>

    <!-- Add New Collection Modal -->
    <div id="new-collection-modal">
        <h2>Add New Collection</h2>
        <form id="new-collection-form">
            <input type="text" name="name" placeholder="Collection Name" required>
            <textarea name="description" placeholder="Collection Description"></textarea>
            <button type="submit">Create Collection</button>
            <button type="button" onclick="closeModal()">Close</button>
        </form>
    </div>


    <script>
        const modal = document.getElementById('new-collection-modal');
        const container = document.getElementById('collections-list');

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

                container.innerHTML = collections.length
                    ? collections
                        .map(
                            (collection) => `
                        <div class="collection-card" id="collection-${collection.id}">
                            <h3>${collection.name}</h3>
                            <p>${collection.description || 'No description provided.'}</p>
                            <button onclick="viewCollection(${collection.id})">View Collection</button>
                            <button onclick="deleteCollection(${collection.id})" class="delete-button">Delete Collection</button>
                        </div>
                    `
                        )
                        .join('')
                    : '<p class="text-white">No collections available. Create your first collection!</p>';
            } catch (error) {
                console.error('Error fetching collections:', error);
            }
        }

        function viewCollection(id) {
            window.location.href = `collection_items.php?collection_id=${id}`;
        }

        // Initial fetch
        fetchCollections();

        async function deleteCollection(collectionId) {
            const confirmDelete = confirm(
                'Are you sure you want to delete this collection? This action cannot be undone.'
            );
            if (!confirmDelete) return;

            try {
                const response = await fetch(`../api/collections.php?id=${collectionId}`, {
                    method: 'DELETE',
                    credentials: 'include',
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    alert(errorData.error || 'Failed to delete collection');
                    return;
                }

                alert('Collection deleted successfully.');

                // Remove the deleted collection card from the page
                const collectionCard = document.getElementById(`collection-${collectionId}`);
                if (collectionCard) collectionCard.remove();
            } catch (error) {
                alert('Error deleting collection.');
                console.error(error);
            }
        }

    </script>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
