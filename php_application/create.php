<?php include 'db.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: menu.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Register New Student</h2>
<form method="POST" action="">
    <input type="text" name="username" placeholder="username" required><br>
    <input type="text" name="email" placeholder="email" required><br>
    <input type="text" name="password" placeholder="password" required><br>
    <button type="submit">Submit</button>
</form>
<a href="menu.php">Back to List</a>
