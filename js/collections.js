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