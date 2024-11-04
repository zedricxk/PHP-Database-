<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meet the Crew</title>
    <link rel="icon" type="image/png" href="team.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <img src="team.png" alt="Team Logo" class="logo">
    <h1>Meet Our Team</h1> 
    <p>Our talented and experienced team is here to lead with innovation.</p>
    
    <?php if (isset($_SESSION['username'])): ?>
        <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>! <a href="?logout=true">Logout</a></p>
    <?php endif; ?>
</header>
