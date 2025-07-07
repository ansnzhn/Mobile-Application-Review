<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Home | PHP Application</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f6f6f6;
            color: #333;
        }

        .welcome {
            max-width: 800px;
            margin: 80px auto 40px auto;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            text-align: center;
        }

        .welcome h1 {
            font-size: 2em;
            margin-bottom: 15px;
            color: #444;
        }

        .welcome p {
            font-size: 1.1em;
            color: #666;
        }

        .cta-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 24px;
            background-color:rgb(94, 106, 138);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: 500;
        }

        .cta-btn:hover {
            background-color:rgb(94, 106, 138);
        }

        footer {
            text-align: center;
            margin-top: 60px;
            padding: 15px;
            font-size: 0.9em;
            color: #aaa;
        }
    </style>
</head>
<body>

<div class="welcome">
    <h1>Welcome to the Mobile Application Review</h1>
    <p>Place for Applications Comments and Ratings.</p>
    <a href="index.php" class="cta-btn">Review/Comments</a>
</div>

<footer>
    &copy; <?= date('Y') ?> PHP Application. All rights reserved.
</footer>

</body>
</html>
