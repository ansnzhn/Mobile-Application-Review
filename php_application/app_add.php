<?php include 'menu.php'; ?>
<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $status = $_POST['status'];
  $category_id = $_POST['category_id'];
  $created = date('Y-m-d H:i:s');

  $stmt = $conn->prepare("INSERT INTO applications (title, description, status, category_id, created, modified) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssiiss", $title, $description, $status, $category_id, $created, $created);
  $stmt->execute();

  echo "<script>alert('Application review saved.'); window.location='applications.php';</script>";
}
?>

<h2 style="padding: 30px;">Add New Application Review</h2>
<form method="POST" enctype="multipart/form-data" style="padding: 0 30px;">
  <label>App Title:</label><br>
  <input type="text" name="title" required><br><br>

  <label>Description:</label><br>
  <textarea name="description" required></textarea><br><br>

  <label>Status:</label><br>
  <select name="status">
    <option value="1">Active</option>
    <option value="0">Inactive</option>
  </select><br><br>

  <label>Category:</label><br>
  <select name="category_id" required>
    <option value="">-- Select Category --</option>
    <?php
      $categories = $conn->query("SELECT id, name FROM categories");
      while ($cat = $categories->fetch_assoc()) {
        echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
      }
    ?>
  </select><br><br>

  <button type="submit" style="padding: 8px 16px; background-color: rgb(94,106,138); color:white; border:none; border-radius: 4px;">Save</button>
</form>
