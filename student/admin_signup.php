<?php
// Start session
session_start();

// Include database connection
require_once 'connect.php'; // Replace with your actual connection file

// Initialize error message variable
$error_message = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // Check if username already exists
    $checkQuery = "SELECT * FROM admins WHERE username = '$username'";
    $result = mysqli_query($db, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Username already exists
        $error_message = "Username already exists. Please choose a different one.";
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new admin into the database
        $insertQuery = "INSERT INTO admins (username, password, email) VALUES ('$username', '$hashed_password', '$email')";

        if (mysqli_query($db, $insertQuery)) {
            $_SESSION['admin_username'] = $username; // Log the admin in
            header("Location: admin.php"); // Redirect to admin dashboard
            exit();
        } else {
            $error_message = "Error creating admin account. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Signup - Online Library Management System">
    <meta name="keywords" content="library, admin, signup">
    <meta name="author" content="Richard Clark">
    <title>Admin Signup - Online Library Management System</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .signup-container {
            width: 100%;
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .signup-container h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }

        .signup-container label {
            display: block;
            margin: 10px 0 5px;
            font-size: 1.1em;
        }

        .signup-container input[type="text"],
        .signup-container input[type="password"],
        .signup-container input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        .signup-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1em;
            cursor: pointer;
        }

        .signup-container input[type="submit"]:hover {
            background-color: #218838;
        }

        .signup-container .error-message {
            color: red;
            text-align: center;
            font-size: 1.1em;
            margin-bottom: 20px;
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

        <!-- Admin Signup Form -->
        <div class="signup-container">
            <h2>Create Admin Account</h2>

            <?php
            if (!empty($error_message)) {
                echo "<div class='error-message'>$error_message</div>";
            }
            ?>

            <form action="admin_signup.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <input type="submit" value="Sign Up">
            </form>
        </div>

        <footer>
            <p>Contact Us:</p>
            <p>Email: <a href="mailto:online.library@gmail.com">online.library@gmail.com</a></p>
            <p>Phone: <a href="tel:+16239981016">+1 623-998-1016</a></p>
        </footer>

    </div>

</body>
</html>
