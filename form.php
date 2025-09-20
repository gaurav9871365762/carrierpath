<?php
// form.php

// Helper: sanitize
function s($v){ return htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8'); }

$errors = [];
$submitted = false;
$name = $email = $phone_no = $massage = "";
$resumeFile = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? "";
    $email = $_POST['email'] ?? "";
    $phone_no = $_POST['phone_no'] ?? "";
    $massage = $_POST['massage'] ?? "";

    // Resume Upload
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $allowedExts = ['pdf', 'doc', 'docx'];
        $fileTmp = $_FILES['resume']['tmp_name'];
        $fileName = basename($_FILES['resume']['name']);
        $fileSize = $_FILES['resume']['size'];
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts)) {
            $errors['resume'] = "Sirf PDF, DOC, DOCX allowed hai.";
        } elseif ($fileSize > 2*1024*1024) {
            $errors['resume'] = "Resume 2MB se bada nahi hona chahiye.";
        } else {
            $uploadDir = __DIR__ . "/uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $resumeFile = $uploadDir . time() . "_" . $fileName;
            if (!move_uploaded_file($fileTmp, $resumeFile)) {
                $errors['resume'] = "Resume upload mein problem aayi.";
            }
        }
    } else {
        $errors['resume'] = "Resume upload karna zaroori hai.";
    }

    // Validations
    if (trim($name) === "") {
        $errors['name'] = "Name zaroori hai.";
    } elseif (strlen($name) < 2) {
        $errors['name'] = "Naam kam se kam 2 characters ka hona chahiye.";
    }

    if (trim($email) === "") {
        $errors['email'] = "Email chahiye.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Valid email daalo.";
    }

    if (trim($phone) !== "") {
        if (!preg_match('/^[0-9+\-\s]{7,20}$/', $phone)) {
            $errors['phone'] = "Phone number valid nahi lag raha.";
        }
    }

    if (trim($message) === "") {
        $errors['message'] = "Message likho bhaiya.";
    } elseif (strlen($message) < 5) {
        $errors['message'] = "Message thoda lamba hona chahiye (5+ chars).";
    }

    if (empty($errors)) {
        $submitted = true;
    }
}
?>
<!doctype html>
<html lang="hi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Contact Form with Resume</title>
  <style>
    :root {
      --bg:#0d1117; 
      --card:#161b22; 
      --accent:#58a6ff; 
      --danger:#f85149; 
      --success:#2ea043; 
      --muted:#8b949e;
      --text:#c9d1d9;
      font-family: "Inter", "Segoe UI", Roboto, Arial, sans-serif;
    }
    *{box-sizing:border-box; margin:0; padding:0}
    body {
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      background:var(--bg);
      color:var(--text);
      padding:20px;
    }
    .card {
      width:100%;
      max-width:760px;
      background:var(--card);
      border-radius:16px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.6);
      padding:32px;
      border:1px solid rgba(255,255,255,0.08);
      animation: fadeIn 0.6s ease;
    }
    @keyframes fadeIn {
      from {opacity:0; transform: translateY(20px);}
      to {opacity:1; transform: translateY(0);}
    }
    h1 { font-size:24px; color:#fff; margin-bottom:6px; }
    p.lead { font-size:14px; color:var(--muted); margin-bottom:22px; }
    form .row { display:grid; grid-template-columns:1fr 1fr; gap:18px; }
    label {
      font-size:13px; font-weight:600; margin-bottom:6px;
      display:block; color:var(--accent);
    }
    input[type="text"],
    input[type="email"],
    input[type="file"],
    textarea {
      width:100%; padding:12px 14px;
      border-radius:10px;
      border:1px solid rgba(255,255,255,0.08);
      background:#0d1117;
      color:var(--text);
      font-size:14px;
      transition: border 0.2s, box-shadow 0.2s;
    }
    input:focus, textarea:focus {
      border:1px solid var(--accent);
      box-shadow: 0 0 0 3px rgba(88,166,255,0.2);
      outline:none;
    }
    textarea { min-height:120px; resize:vertical; }
    .field-wrap { margin-bottom:18px; }
    .error { color:var(--danger); font-size:13px; margin-top:5px; }
    .success-box {
      background: rgba(46,160,67,0.1);
      border:1px solid var(--success);
      padding:12px 16px;
      border-radius:8px;
      margin-bottom:18px;
      font-size:14px;
      color:#7ee787;
    }
    .actions {
      display:flex;
      gap:12px;
      align-items:center;
      margin-top:14px;
    }
    .btn {
      background:var(--accent);
      border:none;
      color:#fff;
      font-weight:600;
      padding:12px 20px;
      border-radius:10px;
      cursor:pointer;
      transition:background 0.2s, transform 0.1s;
    }
    .btn:hover { background:#1f6feb; }
    .btn:active { transform: scale(0.97); }
    .small { font-size:13px; color:var(--muted); }
    @media(max-width:640px) { form .row { grid-template-columns:1fr; } }
  </style>
</head>
<body>
  <div class="card" role="main">
    <h1>Contact Form</h1>
    <p class="lead">Apna message + resume bhejo, hum jaldi response karenge 🚀</p>

    <?php if ($submitted): ?>
      <div class="success-box">
        ✅ Thanks, <?php echo s($name); ?>! <br>
        Humne tumhara message aur resume receive kar liya hai. 📂
      </div>
    <?php endif; ?>

    <form method="POST" action="save-form.php" enctype="multipart/form-data" novalidate>
      <div class="row">
        <div class="field-wrap">
          <label for="name">Name*</label>
          <input id="name" name="name" type="text" value="<?php echo s($name); ?>">
          <?php if (!empty($errors['name'])): ?><div class="error"><?php echo s($errors['name']); ?></div><?php endif; ?>
        </div>
        <div class="field-wrap">
          <label for="email">Email*</label>
          <input id="email" name="email" type="email" value="<?php echo s($email); ?>">
          <?php if (!empty($errors['email'])): ?><div class="error"><?php echo s($errors['email']); ?></div><?php endif; ?>
        </div>
      </div>

      <div class="field-wrap">
        <label for="phone_no">phone (optional)</label>
        <input id="phone_no" name="phone_no" type="text" value="<?php echo s($phone_no); ?>">
        <?php if (!empty($errors['phone_no'])): ?><div class="error"><?php echo s($errors['phone_no']); ?></div><?php endif; ?>
      </div>

      <div class="field-wrap">
        <label for="massage">massage*</label>
        <textarea id="massage" name="massage"><?php echo s($massage); ?></textarea>
        <?php if (!empty($errors['massage'])): ?><div class="error"><?php echo s($errors['massage']); ?></div><?php endif; ?>
      </div>

      <div class="field-wrap">
        <label for="resume">Upload Resume (PDF/DOC/DOCX, max 2MB)*</label>
        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx">
        <?php if (!empty($errors['resume'])): ?><div class="error"><?php echo s($errors['resume']); ?></div><?php endif; ?>
      </div>

      <div class="actions">
        <button type="submit" class="btn">Send</button>
        <div class="small">By submitting, you agree to our nice vibes 🫶</div>
      </div>
    </form>
  </div>
</body>
</html>
