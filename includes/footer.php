<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Sphere Footer</title>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Footer Styles */
        .footer {
            background-color: black;
            color: #fff;
            padding: 40px 0 20px 0; /* Reduced padding */
            font-size: 0.9rem; /* Reduced font size */
            font-family: 'Franklin Gothic Book', serif;
            z-index: 3; /* Place it above the overlay and other content */
        }

        .footer h6{
            text-transform: uppercase;
        }

        .footer-brand {
            font-size: 1.8rem; /* Smaller brand font */
            font-weight: bold;
            margin-bottom: 10px;
            color: #ffffff;
        }

        .footer-brand span {
            color: #a63953; /* Accent color */
        }

        .social-icons a {
            color: #ffffff;
            margin: 0 8px;
            font-size: 1.2rem; /* Smaller icon size */
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #a63953;
        }

        .footer-links a {
            color: #cccccc;
            text-decoration: none;
            margin-bottom: 6px; /* Reduced spacing */
            display: block;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: #ffffff;
        }

        .footer-features span {
            font-size: 1rem;
            margin-right: 8px; /* Reduced spacing */
            color: #a63953;
        }

        .footer-disclaimer {
            font-size: 0.8rem; /* Reduced font size */
            color: #b3b3b3;
            text-align: center;
            margin-top: 25px; /* Reduced margin */
        }

        .footer .row {
            display: flex;
            justify-content: space-between; /* Distribute columns evenly */
            gap: 80px; /* Add space between columns */
            align-items: flex-start;
        }

        .footer .col-md-4 {
            flex: 1; /* Make columns take equal space */
            margin: 20px; /* Reset default margin */
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .footer-links {
                text-align: center;
            }

            .social-icons {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- Branding and Social Media -->
                <div class="col-md-4 mb-3">
                    <div class="footer-brand">
                        CULTURAL <span>SPHERE</span>
                    </div>
                    <p>Exploring the intersections of culture, books, films, and arts.</p>
                    <div class="d-flex justify-content-center justify-content-md-start social-icons">
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="col-md-4 mb-3">
                    <h6>Why Choose Us?</h6>
                    <div class="footer-features">
                        <p><span>🌍</span>Connecting cultures through shared experiences</p>
                        <p><span>📚</span>Curated collections of books and films</p>
                        <p><span>🎭</span>Discover art and culture from around the world</p>
                    </div>
                </div>

                <!-- Links Section -->
                <div class="col-md-4">
                    <h6>Quick Links</h6>
                    <div class="footer-links">
                        <a href="#">About Us</a>
                        <a href="#">Explore Collections</a>
                        <a href="#">Contact</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms & Conditions</a>
                    </div>
                </div>
            </div>

            <!-- Disclaimer Section -->
            <div class="footer-disclaimer">
                © 2025 Cultural Sphere. All rights reserved. Crafted with passion for culture and art.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
