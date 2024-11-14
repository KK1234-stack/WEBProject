<?php
session_start();

// Check if admin is already logged in
if (isset($_SESSION['admin_username'])) {
    header("Location: admin.php");
    exit();
}

// Include database connection
require_once 'connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    
    // Check if admin exists in the database
    $query = "SELECT * FROM admins WHERE username = '$username'";
    $result = mysqli_query($db, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_username'] = $username;
            header("Location: admin.php");
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "Admin not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Login - Online Library Management System">
    <meta name="keywords" content="library, admin, login">
    <meta name="author" content="Richard Clark">
    <title>Admin Login - Online Library Management System</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* Add CSS for Login Page */
        .login-container {
            width: 100%;
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }

        .login-container label {
            display: block;
            margin: 10px 0 5px;
            font-size: 1.1em;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #218838;
        }

        .login-container .error-message {
            color: red;
            text-align: center;
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        /* Similar to previous design */
        .slideshow-container {
            position: relative;
            max-width: 100%;
            height: 400px;
            overflow: hidden;
            margin: auto;
        }

        .mySlides {
            display: none;
            width: 100%;
            height: 100%;
        }

        .fade {
            animation: fadeEffect 3s ease-in-out infinite;
        }

        @keyframes fadeEffect {
            0%, 100% { opacity: 0; }
            50% { opacity: 1; }
        }

    </style>
</head>

<body>

<div class="wrapper">

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="img3.png" alt="Library Logo">
            <h1>Online Library Management System</h1>
        </div>
    </header>

    <!-- Admin Login Form -->
    <div class="login-container">
        <h2>Admin Login</h2>

        <?php
        if (isset($error_message)) {
            echo "<div class='error-message'>$error_message</div>";
        }
        ?>

        <form action="admin_login.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>

    <!-- Slideshow for images (similar to previous pages) -->
    <div class="slideshow-container">
        <img class="mySlides fade" src="img6.png" alt="Library Image 1">
        <img class="mySlides fade" src="img2.png" alt="Library Image 2">
        <img class="mySlides fade" src="img5.png" alt="Library Image 3">
    </div>

    <footer>
        <p>Contact Us:</p>
        <p>Email: <a href="mailto:online.library@gmail.com">online.library@gmail.com</a></p>
        <p>Phone: <a href="tel:+16239981016">+1 623-998-1016</a></p>
    </footer>

</div>

<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let slides = document.getElementsByClassName("mySlides");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1; }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 3000); // Change image every 3 seconds
    }
</script>

</body>
</html>
