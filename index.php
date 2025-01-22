<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Sphere - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script
    type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
  </script>
  
</head>
<body>
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-black py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-light" href="index.html">CULTURAL <span> SPHERE</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-warning" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="about.html">About</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="contact.html">Contact</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="services.html">Services</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="testimonials.html">Testimonials</a></li>
                    <!-- Dynamic Login/Register or Profile Section -->
                    <li class="nav-item" id="auth-section">
                        <!-- Login/Register Buttons (Default) -->
                        <div id="guest-buttons" class="d-flex">
                            <a class="btn btn-outline me-2" href="pages/login.php">Login</a>
                            <a class="btn btn-outline" href="pages/register.php">Register</a>
                        </div>
                        <!-- Profile Icon (Hidden by Default) -->
                        <div id="user-profile" class="d-none">
                            <a href="profile.html" class="nav-link">
                                <img src="profile-icon.png" alt="Profile" class="rounded-circle" width="30" height="30">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Hero Section -->
    <header class="hero-section">
        <video autoplay muted loop class="bg-video">
            <source src="images/backgmain.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="content">
            <h1 class="display-3 fw-bold text-uppercase">Cultural Sphere</h1>
            <p class="lead mt-3">The beauty of the world lies in the diversity of its people and stories.</p>
            <button class="btn text-dark mt-4 px-4 py-2" onclick="window.location.href='contact.html';">Discover</button>
        </div>
    </header>
    
    

    <section id="info">
        <div class="info-box">
            <i class="bi bi-geo-alt"></i>
            <h5>Address</h5>
            <p>6724 13th Ave, Brooklyn, <br> NY 11219</p>
        </div>
        <div class="info-box">
            <i class="bi bi-telephone"></i>
            <h5>Phone</h5>
            <p>+1-646-656-2002</p>
        </div>
        <div class="info-box">
            <i class="bi bi-envelope"></i>
            <h5>Email</h5>
            <p>info@titaniumelectrical.us</p>
        </div>
        <div class="info-box">
            <i class="bi bi-hand-thumbs-up"></i>
            <h5>Connect</h5>
            <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </section>
    
    <!-- Learn About Our Business Section -->
<section id="about-business" class="py-5 text-white" style="background-color: #000;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Text Content -->
            <div class="col-md-6">
                <h2 >Learn About Our Business</h2>
                <p class="mt-4">
                    As licensed contractors, we provide our clients with a comprehensive approach to all of their projects, 
                    specializing in a wide range of services. Since we founded our business in 2018, we’ve been committed to 
                    our clients’ needs and satisfaction.
                </p>
                <p>
                    Do you have a project or idea in mind that you want to get started on? We are here to make it happen. 
                    Get in touch to learn what we can do for you today.
                </p>
            </div>

            <!-- Image -->
            <div class="col-md-6 text-center">
                <img src="images/about.png" alt="Electrical Box" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>
<section id="testimonials" class="py-5 text-center" style="background-color: #61714D;">
    <div class="container">
        <h2 class="fw-bold text-dark">WHAT PEOPLE SAY</h2>
        <div class="row mt-5">
            <!-- Testimonial 1 -->
            <div class="col-md-4">
                <div class="card shadow-lg text-white" style="background-image: url('images/pp1.jpg'); background-size: cover; background-position: center;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.6);">
                        <h5 class="fw-bold text-uppercase mb-3">M. M.</h5>
                        <p class="fst-italic">Bay Ridge, Brooklyn, NY</p>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0">A+ company! With Klodian, it's Safety first! These Gentlemen were Kind, Patient, and they know what they’re doing! Klodian educated me on what does what, etc. The experience was lovely and I will be their customer for life! I recommend them to all!</p>
                        </blockquote>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="col-md-4">
                <div class="card shadow-lg text-white" style="background-image: url('images/ppl3.jpg'); background-size: cover; background-position: center;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.6);">
                        <h5 class="fw-bold text-uppercase mb-3">Sal. M.</h5>
                        <p class="fst-italic">Naples, FL</p>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0">Titanium is the best. They rehabilitated a tired dark basement to a playroom that families can enjoy. From the start of the project to its completion, they were on board. They suggested improvements and did additional work without charging us more. I would recommend their team to friends and neighbors.</p>
                        </blockquote>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="col-md-4">
                <div class="card shadow-lg text-white" style="background-image: url('images/ppl2.jpg'); background-size: cover; background-position: center;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center" style="background-color: rgba(0, 0, 0, 0.6);">
                        <h5 class="fw-bold text-uppercase mb-3">Ray. K.</h5>
                        <p class="fst-italic">New York, NY</p>
                        <blockquote class="blockquote text-center">
                            <p class="mb-0">I found Titanium after reading their positive reviews, and I was not disappointed. They are extremely professional, courteous, and responsive. I highly recommend anyone with an electrical issue to call them.</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Services Section -->
