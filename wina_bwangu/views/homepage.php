<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wina Bwangu - Fast Money Transfers</title>
    <link rel="stylesheet" href="../models/homepage.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Add AOS library for scroll animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Standard favicon -->
    <link rel="icon" type="image/png" href="../assests/logo1.png">
    
    <!-- For iOS devices -->
    <link rel="apple-touch-icon" href="../assests/logo1.png">
    
    <!-- For IE -->
    <link rel="shortcut icon" type="image/x-icon" href="../assests/logo1.png">
</head>
<body>
    <header class="header">
        <div class="container">
            <a href="#" class="logo">
                <img src="../assests/logo1.png" alt="Wina Bwangu Logo" class="logo-img">
            </a>
            <nav class="navmenu">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#services">Send Money</a></li>
                    <li><a href="#track">Track Transfer</a></li>
                    <li><a href="#about">About Us</a></li>
                </ul>
            </nav>
            <div class="nav-right">
                <a href="#login" class="login-btn">Login</a>
                <button class="profile-btn">
                    <i class="fas fa-user"></i>
                </button>
            </div>
        </div>
    </header>

    <main>
        <section id="home" class="hero">
            <div class="container">
                <div class="hero-content" data-aos="fade-right">
                    <h1 class="animated-title">Transfer Money Instantly with Wina Bwangu</h1>
                    <p class="hero-text">Fast, secure, and reliable money transfers across the globe</p>
                    <div class="cta-buttons">
                        <a href="#services" class="btn btn-primary">Send Money Now</a>
                        <a href="#track" class="btn btn-secondary">Track Transfer</a>
                    </div>
                </div>
                <div class="hero-image" data-aos="fade-left">
                    <img src="../assests/transfer-illustration1.png" alt="Money Transfer Illustration">
                </div>
            </div>
        </section>

        <section id="features" class="features">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Why Choose Wina Bwangu?</h2>
                <div class="features-grid">
                    <div class="feature-card scroll-reveal" data-aos="fade-up">
                        <i class="fas fa-bolt feature-icon"></i>
                        <h3>Instant Transfers</h3>
                        <p>Send money in seconds, not days</p>
                    </div>
                    <div class="feature-card scroll-reveal" data-aos="fade-up">
                        <i class="fas fa-shield-alt feature-icon"></i>
                        <h3>Secure & Safe</h3>
                        <p>Bank-level security for your peace of mind</p>
                    </div>
                    <div class="feature-card scroll-reveal" data-aos="fade-up">
                        <i class="fas fa-globe feature-icon"></i>
                        <h3>Global Reach</h3>
                        <p>Send money anywhere, anytime</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Add AOS library and initialize -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100
            });

            // Scroll reveal animation
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.scroll-reveal').forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>
</html>