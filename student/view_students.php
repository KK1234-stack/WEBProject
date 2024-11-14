<?php
// Include database connection
include "connect.php";  // Make sure this path is correct

// Check if the connection is successful
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all students from the students table
$query = "SELECT * FROM student";
$result = mysqli_query($db, $query);

// Check if there are any students in the table
if (mysqli_num_rows($result) > 0) {
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $students = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
        }

        th, td {
            padding: 12px 20px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #dcdfe1;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px 0;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Navbar Styles */
        header {
            background-color: #343a40;
            color: white;
            height: 90px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .logo h1 {
            font-size: 25px;
            margin: 0;
            color: white;
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
            font-weight: bold;
            font-size: 16px;
        }

        nav a:hover {
            background-color: #ff5722;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <h1>Library System</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="view_students.php">Students</a></li>
            <li><a href="manage_books.php">Manage Books</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h2>All Students</h2>

    <?php if (count($students) > 0): ?>
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Roll No</th>
                <th>Email</th>
            </tr>

            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['first']); ?></td>
                    <td><?php echo htmlspecialchars($student['last']); ?></td>
                    <td><?php echo htmlspecialchars($student['username']); ?></td>
                    <td><?php echo htmlspecialchars($student['password']); ?></td>
                    <td><?php echo htmlspecialchars($student['roll']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No students found in the database.</p>
    <?php endif; ?>
</div>

</body>
</html>