<section id="services" class="py-5" style="background-color: #000000;">
    <div class="container">
        <!-- Commercial Services -->
        <div class="row mb-5 position-relative">
            <div class="col-md-7">
                <div class="image-overlay-wrapper">
                    <img src="images/comercial.png" alt="Commercial Services" class="img-fluid">
                    <div class="card-overlay">
                        <h3 class="fw-bold service-title"  >
                            Commercial Services
                        </h3>
                        <p class="mt-3">Tailored solutions for businesses, offering reliable and efficient electrical services for all your needs.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Residential Services -->
        <div class="row mb-5 position-relative">
            <div class="col-md-7 ">
                <div class="image-overlay-wrapper">
                <img src="images/resident.png" alt="Residential Services" class="img-fluid rounded shadow">
                <div class="card-overlay">
                    <h3 class="fw-bold service-title " >
                        Residential Services
                    </h3>
                    <p class="mt-3">We provide comprehensive electrical services for your home, ensuring safety, functionality, and peace of mind.</p>
                </div>
            </div>
        </div>
    </div>


        <!-- Repairment Services -->
        <div class="row mb-5 position-relative" ">
            <div class="col-md-7">
                <div class="image-overlay-wrapper">
                <img src="images/repairment.png" alt="Repairment Services" class="img-fluid rounded shadow">
                <div class="card-overlay">
                    <h3 class="fw-bold service-title" >
                        Repairment Services
                    </h3>
                    <p class="mt-3">Our skilled technicians handle electrical repairs swiftly and effectively to minimize disruptions.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        <a href="contact.html" class="btn btn-custom mt-4 px-4 py-2">Contact Us</a>
    </div>
    
</section>


<!-- All Services Section -->
<section id="all-services" class="py-5 text-center" style="background-color: #f9f9f9;">
    <div class="container">
        <h2 class="fw-bold mb-4" style="font-size: 2.5rem; color: #333;">All Services</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card">
                    <!-- Updated icon -->
                    <i class="bi bi-house fs-1 text-success"></i>
                    <h5 class="mt-3 fw-light" style="font-family: 'Georgia', serif; font-size: 1.1rem;">
                        New Home Construction, Remodeling and Basement Wiring
                    </h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="bi bi-lightning-charge-fill fs-1 text-warning"></i>
                    <h5 class="mt-3 fw-light" style="font-family: 'Georgia', serif; font-size: 1.1rem;">
                        Electrical Troubleshooting & Repair
                    </h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="bi bi-tools fs-1 text-danger"></i>
                    <h5 class="mt-3 fw-light" style="font-family: 'Georgia', serif; font-size: 1.1rem;">
                        Breaker Panel Installation, Repair and Upgrades
                    </h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="bi bi-plug fs-1 text-primary"></i>
                    <h5 class="mt-3 fw-light" style="font-family: 'Georgia', serif; font-size: 1.1rem;">
                        Electrical Panel Upgrades
                    </h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <i class="bi bi-plug-fill fs-1 text-info"></i>
                    <h5 class="mt-3 fw-light" style="font-family: 'Georgia', serif; font-size: 1.1rem;">
                        Electrical Wiring Installation
                    </h5>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <!-- Updated icon -->
                    <i class="bi bi-person-lines-fill fs-1 text-warning"></i>
                    <h5 class="mt-3 fw-light" style="font-family: 'Georgia', serif; font-size: 1.1rem;">
                        Emergency Electrician NYC
                    </h5>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Expert Understanding Section -->
<section id="expert-understanding" class="py-5 text-white" style="background-color: #000;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Image -->
            <div class="col-md-6">
                <img src="images/expert.png" alt="Expert Understanding" class="img-fluid ">
            </div>
            <!-- Text -->
            <div class="col-md-6">
                <h2 >Expert Understanding of the Electrical World</h2>
                <h3>Truly Top-Notch</h3>
                <p class="mt-4">
                    We know the electrical world like no other. At Titanium Electrical, we pride ourselves on knowing all the ins and outs of the electrical industry. 
                    We stay ahead of trends and changes, so we can serve you better.
                </p>
                <p>
                    Our expertise isn’t just a fancy feature - it’s what helps us provide smart and innovative solutions that fit your needs. 
                    Trust us to light up your projects with knowledge that goes beyond expectations, making sure your work is not just done, but done brilliantly.
                </p>
            </div>
        </div>
    </div>
</section>
 <!-- quotee -->
  <section id="get-a-quote" class="py-5 text-center" style="background-color: #fff;">
    <div class="container" style="max-width: 800px;">
        <h2 class="fw-bold">GET A QUOTE</h2>
        <p class="mb-5">Give us your information, and we will be in touch as soon as possible to bring your project to life.</p>
        <form id="quote-form" class="row g-2">
            <input type="hidden" name="formType" value="Get a quote Form">
            <div class="col-md-6">
                <input type="text" name="firstName" class="form-control border-0 border-bottom rounded-0" id="firstName" placeholder="First name" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="lastName" class="form-control border-0 border-bottom rounded-0" id="lastName" placeholder="Last name" required>
            </div>
            <div class="col-md-6">
                <input type="email" name="email" class="form-control border-0 border-bottom rounded-0" id="email" placeholder="Email" required>
                <div class="invalid-feedback">
                    Please enter a valid email address.
                </div>
            </div>
            <div class="col-md-6">
                <input type="tel" name="phone" class="form-control border-0 border-bottom rounded-0" id="phone" placeholder="Phone" required>
            </div>
            <div class="col-12">
                <textarea name="comments" class="form-control border-0 border-bottom rounded-0" id="comments" rows="3" placeholder="Comments"></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-dark px-4 py-2 ">Submit</button>
            </div>
        </form>
        <div id="success-message" class="mt-4 fst-italic d-none">Thanks for submitting!</div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4">
    <div class="container">
        <p class="mb-0">Titanium Electrical</p>
        <p>Powering a Greener Tomorrow: Electrical Solutions for All Your Needs</p>
        <small>©2023 by Titanium Electrical</small>
    </div>
</footer>


<script src="js/scripts.js"></script>

</body>
</html>
