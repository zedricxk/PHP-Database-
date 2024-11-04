<?php
if (isset($_GET['name']) && isset($_GET['email'])) {
    $name = htmlspecialchars($_GET['name']);
    $email = htmlspecialchars($_GET['email']);

    echo "Name: " . $name . "<br>";
    echo "Email: " . $email;
} else {
    echo "No data received.";


}
session_start();
include 'header.php'; 
?>

<!-- Your form content goes here -->

?>
