<?php
session_start();
require 'config.php';

$loginError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $remember = isset($_POST['remember']); 

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id; 
            $_SESSION['username'] = $username;

            if ($remember) {
               
                setcookie("user_id", $id, time() + (86400 * 30), "/");  
                setcookie("username", $username, time() + (86400 * 30), "/");
            }

            header("Location: index.php");
            exit();
        } else {
            $loginError = "Invalid password.";
        }
    } else {
        $loginError = "Username does not exist.";
    }
    $stmt->close();
}

if (isset($_GET['logout'])) {
    session_destroy();

    setcookie("user_id", "", time() - 3600, "/");
    setcookie("username", "", time() - 3600, "/");

    header("Location: index.php");
    exit();

    if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['username'] = $_COOKIE['username'];
    }
}
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

<?php if (isset($_SESSION['username'])): ?>
    <div class="team-container">
        <?php
        $team = [
            [
                "name" => "Geryme Elimino",
                "role" => "Team Leader",
                "description" => "An Artist and an IT Student",
                "image" => "ger.jpg",
                "facebook" => "https://www.facebook.com/GrymGdLmn/",
                "instagram" => "https://www.instagram.com/_draw.meeee/"
            ],
            [
                "name" => "Jestine Toribio",
                "role" => "Co-Leader",
                "description" => "A Gamer and an IT Student",
                "image" => "jes.jpg",
                "facebook" => "https://www.facebook.com/jestine517",
                "instagram" => "https://www.instagram.com/_draw.meeee/"
            ],
            [
                "name" => "Zedrick Prado",
                "role" => "Member",
                "description" => "An IT Student and Cyclist",
                "image" => "zed.jpg",
                "facebook" => "https://www.facebook.com/zedd1717",
                "instagram" => "https://www.instagram.com/_draw.meeee/"
            ],
            [
                "name" => "Joseph Hansol",
                "role" => "Member",
                "description" => "IT Wizard and Gamer",
                "image" => "jos.jpg",
                "facebook" => "https://www.facebook.com/joseph.hansol.9",
                "instagram" => "https://www.instagram.com/_draw.meeee/"
            ],
            [
                "name" => "Chel Sea Ordoña ",
                "role" => "Member",
                "description" => "One of the boys, IT Student",
                "image" => "chel.jpg",
                "facebook" => "https://www.facebook.com/profile.php?id=100010720775747",
                "instagram" => "https://www.instagram.com/_draw.meeee/"
            ]
        ];

        foreach ($team as $member) {
            echo "<div class='team-member'>
                    <img src='{$member['image']}' alt='{$member['name']}'>
                    <h3>{$member['name']}</h3>
                    <p><strong>{$member['role']}</strong></p>
                    <p>{$member['description']}</p>
                    <div class='social-icons'>
                        <a href='{$member['facebook']}' target='_blank'>
                            <img src='facebook.png' alt='Facebook' class='icon'>
                        </a>
                        <a href='{$member['instagram']}' target='_blank'>
                            <img src='instagram.png' alt='Instagram' class='icon'>
                        </a>
                    </div>
                  </div>";
        }
        ?>
    </div>
<br>
<br>
    <div class="form-section">
       <center><h2>Send Us a Message</h2></center> 
        <form method="POST" action="index.php">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="age">Age:</label>
            <input type="number" name="age" id="age" required>

            <label for="number">Contact Number:</label>
            <input type="tel" name="number" id="number" required>

            <label for="message">Message:</label>
            <textarea name="message" id="message" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
<br>
<br>
    <div class="form-section">
       <center><h2>Search via</h2></center> 
        <form method="GET" action="index.php">
            <label for="name">Enter Name:</label>
            <input type="text" name="name" id="name">

            <label for="age">Enter Age:</label>
            <input type="number" name="age" id="age">

            <label for="number">Enter Contact Number:</label>
            <input type="tel" name="number" id="number">

            <button type="submit">Search</button>
        </form>
    </div>

    <div class="output-section">
        <?php
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST['name']);
            $age = htmlspecialchars($_POST['age']);
            $number = htmlspecialchars($_POST['number']);
            $message = htmlspecialchars($_POST['message']);
            echo "<p>Thank you, <strong>$name</strong>. You are <strong>$age</strong> years old and your contact number is <strong>$number</strong>.</p>";
            echo "<p>Your message: <em>$message</em></p>";
        }

        
        if (isset($_GET['name']) || isset($_GET['age']) || isset($_GET['number'])) {
            $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'N/A';
            $age = isset($_GET['age']) ? htmlspecialchars($_GET['age']) : 'N/A';
            $number = isset($_GET['number']) ? htmlspecialchars($_GET['number']) : 'N/A';

            echo "<p>GET Search Results:</p>";
            echo "<p>Name: <strong>$name</strong></p>";
            echo "<p>Age: <strong>$age</strong></p>";
            echo "<p>Contact Number: <strong>$number</strong></p>";
        }
        ?>
    </div>

    <div class="link-section">
        <p>Looking to contact us? <a href="form_page.php">Click here to fill out our form.</a></p>
    </div>
<?php else: ?>
    <div class="form-section">
        <center><h2>Login</h2></center>
        <form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <label>
        <input type="checkbox" name="remember" id="remember"> Remember Me
    </label>

    <button type="submit">Log In</button>
</form>
        <?php if ($loginError) echo "<p class='error'>$loginError</p>"; ?>
    </div>
<?php endif; ?>

    <script src="script.js"></script>
</body>
</html>