<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $number = htmlspecialchars(trim($_POST['number']));
    $message = htmlspecialchars(trim($_POST['message']));

    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($number)) {
        $errors[] = "Contact number is required.";
    } elseif (!preg_match("/^[0-9]{10}$/", $number)) {
        $errors[] = "Contact number must be 10 digits.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    }

    if (!empty($errors)) {
        echo "<p>There were errors in your submission:</p>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Thank you, <strong>$name</strong>. Your message has been received.</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Contact Number: $number</p>";
        echo "<p>Message: $message</p>";
    }
}
?>
