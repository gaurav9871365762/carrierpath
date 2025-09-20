<?php 
include('db.php');
include('header.php');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Career Path for Bright Future</title>
  <style>
    /* ====== Dark Mode Theme ====== */
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #121212;
      color: #e0e0e0;
    }
    .app {
      padding: 20px;
    }
    .header {
      background: linear-gradient(90deg,#0f2027,#203a43,#2c5364);
      padding: 20px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 3px 12px rgba(0,0,0,0.6);
    }
    .header h1 {
      margin: 0;
      font-size: 32px;
      color: #fff;
    }
    .header .muted {
      color: #4dd0e1;
    }
    .header .subtitle {
      font-size: 14px;
      color: #ccc;
    }
    .badges {
      margin-top: 10px;
    }
    .badge {
      display: inline-block;
      background: #1f1f1f;
      color: #4dd0e1;
      padding: 6px 12px;
      border-radius: 20px;
      margin: 4px;
      font-size: 12px;
      border: 1px solid #333;
    }
    .grid-two {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-top: 20px;
    }
    .card {
      background: #1e1e1e;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.7);
    }
    label {
      font-weight: bold;
      display: block;
      margin-bottom: 6px;
      color: #90caf9;
    }
    .input, .select, .textarea {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #333;
      background: #121212;
      color: #e0e0e0;
      margin-bottom: 12px;
    }
    .textarea {
      min-height: 80px;
    }
    .chip {
      display: inline-block;
      margin: 4px;
      cursor: pointer;
    }
    .chip input {
      display: none;
    }
    .chip span {
      display: inline-block;
      padding: 6px 10px;
      border-radius: 20px;
      background: #2c2c2c;
      border: 1px solid #444;
      font-size: 13px;
      transition: 0.2s;
      color: #e0e0e0;
    }
    .chip input:checked + span {
      background: #4dd0e1;
      color: #000;
      font-weight: bold;
    }
    .btn {
      padding: 10px 16px;
      border-radius: 6px;
      cursor: pointer;
      border: none;
      font-weight: bold;
      margin-right: 8px;
      transition: 0.2s;
    }
    .btn.primary {
      background: #4dd0e1;
      color: #000;
    }
    .btn.primary:hover {
      background: #26c6da;
    }
    .btn.outline {
      background: transparent;
      border: 1px solid #4dd0e1;
      color: #4dd0e1;
    }
    .btn.outline:hover {
      background: #4dd0e1;
      color: #000;
    }
    .results {
      font-size: 14px;
      color: #e0e0e0;
    }
    .assistant-note {
      color: #aaa;
      font-style: italic;
    }
    .plan-box {
      background: #111;
      border: 1px solid #333;
      padding: 12px;
      border-radius: 6px;
      color: #c5e1a5;
      white-space: pre-wrap;
    }
    .footer {
      margin-top: 30px;
      text-align: center;
      font-size: 14px;
      color: #777;
    }
  </style>
</head>
<body>
  <div class="app">
    <header class="header">
      <div>
        <h1>Carreer <span class="muted">Path</span></h1>
        <p class="subtitle">Get career suggestions based on your qualification & hobbies</p>
      </div>
      <div class="badges">
        <span class="badge">Your information is secure 🔒</span>
        <span class="badge">Backend team support 👨‍💻</span>
      </div>
    </header>

    <div class="grid-two">
      <section class="card">
        <form id="careerForm">
          <div class="form-grid">
            <div>
              <label for="name">Name</label>
              <input id="name" name="name" class="input" placeholder="Your name" />
            </div>
            <div>
              <label for="age">Age</label>
              <input id="age" name="age" type="number" min="12" class="input" placeholder="18" />
            </div>
          </div>

          <div>
            <label for="qualification">Highest Qualification</label>
            <select id="qualification" name="qualification" class="select">
              <option>10th Pass</option>
              <option>12th Pass</option>
              <option>Diploma (CS/IT)</option>
              <option>Diploma (Other)</option>
              <option>BSc</option>
              <option>BA</option>
              <option>BCom</option>
              <option>BCA</option>
              <option>BTech/BE (CS/IT)</option>
              <option>BTech/BE (Non-CS)</option>
              <option>MBA</option>
              <option>MCA</option>
              <option>MTech/MS</option>
              <option>Other/Not Sure</option>
            </select>
          </div>

          <div>
            <label>Hobbies (select any)</label>
            <div class="hobby-list">
              <?php
                $hobbies = [
                  "Coding","Design / Drawing","Public Speaking","Writing / Blogging",
                  "Gaming / Esports","Video Editing","Photography","Music / Singing",
                  "Problem Solving / Puzzles","Helping People / Teaching","Fitness / Sports",
                  "Finance / Investing","DIY / Hardware","Marketing / Social Media","Reading Research / Data"
                ];
                foreach ($hobbies as $h) {
                  $id = "hobby-".preg_replace('/[^a-z0-9]+/i','-',strtolower($h));
                  echo "<label class='chip'><input type='checkbox' name='hobbies[]' value='".htmlspecialchars($h)."' id='$id' /> <span>".htmlspecialchars($h)."</span></label>\n";
                }
              ?>
            </div>
          </div>

          <div>
            <label for="strengths">Your strengths (free text)</label>
            <textarea id="strengths" name="strengths" class="textarea" placeholder="e.g., logical thinking, good communication, Excel + SQL"></textarea>
          </div>

          <div class="actions" style="margin-top:14px;">
            <button class="btn primary" type="submit">Generate Plan</button>
            <button class="btn outline" id="resetBtn" type="button">Reset</button>
            <button class="btn outline" id="downloadBtn" type="button" style="display:none">Download Plan</button>
          </div>
        </form>
      </section>

      <aside class="card">
        <div class="results" id="results">
         <div class="assistant-note">
  Fill the form and press 
  <a href="generate.php">
    <strong>Generate Plan</strong>
  </a> — suggestions will appear here.
</div>

        <pre id="planBox" class="plan-box" style="display:none"></pre>
      </aside>
    </div>

    <footer class="footer">Built it for your bright future</footer>
  </div>

  <script src="assets/script.js"></script>
</body>
</html>
<?php include('footer.php'); ?>
