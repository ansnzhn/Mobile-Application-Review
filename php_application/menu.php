<?php session_start(); ?>
<style>
  .navbar {
    background-color: #ffffff;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border-bottom: 1px solid #e0e0e0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.03);
  }

  .navbar-left,
  .navbar-right {
    display: flex;
    align-items: center;
  }

  .navbar-logo {
    font-weight: bold;
    font-size: 1.4em;
    color: rgb(94, 106, 138);
    margin-right: 30px;
  }

  .navbar a {
    color: #333;
    text-decoration: none;
    margin: 0 12px;
    padding: 8px 12px;
    border-radius: 6px;
    transition: background-color 0.2s, color 0.2s;
    font-weight: 500;
  }

  .navbar a:hover {
    background-color: #f0f0f5;
    color: rgb(94, 106, 138);
  }

  .navbar-right span {
    font-size: 0.9em;
    margin-right: 10px;
    color: #555;
  }

  .navbar a.logout {
    background-color: #d9534f;
    color: white;
  }

  .navbar a.logout:hover {
    background-color: #c9302c;
  }
</style>

<div class="navbar">
  <div class="navbar-left">
    <div class="navbar-logo">📱 App Review System</div>
    <a href="home.php">Home</a>
    <a href="index.php">Comments</a>
    <a href="categories.php">Categories</a>
    <a href="applications.php">Applications</a>
  </div>

  <div class="navbar-right">
    <?php if (isset($_SESSION['username'])): ?>
      <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
      <a href="logout.php" class="logout">Logout</a>
    <?php endif; ?>
  </div>
</div>