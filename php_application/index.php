<?php include 'menu.php'; ?>
<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Application Comments</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      margin: 0;
      background-color: #f9f9f9;
      color: #333;
    }

    .container {
      max-width: 1100px;
      margin: 50px auto;
      padding: 0 20px;
    }

    h1 {
      font-size: 2em;
      margin-bottom: 20px;
      color: #444;
    }

    .add-btn {
      display: inline-block;
      background-color: rgb(94, 106, 138);
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 6px;
      margin-bottom: 20px;
      transition: background-color 0.3s;
    }

    .add-btn:hover {
      background-color: rgb(84, 96, 128);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.03);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    th {
      background-color: #f1f1f1;
      color: #555;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    .action-btn {
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      text-decoration: none;
      font-size: 0.9em;
      margin-right: 5px;
      display: inline-block;
    }

    .edit-btn {
      background-color: #f0ad4e;
      color: white;
    }

    .edit-btn:hover {
      background-color: #e39d3c;
    }

    .delete-btn {
      background-color: #d9534f;
      color: white;
    }

    .delete-btn:hover {
      background-color: #c9302c;
    }

    .btn-group {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
    }

    .app-img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 6px;
    }

    .search-bar {
      margin-bottom: 20px;
    }

    .search-bar input[type="text"] {
      padding: 8px;
      width: 250px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .search-bar button {
      padding: 8px 12px;
      background-color: #5e6a8a;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .search-bar button:hover {
      background-color: #4e5a78;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Application Comments</h1>

    <form method="get" class="search-bar">
      <input type="text" name="search" placeholder="Search by name or comment..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
      <button type="submit">Search</button>
    </form>

    <a href="add.php" class="add-btn">+ Add New Comment</a>

    <table>
      <thead>
        <tr>
          <th>App</th>
          <th>Image</th>
          <th>Name</th>
          <th>Comment</th>
          <th>Rating</th>
          <th>Status</th>
          <th>Created</th>
          <th>Modified</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
       <?php
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT 
                  c.id AS comment_id,
                  c.name,
                  c.comment,
                  c.rating,
                  c.status,
                  c.created,
                  c.modified,
                  a.title AS app_title,
                  a.image AS app_image
                FROM comments c
                JOIN applications a ON c.application_id = a.id";

        if (!empty($search)) {
          $sql .= " WHERE c.name LIKE '%$search%' OR c.comment LIKE '%$search%'";
        }

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
              <td>" . htmlspecialchars($row['app_title']) . "</td>
              <td><img src='images/" . htmlspecialchars($row['app_image']) . "' class='app-img' alt='App Image'></td>
              <td>" . htmlspecialchars($row['name']) . "</td>
              <td>" . htmlspecialchars($row['comment']) . "</td>
              <td>" . htmlspecialchars($row['rating']) . "</td>
              <td>" . ($row['status'] ? 'Active' : 'Inactive') . "</td>
              <td>" . date("d M Y, h:i A", strtotime($row['created'])) . "</td>
              <td>" . date("d M Y, h:i A", strtotime($row['modified'])) . "</td>
              <td>
                <div class='btn-group'>
                  <a href='edit.php?id={$row['comment_id']}' class='action-btn edit-btn'>Edit</a>
                  <a href='delete.php?id={$row['comment_id']}' class='action-btn delete-btn' onclick=\"return confirm('Are you sure?')\">Delete</a>
                </div>
              </td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='9' style='text-align:center;'>No comments found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>
</html>
