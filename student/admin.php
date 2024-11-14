<?php
// Start session to track logged-in admin
session_start();

// Check if admin is logged in, if not, redirect to login page
if (!isset($_SESSION['admin_username'])) {
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Panel - Online Library Management System">
    <meta name="keywords" content="library, admin, student management, books management">
    <meta name="author" content="Richard Clark">
    <title>Admin Panel - Online Library Management System</title>

    <link rel="stylesheet" href="style.css">

    <style>
        /* Add CSS for the slideshow */
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

        .welcome-message {
            font-size: 3em;
            color: #333;
            text-align: center;
            margin-top: 50px;
            animation: welcomeAnimation 1.5s ease-out;
        }

        /* Animation for the welcome message */
        @keyframes welcomeAnimation {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            50% {
                opacity: 1;
                transform: translateY(0);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Admin dashboard container */
        .admin-dashboard {
            margin-top: 20px;
            text-align: center;
        }

        .admin-dashboard ul {
            list-style: none;
            padding: 0;
        }

        .admin-dashboard li {
            margin: 10px;
            font-size: 1.5em;
        }

        .admin-dashboard a {
            color: #28a745;
            text-decoration: none;
        }

        .admin-dashboard a:hover {
            text-decoration: underline;
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
        <nav>
            <ul>
                <li><a href="admin.php">Home</a></li>
                <li><a href="manage_books.php">Manage Books</a></li>
                <li><a href="view_students.php">View Students</a></li>
                <li><a href="admin_signup.php">Add Admin</a></li> <!-- Link to Admin Signup -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Welcome Message for Admin -->
    <div class="welcome-message">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</h2>
    </div>

    <!-- Main Section -->
    <section>
        <div class="sec_img">
            <!-- Slideshow container -->
            <div class="slideshow-container">
                <img class="mySlides fade" src="img6.png" alt="Library Image 1">
                <img class="mySlides fade" src="img2.png" alt="Library Image 2">
                <img class="mySlides fade" src="img5.png" alt="Library Image 3">
            </div>

            <div class="box">
                <h1>Admin Dashboard</h1>
                <p>Manage the library and users effectively.</p>
            </div>
        </div>
    </section>

    <!-- Admin Dashboard -->
    <div class="admin-dashboard">
        <ul>
            <li><a href="manage_books.php">Manage Books</a></li>
            <li><a href="view_students.php">View Registered Students</a></li>
            <li><a href="add_book.php">Add New Book</a></li>
            <li><a href="feedback.php">View Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Footer -->
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
