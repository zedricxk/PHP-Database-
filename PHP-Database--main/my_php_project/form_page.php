<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .form-section {
            width: 100%;
            max-width: 600px;
            background-color: white;
            padding: 30px;
            margin: 50px auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="tel"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        form button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        form button[type="submit"]:hover {
            background-color: #45a049;
        }

        #formFeedback {
            margin-top: 20px;
            font-size: 1.1em;
            color: #333;
        }

        #formFeedback ul {
            list-style-type: none;
            padding-left: 0;
        }

        #formFeedback ul li {
            color: red;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<header>
    <h1>Contact Us</h1>
    <p>Please fill out the form below to get in touch with us</p>
</header>

<div class="form-section">
    <form id="contactForm">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="number">Contact Number:</label>
        <input type="tel" name="number" id="number" required>

        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea>

        <button type="submit">Submit</button>
    </form>

    <div id="formFeedback"></div>
</div>

<script>
    $(document).ready(function(){
        $('#contactForm').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: 'process_form.php',
                type: 'POST',
                data: formData,
                success: function(response){
                    $('#formFeedback').html(response);
                    $('#contactForm')[0].reset();
                },
                error: function(){
                    $('#formFeedback').html('<p>An error occurred. Please try again.</p>');
                }
            });
        });
    });
</script>

<div class="link-section">
        <p>back to the homepage<a href="index.php"> Click Here</a></p>
    </div>

</body>
</html>
