<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Collections</title>
    <link rel="stylesheet" href="../css/pagesstyles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include '../includes/header.php'; ?>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            back
            background-color: rgba(178, 91, 78, 0.89);
        }
        .bg-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -2; /*keep video behind other content*/
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.55);
            z-index: -1;
        }


        #collections-container {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--header-font);
            overflow: hidden;
            z-index: 1;
        }

        #collections-container h1 {
            font-size: 7rem;
            font-family: "Cinzel", serif;
            font-weight: 400;
            text-transform: uppercase;
            margin-top: 10%;
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
            margin: 20px auto;
            background: linear-gradient(135deg, #6D152B, #8B213F);
            color: white;
            padding: 25px;
            border: none;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #new-collection-btn:hover {
            background: linear-gradient(135deg, #8B213F, #6D152B); /*reverse gradient when hover*/
            transform: translateY(-3px);/
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        #new-collection-btn:active {
            transform: translateY(1px);
            box-shadow: 0 3px 7px rgba(0, 0, 0, 0.2);
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
            color: #333;
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
            flex-wrap: wrap; /*allows wrapping on smaller screens*/
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .collection-card {
            background: var(--header-font);
            border-radius: 25px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: 0;
            width: 250px;
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
            padding: 12px;
            margin: 8px 0 15px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 65%;
        }

        .collection-card button:hover {
            background: linear-gradient(135deg, #8B213F, #6D152B);
            transform: scale(1.05);
        }

        /*Animation*/
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
    <video autoplay muted loop class="bg-video">
        <source src="../images/collectionsbackg.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="bg-overlay"></div>
    <div id="collections-container">
        <h1 class="display-3 fw-bold text-uppercase">My Collections</h1>
        <p class="lead mt-3">Save your favorite cultural pieces to revisit and be inspired by them anytime.</p>
        <button id="new-collection-btn">+ Add New Collection</button>
        <div id="collections-list">
            <!--Dynamic collctioncontent is be inserted here-->
        </div>
    </div>

    <!-- Add New Collection Dialog Pop-up -->
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
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById("new-collection-modal");
            const container = document.getElementById("collections-list");
            const form = document.getElementById("new-collection-form");
            const newCollectionBtn = document.getElementById("new-collection-btn");
            const closeModalBtn = document.querySelector("#new-collection-modal button:last-of-type");
        
            if (!modal || !container || !form || !newCollectionBtn || !closeModalBtn) {
                console.error("One or more required elements are missing from the DOM.");
                return;
            }
        
            //OPEN MODAL
            newCollectionBtn.addEventListener("click", () => {
                modal.style.display = "block";
            });
        
            //CLOSE MODAL
            function closeModal() {
                modal.style.display = "none";
            }
            closeModalBtn.addEventListener("click", closeModal);
        
            //CREATE COLLECTION
            form.addEventListener("submit", async (e) => {
                e.preventDefault();
        
                const name = document.querySelector('[name="name"]').value.trim();
                const description = document.querySelector('[name="description"]').value.trim();
        
                if (!name) {
                    Swal.fire({ icon: "warning", title: "Missing Name", text: "Please enter a name for your collection." });
                    return;
                }
        
                try {
                    const response = await fetch("../api/collections.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ name, description }),
                        credentials: "include",
                    });
        
                    const result = await response.json();
        
                    if (response.ok) {
                        Swal.fire({
                            icon: "success",
                            title: "Collection Created",
                            text: result.message,
                            timer: 1500,
                            showConfirmButton: false,
                        }).then(() => {
                            closeModal();
                            form.reset();
                            fetchCollections(); //Refresh collections
                        });
                    } else {
                        Swal.fire({ icon: "error", title: "Error", text: result.error });
                    }
                } catch (error) {
                    console.error("Error creating collection:", error);
                    Swal.fire({ icon: "error", title: "Error", text: "Something went wrong. Please try again." });
                }
            });
        
        //FETCH COLLECTIONS
        async function fetchCollections() {
        try {
            const response = await fetch("../api/collections.php", { method: "GET", credentials: "include" });
            if (!response.ok) throw new Error("Failed to fetch collections");

            const collections = await response.json();
            const container = document.getElementById("collections-list");

            container.innerHTML = ""; //Clear existing collections

            if (collections.length === 0) {
                container.innerHTML = '<p class="text-white">No collections available. Create your first collection!</p>';
                return;
            }

            collections.forEach((collection) => {
                const card = document.createElement("div");
                card.classList.add("collection-card");
                card.id = `collection-${collection.id}`;
                card.innerHTML = `
                    <h3>${collection.name}</h3>
                    <p>${collection.description || "No description provided."}</p>
                    <button class="view-button" data-id="${collection.id}">View</button>
                    <button class="delete-button" data-id="${collection.id}">Delete</button>
                `;
                container.appendChild(card);
            });

            attachEventListeners(); //ensure buttons work after rendering
        } catch (error) {
            console.error("Error fetching collections:", error);
        }
    }

        
        //DELETE COLLECTION
        async function deleteCollection(collectionId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`../api/collections.php?id=${collectionId}`, {
                            method: "DELETE",
                            credentials: "include",
                        });
    
                        if (response.ok) {
                            Swal.fire("Deleted!", "Your collection has been deleted.", "success");
                            document.getElementById(`collection-${collectionId}`).remove();
                        } else {
                            Swal.fire("Error!", "Failed to delete collection.", "error");
                        }
                    } catch (error) {
                        console.error("Error deleting collection:", error);
                        Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                    }
                }
            });
        }
    
        //ATTACH EVENT LISTENERS FOR BUTTONS
        function attachEventListeners() {
            document.querySelectorAll(".view-button").forEach((button) => {
                button.addEventListener("click", function () {
                    const collectionId = this.getAttribute("data-id");
                    viewCollection(collectionId);
                });
            });
    
            document.querySelectorAll(".delete-button").forEach((button) => {
                button.addEventListener("click", function () {
                    const collectionId = this.getAttribute("data-id");
                    deleteCollection(collectionId);
                });
            });
        }
    
        //VIEW COLLECTION
        function viewCollection(id) {
            window.location.href = `collection_items.php?collection_id=${id}`;
        }
    
        //Initial fetch on page load
        fetchCollections();
    });
    </script> 

    <?php include '../includes/footer.php'; ?>
</body>
</html>
