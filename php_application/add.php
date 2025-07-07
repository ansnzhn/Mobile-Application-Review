<?php 
include 'menu.php';
include 'db.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];
    $application_id = $_POST['application_id']; // Added application selection
    $status = isset($_POST['status']) ? 1 : 0; // Default to active

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO comments (application_id, name, comment, rating, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issii", $application_id, $name, $comment, $rating, $status);
    
    if ($stmt->execute()) {
        header("Location: index.php?success=1"); // Redirect after success
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Get applications for dropdown
$applications = $conn->query("SELECT id, title FROM applications");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Comment</title>
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
      font-weight: 500;
    }

    input[type="text"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-family: inherit;
    }

    textarea {
      min-height: 100px;
      resize: vertical;
    }

    button {
      margin-top: 20px;
      background-color: #5e6a8a;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
    }

    button:hover {
      background-color: #4e5a78;
    }

    .error {
      color: #d9534f;
      margin-top: 5px;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Add New Comment</h2>
    
    <?php if (isset($error)): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST" action="">
      <label for="application">Application</label>
      <select name="application_id" id="application" required>
        <option value="">-- Select Application --</option>
        <?php while ($app = $applications->fetch_assoc()): ?>
          <option value="<?php echo $app['id']; ?>"><?php echo htmlspecialchars($app['title']); ?></option>
        <?php endwhile; ?>
      </select>
      
      <label for="name">Name</label>
      <input type="text" name="name" id="name" required>
      
      <label for="comment">Comment</label>
      <textarea name="comment" id="comment" required></textarea>
      
      <label for="rating">Rating (1-5)</label>
      <input type="number" name="rating" id="rating" min="1" max="5" required>
      
      <label>
        <input type="checkbox" name="status" checked> Active Comment
      </label>
      
      <button type="submit">Submit Comment</button>
    </form>
  </div>

</body>
</html>