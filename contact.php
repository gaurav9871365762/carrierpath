<?php 
include('db.php');
include('header.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact Us - Career Path</title>
  <style>
    body {
      margin:0;
      font-family: 'Segoe UI', sans-serif;
      background:#121212;
      color:#eee;
    }
    .contact-container {
      max-width: 700px;
      margin: 60px auto;
      background:#1e1e1e;
      padding:30px;
      border-radius:12px;
      box-shadow:0 4px 14px rgba(0,0,0,0.6);
    }
    h1 {
      text-align:center;
      margin-bottom:20px;
      color:#4dd0e1;
    }
    label {
      display:block;
      margin-bottom:6px;
      font-weight:600;
      color:#ccc;
    }
    input,textarea {
      width:100%;
      padding:12px;
      margin-bottom:16px;
      border:none;
      border-radius:8px;
      background:#2c2c2c;
      color:#eee;
      font-size:15px;
    }
    input:focus,textarea:focus {
      outline:none;
      border:2px solid #4dd0e1;
    }
    button {
      padding:12px 24px;
      background:#4dd0e1;
      border:none;
      border-radius:8px;
      color:#000;
      font-weight:bold;
      cursor:pointer;
      transition:0.3s;
    }
    button:hover {
      background:#26c6da;
    }
    .success {
      background:#14532d;
      color:#bbf7d0;
      padding:10px;
      border-radius:8px;
      margin-bottom:16px;
    }
    .error {
      background:#7f1d1d;
      color:#fecaca;
      padding:10px;
      border-radius:8px;
      margin-bottom:16px;
    }
  </style>
</head>
<body>

<div class="contact-container">
  <h1>📩 Contact Us</h1>
  <!-- here we write the select queery code for database connecctivity ; -->

  <form action="save-contact.php"method="POST">
    <label for="name">Your Name</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required />

    <label for="email">Your Email</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required />

    <label for="subject">Your Message</label>
    <textarea id="subject" name="subject" rows="5" placeholder="Write your message here..." required></textarea>

    <button type="submit">Send Message</button>
  </form>
</div>

<footer style="text-align:center;padding:20px;color:#777;">
  &copy; 2025 Carrrier path for your bright future.
</footer>

</body>
</html>
<?php include('footer.php'); ?>
