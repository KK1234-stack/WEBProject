<?php
include "navbar.php";
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Student Registration - Online Library Management System">
    <title>Student Registration</title>

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
            background-image: url('img9.png'); /* Background image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box2 {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px;
            width: 90%;
            max-width: 450px;
            text-align: center;
            border-radius: 10px;
        }

        .box2 h1 {
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
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .login button:hover {
            background-color: #0056b3;
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
                <li><a href="student_login.php">STUDENT LOGIN</a></li>
                <li><a href="registration.php">REGISTRATION</a></li>
                <li><a href="feedback.php">FEEDBACK</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <div class="box2">
            <h1>Library Management System</h1>
            <h1>User Registration Form</h1>

            <form name="Registration" action="" method="POST">
                <div class="login">
                    <input type="text" name="first" placeholder="First Name" required><br><br>
                    <input type="text" name="last" placeholder="Last Name" required><br><br>
                    <input type="text" name="username" placeholder="Username" required><br><br>
                    <input type="password" name="password" placeholder="Password" required><br><br>
                    <input type="text" name="roll" placeholder="Roll No" required><br><br>
                    <input type="text" name="email" placeholder="Email" required><br><br>

                    <button type="submit" name="submit">Sign Up</button>
                </div>
            </form>
        </div>
    </section>

    <?php
    if(isset($_POST['submit'])){
        // Check if the username already exists
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $check_query = "SELECT * FROM student WHERE username = '$username'";
        $result = mysqli_query($db, $check_query);

        if(mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username already exists. Please choose a different username.');</script>";
        } else {
            // Insert new user into the database
            $query = "INSERT INTO student (first, last, username, password, roll, email) 
                      VALUES ('$_POST[first]', '$_POST[last]', '$username', '$_POST[password]', '$_POST[roll]', '$_POST[email]')";
            
            if (mysqli_query($db, $query)) {
                echo "<script>alert('Registration successful!'); window.location.href = 'student_login.php';</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($db) . "');</script>";
            }
        }
    }
    ?>
</body>

</html>
