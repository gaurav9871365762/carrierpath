<?php
// generate.php (same as search.php)
if (isset($_GET['q'])) {
    $query = $_GET['q'];
    $apiKey = "YOUR_GOOGLE_API_KEY";
    $cx = "YOUR_CUSTOM_SEARCH_ENGINE_ID";

    $url = "https://www.googleapis.com/customsearch/v1?key=$apiKey&cx=$cx&q=" . urlencode($query);
    $response = file_get_contents($url);
    $data = json_decode($response, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Generate Plan</title>
  <style>
    body { background:#0f172a; color:#e2e8f0; font-family:Arial, sans-serif; padding:20px; text-align:center; }
    .logo {
      width:100px;
      margin:20px auto;
      animation:spin 10s linear infinite;
      display:block;
    }
    @keyframes spin {
      from { transform: rotate(0deg); }
      to   { transform: rotate(360deg); }
    }
    h1 { margin-top:10px; font-size:24px; }
    .search-box { margin:20px auto; }
    input[type=text] {
      width:60%; padding:10px; border-radius:8px; border:none; outline:none;
    }
    button {
      padding:10px 14px; background:#2563eb; color:white; border:none;
      border-radius:8px; cursor:pointer;
    }
    .result {
      background:#1e293b; padding:16px; border-radius:12px; margin:12px auto;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3); max-width:800px; text-align:left;
    }
    .result h3 { margin:0; font-size:18px; }
    .result a { color:#60a5fa; text-decoration:none; }
    .result a:hover { text-decoration:underline; }
    .result p { font-size:14px; color:#94a3b8; }
  </style>
</head>
<body>
  <!-- React Logo -->
  <img src="https://upload.wikimedia.org/wikipedia/commons/a/a7/React-icon.svg" 
       alt="React Logo" class="logo">

  <h1>⚡ Generate Plan</h1>
  <form method="get" action="generate.php" class="search-box">
    <input type="text" name="q" placeholder="Search anything..." 
           value="<?php echo isset($query)?htmlspecialchars($query):''; ?>">
    <button type="submit"><strong>Generate Plan</strong></button>
  </form>

  <?php if (!empty($data['items'])): ?>
    <?php foreach ($data['items'] as $item): ?>
      <div class="result">
        <h3><a href="<?php echo $item['link']; ?>" target="_blank"><?php echo $item['title']; ?></a></h3>
        <p><?php echo $item['snippet']; ?></p>
      </div>
    <?php endforeach; ?>
  <?php elseif(isset($query)): ?>
    <p>No results found.</p>
  <?php endif; ?>
</body>
</html>
