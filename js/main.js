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

    // Initialize EmailJS with Public Key
    emailjs.init('9RLH0pscuP4QDiA9A');

    // Handle form submission logic for all forms
    const handleFormSubmission = (formId, successMessageId, serviceId, templateId) => {
        const form = document.getElementById(formId);
        const successMessage = document.getElementById(successMessageId);

        if (form && successMessage) {
            form.addEventListener('submit', (event) => {
                event.preventDefault(); // Prevent default form submission

                // Validate the form
                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                // Send email using EmailJS
                emailjs
                    .sendForm(serviceId, templateId, form)
                    .then(() => {
                        // Show success message
                        successMessage.textContent = 'Thanks for submitting! We’ll get back to you soon.';
                        successMessage.classList.remove('d-none');
                        successMessage.classList.add('text-success');

                        // Reset the form
                        form.reset();
                        form.classList.remove('was-validated');

                        // Hide success message after 3 seconds
                        setTimeout(() => {
                            successMessage.classList.add('d-none');
                        }, 3000);
                    })
                    .catch((error) => {
                        console.error('Error sending email:', error);
                        alert('Failed to send the email. Please try again later.');
                    });
            });
        }
    };

    // Apply handlers to the forms
    handleFormSubmission('quote-form', 'success-message', 'service_i3xh8uk', 'template_ygckk7h');
    handleFormSubmission('rate-us-form', 'success-message', 'service_i3xh8uk', 'template_ygckk7h');
    handleFormSubmission('contactForm', 'success-message', 'service_i3xh8uk', 'template_ygckk7h');
});
