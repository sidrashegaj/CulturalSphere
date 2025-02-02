document.addEventListener("DOMContentLoaded", () => {
    // Apply CircleType.js effect
    const circleText = document.getElementById("circle-text");
    if (circleText) {
        new CircleType(circleText);
        circleText.addEventListener("click", () => {
            const catalogSection = document.getElementById("catalog-section");
            if (catalogSection) {
                catalogSection.scrollIntoView({ behavior: "smooth" });
            }
        });
    }

    // Smooth Scroll for Anchor Links
    document.querySelectorAll('a[href^="#"]').forEach((link) => {
        link.addEventListener("click", (event) => {
            event.preventDefault();
            const targetElement = document.getElementById(link.getAttribute("href").substring(1));
            if (targetElement) {
                window.scrollTo({ top: targetElement.offsetTop, behavior: "smooth" });
            }
        });
    });

    // Navbar Transparency on Scroll
    const navbar = document.querySelector(".navbar");
    if (navbar) {
        window.addEventListener("scroll", () => {
            navbar.classList.toggle("navbar-transparent", window.scrollY > 50);
        });
    }
    
    
});

