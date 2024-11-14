<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Library Management System">
    <meta name="keywords" content="library, books, student login, admin login, online library">
    <meta name="author" content="Richard Clark">
    <title>Online Library Management System</title>

    <!-- Link to external CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Fullscreen background image extending through entire page */
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            background: url('library_bg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        /* Header styling with translucent background */
        header {
            background: rgba(0, 0, 0, 0.8);
            padding: 1em;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 100;
        }

        .logo h1 {
            font-size: 24px;
            color: #f0db4f;
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        /* Navbar styling */
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav ul li {
            display: inline-block;
        }

        nav ul li a {
            color: #f0db4f;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffd700;
        }

        nav ul li a i {
            margin-right: 8px;
        }

        /* Slideshow container styling */
        .slideshow-container {
            position: relative;
            max-width: 100%;
            height: 80vh;
            overflow: hidden;
        }

        .mySlides {
            display: none;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.7);
        }

        /* Translucent overlay for text content */
        .box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.6);
            padding: 2em;
            border-radius: 15px;
            text-align: center;
            color: #f0db4f;
            animation: fadeInBox 1.5s ease-in-out;
        }

        .box h1, .box h2 {
            margin: 0.5em 0;
        }

        /* Footer styling */
        footer {
            text-align: center;
            padding: 1em;
            background: rgba(0, 0, 0, 0.8);
            color: #f0db4f;
            font-size: 0.9em;
            width: 100%;
        }

        footer a {
            color: #f0db4f;
            text-decoration: none;
        }

        /* Animation for the box */
        @keyframes fadeInBox {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
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
                    <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="books.php"><i class="fas fa-book"></i> Books</a></li>
                    <li><a href="student_login.php"><i class="fas fa-user"></i> Student Login</a></li>
                    <li><a href="admin_login.php"><i class="fas fa-user-shield"></i> Admin Login</a></li>
                    <li><a href="feedback.php"><i class="fas fa-comments"></i> Feedback</a></li>
                </ul>
            </nav>
        </header>

        <!-- Main Section -->
        <section>
            <!-- Slideshow container -->
            <div class="slideshow-container">
                <img class="mySlides fade" src="img6.png" alt="Library Image 1">
                <img class="mySlides fade" src="img2.png" alt="Library Image 2">
                <img class="mySlides fade" src="img5.png" alt="Library Image 3">

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
        // JavaScript to control the slideshow
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

        // Adding smooth fade-in effect for the page load
        window.addEventListener('load', () => {
            document.body.style.transition = "opacity 1s";
            document.body.style.opacity = 1;
        });
    </script>

</body>

</html>
