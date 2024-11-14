<?php
session_start();
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Student Login - Online Library Management System">
    <title>Student Login</title>

    <!-- Link to external CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
    
    <style>
        /* Custom Inline Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #000;
            color: white;
            height: 90px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .logo h1 {
            font-size: 25px;
            word-spacing: 10px;
            margin: 0;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px;
        }

        nav a:hover {
            background-color: #444;
        }

        section {
            background-image: url('img4.png'); /* Background image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box1 {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 30px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            border-radius: 10px;
        }

        .box1 h1 {
            font-family: 'Lucida Console', Monaco, monospace;
            color: white;
        }

        .login input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .login button {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .login button:hover {
            background-color: #218838;
        }

        p {
            color: white;
            font-size: 16px;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>
    <header>
        <div class="logo">
            <h1>ONLINE LIBRARY MANAGEMENT SYSTEM</h1>
        </div>

        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="books.php">BOOKS</a></li>
                <li><a href="student_login.php">STUDENT-LOGIN</a></li>
                <li><a href="">FEEDBACK</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="box1">
            <h1>Library Management System</h1>
            <h1>User Login Form</h1>

            <form name="login" action="" method="POST">
                <div class="login">
                    <input type="text" name="username" placeholder="Username" required><br>
                    <input type="password" name="password" placeholder="Password" required><br>
                    <button type="submit" name="login">Login</button>
                </div>
            </form>

            <p>
                <a href="">Forgot password?</a> &nbsp; &nbsp;
                New to this website? <a href="registration.php">Sign Up</a>
            </p>
        </div>
    </section>

    <?php
    // Check if the login button is pressed
    if (isset($_POST['login'])) {
        // Get the form data and escape it to prevent SQL injection
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        // Check if the username and password match any record in the student table
        $query = "SELECT * FROM student WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($db, $query);

        // Check if the query found any matching rows
        if (mysqli_num_rows($result) > 0) {
            // Store the username in the session
            $_SESSION['username'] = $username;

            // Redirect to the logged-in homepage
            header("Location: index_loggedin.php");
            exit();
        } else {
            // If login fails, show the error message with alert
            echo "<script>alert('Invalid username or password');</script>";
        }
    }
    ?>
</body>

</html>
