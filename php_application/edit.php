<?php include 'menu.php'; ?>
<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM comments WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Comment</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background-color: #f9f9f9;
      padding: 30px;
    }

    .form-container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
    }

    input[type="text"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    button {
      margin-top: 20px;
      background-color: #5e6a8a;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #4e5a78;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Edit Comment</h2>
    <form method="POST" action="">
      <label>Name</label>
      <input type="text" name="name" value="<?= $row['name'] ?>" required>

      <label>Comment</label>
      <textarea name="comment" required><?= $row['comment'] ?></textarea>

      <label>Rating</label>
      <input type="number" name="rating" value="<?= $row['rating'] ?>" min="1" max="5" required>

      <label>Status</label>
      <select name="status">
        <option value="1" <?= $row['status'] ? 'selected' : '' ?>>Active</option>
        <option value="0" <?= !$row['status'] ? 'selected' : '' ?>>Inactive</option>
      </select>

      <button type="submit">Update</button>
    </form>
  </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $rating = $_POST['rating'];
  $status = $_POST['status'];
  $modified = date('Y-m-d H:i:s');

  $stmt = $conn->prepare("UPDATE comments SET name=?, comment=?, rating=?, status=?, modified=? WHERE id=?");
  $stmt->bind_param("ssiisi", $name, $comment, $rating, $status, $modified, $id);
  $stmt->execute();
  echo "<script>alert('Comment updated successfully!'); window.location='index.php';</script>";
}
?>

</body>
</html>
