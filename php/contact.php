<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <nav class="main-nav">
        <a href="../index.html" class="logo"><img src="s-logo.jpg" alt="Logo"></a>
        <ul class="menu-items">
            <li><a href="../index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="service.html">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <button class="cta-button-head"><a href="contact.php">Get Started</a></button>
        <button class="menu-toggle" aria-label="Toggle Menu">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
    <nav class="side-nav">
        <ul>
            <img src="../images/s-logo.jpg" class="side-logo" alt="" />
            <li><a href="../index.html">Home</a></li>
            <li><a href="pages/about.html">About</a></li>
            <li><a href="pages/service.html">Services</a></li>
            <li><a href="pages/contact.php">Contact</a></li>
        </ul>
        <a href="contact.php"><button class="cta-button">Get Started</button></a>
    </nav>
</header>

<main>
    <section class="contact-form-section">
    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'error') : 
        $errors = $_SESSION['errors'];
    ?>
        <ul style="color:red; font-weight:bolder; text-align:center; font-size:1.3rem; list-style-type:none;">
            <?php foreach ($errors as $e): ?>
                <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php 
        unset($_SESSION['status']);
        unset($_SESSION['errors']);
    endif; ?>

    <?php if (isset($_SESSION['messagestatus']) && $_SESSION['messagestatus'] === 'error') : 
        $mailerError = $_SESSION['messageerrors'];
    ?>
        <p style="color:red; font-weight:bolder;;"><?= htmlspecialchars($mailerError) ?></p>
    <?php 
        unset($_SESSION['messagestatus']);
        unset($_SESSION['messageerrors']);
    elseif (isset($_SESSION['messagestatus']) && $_SESSION['messagestatus'] === 'success') : 
        $mailerSuccess = "MESSAGE WAS SUCCESSFULLY SENT";
    ?>
        <p style="color:green; font-weight:bolder; text-align:center; font-size:1.3rem; list-style-type:none;"><?= htmlspecialchars($mailerSuccess) ?></p>
    <?php 
        unset($_SESSION['messagestatus']);
    endif; ?>
    <section class="cf2">
        <div class="contact-info">
            <h2>Get in Touch</h2>
            <p>Have any questions? Interested in any of our services? Feel free to reach out to us today. Fill out the form below and someone from our team will reach out as soon as possible.</p>
        </div>
        <div class="contact-form">
            <form action="mailsendertwo.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
        </section>
    </section>

    <section class="contact-details">
        <div class="ct-box">
            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <div class="contact-text">
                    <h3>Phone</h3>
                    <h2>+90 534 066 81 18</h2>
                </div>
            </div>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <div class="contact-text">
                    <h3>Address (Nigeria)</h3>
                    <h2>No.25, Orenuga Odugbose Street, Opp Lasustech, 1st gate, Ikorodu, Lagos, Nigeria</h2>
                </div>
            </div>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <div class="contact-text">
                    <h3>Address (Rwanda)</h3>
                    <h2>Kimironko Kg, 161, first floor, Office B-02, Kigali, Rwanda</h2>
                </div>
            </div>
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <div class="contact-text">
                    <h3>Email</h3>
                    <a href="mailto:info@studyabroadtravel.com"><h2>info@example.com</h2></a>
                </div>
            </div>
            <div class="contact-item">
                <i class="fab fa-whatsapp"></i>
                <div class="contact-text">
                    <h3>WhatsApp</h3>
                    <a href="https://api.whatsapp.com/send?phone=905340668118"><h2>+90 534 066 81 18</h2></a>
                </div>
            </div>
            <div class="contact-item">
                <i class="fab fa-instagram"></i>
                <div class="contact-text">
                    <h3>Instagram</h3>
                    <a href="https://www.instagram.com/suntim_international_services?igsh=MTNsdWRxNm9jYmlsaA=="><h2>suntim_international_services</h2></a>
                </div>
            </div>
        </div>
    </section>
</main>

<footer>
    <div class="footer-content">
        <div class="footer-box">
            <div class="footer-info">
                <img src="s-logo.jpg" alt="Logo" class="footer-logo">
                <p>Suntim International Services is an agency dedicated to enriching your academic journey by providing you with unique opportunities to learn, explore, and grow in diverse international settings.</p>
            </div>
            <div class="footer-links">
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="services.html">Services</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="policy.html">Privacy Policy</a></li>
                        <li><a href="policy.html">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Offices</h3>
                    <ul>
                        <li><a href="contact.php">Turkey</a></li>
                        <li><a href="contact.php">Rwanda</a></li>
                        <li><a href="contact.php">Nigeria</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="" id="sub-footer">
    <div class="footer-box">
        <div class="copyright">
            <p>&copy; 2024 Suntim International Services. All rights reserved.</p>
        </div>
    </div>
</div>

<script src="contact.js"></script>
</body>
</html>

<?php
// Clear session variables to prevent repeated messages on refresh
unset($_SESSION['status']);
unset($_SESSION['errors']);
unset($_SESSION['messageerrors']);
unset($_SESSION['messagestatus']);
?>
