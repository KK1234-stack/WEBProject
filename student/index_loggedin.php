<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Library Management System">
    <title>Online Library Management System</title>
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
        .mySlides { display: none; width: 100%; height: 100%; }
        .fade { animation: fadeEffect 3s ease-in-out infinite; }
        @keyframes fadeEffect { 0%, 100% { opacity: 0; } 50% { opacity: 1; } }

        /* Add animation and style to the welcome message */
        .welcome-message h2 {
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
                <li><a href="index_loggedin.php">Home</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="feedback.php">Feedback</a></li> <!-- Added Feedback link -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Welcome Message for Logged-In Users -->
    <div class="welcome-message">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    </div>

    <!-- Main Section -->
    <section>
        <div class="sec_img">
            <div class="slideshow-container">
                <img class="mySlides fade" src="img6.png" alt="Library Image 1">
                <img class="mySlides fade" src="img2.png" alt="Library Image 2">
                <img class="mySlides fade" src="img5.png" alt="Library Image 3">
            </div>
            <div class="box">
                <h1>Welcome to the Library</h1>
                <h2>Opens at: 09:00 AM</h2>
                <h2>Closes at: 09:00 PM</h2>
            </div>
        </div>
    </section>

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
        setTimeout(showSlides, 3000);
    }
</script>

</body>
</html>
