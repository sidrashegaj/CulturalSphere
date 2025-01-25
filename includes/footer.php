<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Example</title>
    <style>
        /* Footer Styles */
        

        .footer {
            background-color: #000; /* Black background */
            padding: 40px 20px; /* Add space around the footer */
            text-align: center; /* Center align content */
            font-size: 1.2rem;
            font-family: 'Franklin Gothic Book', serif; 
            color: #ffffff;
            text-transform: uppercase;
        }

        .navbar-brand{
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .footer span {
            color: #6D152B;
        }

        .footer-container {
            max-width: 1200px; /* Center the content */
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr; /* Three columns */
            gap: 30px;
        }

        .footer-branding {
            grid-column: span 3; /* Span full width on small screens */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .footer-branding h1 {
            font-size: 2rem;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .footer-branding .social-icons {
            display: flex;
            gap: 10px;
        }

        .footer-branding .social-icons a img {
            width: 30px;
            height: 30px;
        }

        /* Features Section */
        .footer-features {
            text-align: left;
            font-size: 0.9rem;
        }

        .footer-features p {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .footer-features p span {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        /* Links Section */
        .footer-links {
            display: flex;
            justify-content: space-between;
        }

        .footer-links a {
            display: block;
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Payment Methods */
        .footer-payments {
            grid-column: span 3; /* Full width */
            margin: 20px 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .footer-payments img {
            width: 50px;
            height: auto;
        }

        /* Disclaimer Section */
        .footer-disclaimer {
            grid-column: span 3; /* Full width */
            font-size: 0.8rem;
            color: #ccc;
            margin-top: 20px;
            line-height: 1.5;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr; /* Single column layout */
                text-align: center;
            }

            .footer-links {
                flex-direction: column;
                align-items: center;
            }

            .footer-payments {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
        <!--FOOTER-->
    <footer class="footer">
        <div class="footer-container">
            <!-- Branding and Social Media -->
            <div class="footer-branding">
                <a class="navbar-brand fw-bold text-light" href="index.php">CULTURAL <span>SPHERE</span></a>
                <div class="social-icons">
                    <a href="#"><img src="icons/instagram.svg" alt="Instagram"></a>
                    <a href="#"><img src="icons/linkedin.svg" alt="LinkedIn"></a>
                    <a href="#"><img src="icons/facebook.svg" alt="Facebook"></a>
                    <a href="#"><img src="icons/youtube.svg" alt="YouTube"></a>
                </div>
            </div>

            <!-- Features Section -->
            <div class="footer-features">
                <p><span>🌟</span> Designing with love by lighting experts in Austria, Europe</p>
                <p><span>💶</span> 100-day money-back guarantee</p>
                <p><span>🌍</span> Global express shipping</p>
            </div>

            <!-- Links Section -->
            <div class="footer-links">
                <div>
                    <a href="#">Technology</a>
                    <a href="#">Company</a>
                    <a href="#">Shop</a>
                    <a href="#">Commercial</a>
                </div>
                <div>
                    <a href="#">Shipping & Delivery</a>
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Contact</a>
                </div>
            </div>
        </div>
    </footer>
</body>

