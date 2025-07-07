<?php
include 'menu.php';
include 'db.php';

$sql = "SELECT a.*, c.title AS category_title 
        FROM applications a 
        LEFT JOIN categories c ON a.category_id = c.id 
        ORDER BY a.created DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Applications</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 30px;
    }
    .container {
      max-width: 1000px;
      margin: auto;
    }
    .app-card {
      display: flex;
      background-color: #fff;
      margin-bottom: 20px;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      align-items: flex-start;
      gap: 20px;
    }
    .app-card img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 10px;
    }
    .app-info h2 {
      margin: 0;
      font-size: 1.3em;
      color: #5e6a8a;
    }
    .app-info p {
      margin: 6px 0;
      font-size: 0.95em;
    }
    .no-apps {
      text-align: center;
      color: #777;
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 style="color: #444;">Mobile Applications</h1>

    <?php
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $imagePath = htmlspecialchars($row['image_dir'] . $row['image']);
        echo "<div class='app-card'>
                <img src='$imagePath' alt='App Image'>
                <div class='app-info'>
                  <h2>" . htmlspecialchars($row['title']) . "</h2>
                  <p><strong>Category:</strong> " . htmlspecialchars($row['category_title']) . "</p>
                  <p><strong>Description:</strong> " . htmlspecialchars($row['review']) . "</p>
                  <p><strong>Status:</strong> " . ($row['status'] ? 'Active' : 'Inactive') . "</p>
                  <p><strong>Created:</strong> " . date("d M Y, h:i A", strtotime($row['created'])) . "</p>
                </div>
              </div>";
      }
    } else {
      echo "<p class='no-apps'>No applications found.</p>";
    }
    ?>
  </div>
</body>
</html>
