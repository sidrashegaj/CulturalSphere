document.addEventListener("DOMContentLoaded", () => {
    // Apply CircleType.js effect
    const circleText = document.getElementById("circle-text");
    if (circleText) {
        new CircleType(circleText); // Apply circular text layout

        // Add click-to-scroll functionality
        circleText.addEventListener("click", () => {
            const catalogSection = document.getElementById("catalog-section");
            if (catalogSection) {
                catalogSection.scrollIntoView({ behavior: "smooth" });
            }
        });
    }
});








document.addEventListener("DOMContentLoaded", function () {
    // Simulated user login state (set this dynamically in your app)
    const isLoggedIn = false; // Change this to true to test logged-in state

    const guestButtons = document.getElementById("guest-buttons");
    const userProfile = document.getElementById("user-profile");

    if (isLoggedIn) {
        // Show Profile Icon
        guestButtons.classList.add("d-none");
        userProfile.classList.remove("d-none");
    } else {
        // Show Login/Register Buttons
        guestButtons.classList.remove("d-none");
        userProfile.classList.add("d-none");
    }
});


document.addEventListener('DOMContentLoaded', () => {
    // Smooth Scroll for Anchor Links
    const smoothScroll = () => {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const targetId = link.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: 'smooth',
                    });
                }
            });
        });
    };
    smoothScroll();

    // Navbar Transparency on Scroll
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-transparent');
            } else {
                navbar.classList.remove('navbar-transparent');
            }
        });

        // Add Navbar Transparency Styling
        const style = document.createElement('style');
        style.textContent = `
            .navbar-transparent {
                background-color: rgba(0, 0, 0, 0.8) !important;
                transition: background-color 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    }

  
});
