<?php 
include '../db.php'; // Include your database connection file
session_start();

// Fetch logged-in user ID or set to null if not logged in
$userId = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null; // Add this line

// Fetch art details based on ID
if (isset($_GET['id'])) {
    $artId = intval($_GET['id']);
    try {
        $query = "SELECT name, description, location, created_at, creator, image_path, likes FROM art WHERE id = :id"; // Include image_path
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $artId, PDO::PARAM_INT);
        $stmt->execute();
        $art = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$art) {
            die("Art not found.");
        }

        // Check if the user has liked the art
        $liked = false;
        if ($userId) {
            $likeQuery = "SELECT 1 FROM art_likes WHERE user_id = :user_id AND art_id = :art_id";
            $likeStmt = $conn->prepare($likeQuery);
            $likeStmt->execute(['user_id' => $userId, 'art_id' => $artId]);
            $liked = $likeStmt->rowCount() > 0;
        }
    } catch (PDOException $e) {
        die("Error fetching art details: " . $e->getMessage());
    }
} else {
    die("Invalid art ID.");
}

try {
    // Fetch comments for the current art
    $commentsQuery = "SELECT c.comment, c.created_at, u.username 
                      FROM art_comments c
                      JOIN users u ON c.user_id = u.id
                      WHERE c.art_id = :art_id
                      ORDER BY c.created_at DESC";
    $commentsStmt = $conn->prepare($commentsQuery);
    $commentsStmt->bindParam(':art_id', $artId, PDO::PARAM_INT);
    $commentsStmt->execute();
    $comments = $commentsStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching comments: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($art['name']); ?></title>
    <!-- Include Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            top: 70%; /* Adjust spacing from the top */
            right: 6%; /* Push the button outside the right of the card */
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
        .like-container {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .like-icon {
            font-size: 30px;
            color: gray; /* Default unfilled heart */
            transition: color 0.3s ease;
        }

        .like-icon.liked {
            color: red; /* Filled heart for liked state */
        }

        #like-count {
            font-size: 18px;
            color: white;
        }

        #comments-section {
            margin-top: 30px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        #comments-section h2 {
            margin-bottom: 20px;
            color: #440e1b;
        }

        .comment {
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .comment strong {
            display: block;
            color: #440e1b;
        }

        .comment p {
            margin: 5px 0;
        }

        .comment small {
            font-size: 0.9rem;
            color: #888;
        }

        #new-comment {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #submit-comment {
            padding: 10px 15px;
            background: #440e1b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #submit-comment:hover {
            background: #660000;
        }
        .comment-icon-container {
            margin-top: 7px;
            cursor: pointer;
        }
        .comment-icon-container i {
            font-size: 24px;
            color: gray;
            transition: color 0.3s ease;
        }
        .comment-icon-container i:hover {
            color: #440e1b;
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

        <div class="like-container">
            <i id="like-icon" class="like-icon <?php echo $liked ? 'liked' : ''; ?>" onclick="handleLike()">&hearts;</i>
            <span id="like-count"><?php echo $art['likes']; ?></span>
        </div>

        <!-- Comment Toggle Icon -->
        <div class="comment-icon-container" onclick="toggleComments()">
            <a href="#comments-section"><i id="toggle-comments" class="fa fa-comment"></i></a>
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

    <!-- Comments Section -->
    <div id="comments-section">
        <h2>Comments</h2>
        <!-- Display Comments -->
        <div id="comments-container">
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <strong><?php echo htmlspecialchars($comment['username']); ?></strong>
                    <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                    <small><?php echo htmlspecialchars($comment['created_at']); ?></small>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Add Comment Form -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <textarea id="new-comment" rows="3" placeholder="Write your comment here..."></textarea>
            <button id="submit-comment" class="btn btn-success" onclick="postComment()">Post Comment</button>
        <?php else: ?>
            <p>You need to <a href="../login.php">log in</a> to leave a comment.</p>
        <?php endif; ?>
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
        async function addToCollection() {
    const collectionId = document.getElementById('dropdownMenuButton').getAttribute('data-id');
    const artId = <?php echo $artId; ?>;

    if (!collectionId) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select a collection.',
        });
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

        if (result.error) {
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: result.error,
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: result.message || 'Artwork successfully added to the collection.',
            });
        }
    } catch (error) {
        console.error('Error adding to collection:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Something went wrong. Please try again.',
        });
    }
}

        // Fetch collections on page load
        fetchCollections();

        async function handleLike() {
            const artId = <?php echo $artId; ?>;

            try {
                const response = await fetch('../api/like_art.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ art_id: artId }),
                    credentials: 'include'
                });

                const result = await response.json();

                if (result.error) {
                    alert(result.error); // Show error if user is not logged in
                } else {
                    const likeIcon = document.getElementById('like-icon');
                    const likeCount = document.getElementById('like-count');

                    likeCount.textContent = result.likes; // Update like count
                    likeIcon.classList.toggle('liked', result.liked); // Toggle 'liked' class
                }
            } catch (error) {
                console.error('Error liking the art:', error);
            }
        }

        async function postComment() {
            const artId = <?php echo $artId; ?>;
            const comment = document.getElementById('new-comment').value.trim();

            if (!comment) {
                alert('Comment cannot be empty.');
                return;
            }

            try {
                const response = await fetch('../api/post_art_comment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ art_id: artId, comment }),
                    credentials: 'include'
                });

                const result = await response.json();

                if (result.error) {
                    alert(result.error);
                } else {
                    // Add the new comment to the comments container
                    const commentsContainer = document.getElementById('comments-container');
                    const newCommentHtml = `
                        <div class="comment">
                            <strong><?php echo $_SESSION['username']; ?></strong>
                            <p>${comment}</p>
                            <small>Just now</small>
                        </div>
                    `;
                    commentsContainer.innerHTML = newCommentHtml + commentsContainer.innerHTML;

                    // Clear the comment input
                    document.getElementById('new-comment').value = '';
                }
            } catch (error) {
                console.error('Error posting comment:', error);
            }
        }

        function toggleComments() {
            const commentsSection = document.getElementById('comments-section');
            if (commentsSection.style.display === 'none' || !commentsSection.style.display) {
                commentsSection.style.display = 'block';
            } else {
                commentsSection.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('comments-section').style.display = 'none';
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
