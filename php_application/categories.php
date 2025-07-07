<?php include 'menu.php'; ?>
<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Category List</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      margin: 0;
      background-color: #f9f9f9;
      padding: 30px;
      color: #333;
    }

    .container {
      max-width: 700px;
      margin: auto;
      background-color: #fff;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    h1 {
      font-size: 1.8em;
      margin-bottom: 20px;
      color: rgb(94, 106, 138);
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      background-color: #f1f1f1;
      margin-bottom: 10px;
      padding: 12px 18px;
      border-radius: 6px;
      font-size: 1.05em;
    }

    .no-data {
      text-align: center;
      color: #777;
      font-style: italic;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Application Categories</h1>

    <ul>
      <?php
        $result = $conn->query("SELECT * FROM categories ORDER BY title ASC");

        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<li>" . htmlspecialchars($row['title']) . "</li>";
          }
        } else {
          echo "<li class='no-data'>No categories found.</li>";
        }
      ?>
    </ul>
  </div>
</body>
</html>
