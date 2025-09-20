<?php 
include('db.php');
include('header.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Career Path - Home</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #121212;
      color: #e0e0e0;
    }
    .hero {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      min-height: 70vh;
      background: linear-gradient(135deg,#0f2027,#203a43,#2c5364);
      color: #fff;
      padding: 40px 20px;
      border-radius: 0 0 40px 40px;
    }
    .hero h1 {
      font-size: 42px;
      margin-bottom: 12px;
    }
    .hero p {
      font-size: 18px;
      color: #ccc;
      max-width: 600px;
      margin: auto;
    }
    .hero .btn {
      margin-top: 20px;
      padding: 12px 24px;
      font-size: 16px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      background: #4dd0e1;
      color: #000;
      font-weight: bold;
      transition: 0.3s;
    }
    .hero .btn:hover {
      background: #26c6da;
    }
    .features {
      display: grid;
      grid-template-columns: repeat(auto-fit,minmax(250px,1fr));
      gap: 20px;
      margin: 40px auto;
      width: 90%;
      max-width: 1100px;
    }
    .card {
      background: #1e1e1e;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.6);
      text-align: center;
      transition: transform 0.3s;
    }
    .card:hover {
      transform: translateY(-6px);
    }
    .card h3 {
      color: #4dd0e1;
      margin-bottom: 10px;
    }
    .footer {
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #777;
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
  <section class="hero">
    <h1>Welcome to Career Path 🚀</h1>
    <p>Discover your perfect career journey with our smart suggestion system. Just share your qualification & hobbies — we’ll guide you towards your bright future!</p>
    <a href="form.php"><button class="btn">Get Started</button></a>
  </section>

  <!-- Features Section -->
  <section class="features">
    <div class="card">
      <h3>🎓 Education Based</h3>
      <p>We analyze your highest qualification and provide career options tailored for you.</p>
    </div>
    <div class="card">
      <h3>🎨 Hobby Oriented</h3>
      <p>Your hobbies reveal your passions. We align them with professional opportunities.</p>
    </div>
    <div class="card">
      <h3>💡 Personal Strengths</h3>
      <p>Add your strengths and we’ll suggest careers where you can truly shine.</p>
    </div>
    <div class="card">
      <h3>🔒 Safe & Secure</h3>
      <p>Your data is private with us. No external API — fully secure system.</p>
    </div>
  </section>

  <footer class="footer">
    &copy; 2025 Carrrier path build with your bright future.
  </footer>

</body>
</html>
<?php include('footer.php'); ?>
