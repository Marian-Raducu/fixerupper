<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us - FixerUpper</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background: url('images/contact.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .contact-container {
            background-color: rgba(255, 255, 255, 0.95);
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            text-align: center;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: transparent;
    text-align: bottom ;
    padding: 10px 0;
    border-top: 1px none #ddd;
    font-size: 14px; 
}

        button {
            margin-top: 20px;
            background-color: #3498db;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .success-message {
            background-color: #dff0d8;
            border: 1px solid #b2d8b2;
            color: #3c763d;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="contact-container">
    <h1>Contact Us</h1>
    <p>Have questions? Need support? Reach out below and we’ll get back to you as soon as possible.</p>

    <?php
    $success = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $success = true;
    }
    ?>

    <?php if ($success): ?>
        <div class="success-message">
            Thank you, <?= $name ?>! Your message has been received.
        </div>
    <?php endif; ?>

    <form method="post" action="contact.php">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="message">Message:</label>
        <textarea name="message" rows="5" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</body>
</html>

    <div class="footer-column">
      <h3>Follow Us</h3>
      <div class="social-icons">
        <a href="https://facebook.com" target="_blank" aria-label="Facebook">
        <img src="images/Facebook.jpg" alt="Facebook" width="50" height="50">
        </a>
        <a href="https://instagram.com" target="_blank" aria-label="Instagram">
        <img src="images/Instagram.jpg" alt="Instagram" width="50" height="50">
        </a>
        <a href="https://youtube.com" target="_blank" aria-label="YouTube">
        <img src="images/YouTube.jpg" alt="YouTube" width="50" height="50">
        </a>
      </div>
    </div>

    <div class="footer-column">
      <h3>Quick Links</h3>
      <ul class="quick-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div class="center-left-box">
  <!-- Your content here -->
  <p>© FixerUpper. All rights reserved.</p>
</div>
  </div>
</footer>