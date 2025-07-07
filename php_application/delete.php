<?php
include 'db.php';
$id = $_GET['id'];

if ($conn->query("DELETE FROM comments WHERE id = $id") === TRUE) {
  echo "<script>alert('Comment deleted successfully.'); window.location='index.php';</script>";
} else {
  echo "Error deleting comment: " . $conn->error;
}
?>
