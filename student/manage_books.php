<?php
// Include connection and navbar
include "connect.php";  // Ensure this path is correct
include "navbar.php";    // This will include the navbar.php file

// Handle adding a new book
if (isset($_POST['add_book'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $authors = mysqli_real_escape_string($db, $_POST['authors']);
    $edition = mysqli_real_escape_string($db, $_POST['edition']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);
    $department = mysqli_real_escape_string($db, $_POST['department']);

    // Check if a book with the same name and authors already exists
    $check_query = "SELECT * FROM `books` WHERE `name` = '$name' AND `authors` = '$authors'";
    $check_result = mysqli_query($db, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Book already exists, show error message
        $insert_error = "This book already exists in the database.";
    } else {
        // Insert the new book into the database
        $insert_query = "INSERT INTO `books` (`name`, `authors`, `edition`, `status`, `quantity`, `department`) 
                         VALUES ('$name', '$authors', '$edition', '$status', '$quantity', '$department')";

        if (mysqli_query($db, $insert_query)) {
            // Redirect to the books page after adding the book
            header("Location: manage_books.php");
            exit();
        } else {
            $insert_error = "Failed to add the book. Please try again.";
        }
    }
}

// Handle deleting a book
if (isset($_POST['delete_book'])) {
    $bid = mysqli_real_escape_string($db, $_POST['bid']);

    // Delete the book from the database
    $delete_query = "DELETE FROM `books` WHERE `bid` = '$bid'";

    if (mysqli_query($db, $delete_query)) {
        // Redirect to the books page after deletion
        header("Location: manage_books.php");
        exit();
    } else {
        echo "<script>alert('Failed to delete the book.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #e2c7b7;  /* Bluish Butterscotch color */
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 30px;
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
            background-color: #343a40; /* Darker header for contrast */
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

        /* Button Style */
        .btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px 0;
        }

        .btn:hover {
            background-color: #218838;
        }

        .error-message {
            color: red;
            text-align: center;
            font-size: 16px;
        }

        /* Navbar Styles */
        header {
            background-color: #ff7f50; /* Coral background for navbar */
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
            background-color: #ff5722; /* Darker shade on hover */
            border-radius: 5px;
        }

        /* Form Styles */
        .form-container {
            width: 60%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Books</h2>

    <?php
        // Check if the database connection is available
        if ($db) {
            // Query to fetch books
            $res = mysqli_query($db, "SELECT * FROM `books` ORDER BY `books`.`name` ASC");

            if (mysqli_num_rows($res) > 0) {
                // Display table if data exists
                echo "<table class='table table-bordered table-hover'>";
                    echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Book Name</th>";
                        echo "<th>Author's Name</th>";
                        echo "<th>Edition</th>";
                        echo "<th>Status</th>";
                        echo "<th>Quantity</th>";
                        echo "<th>Department</th>";
                        echo "<th>Action</th>";
                    echo "</tr>";

                // Loop through each row and display in table
                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                        echo "<td>" . $row['bid'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['authors'] . "</td>";
                        echo "<td>" . $row['edition'] . "</td>";
                        echo "<td>" . ($row['status'] == 1 ? 'Available' : 'Checked Out') . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>" . $row['department'] . "</td>";

                        // Admin action buttons (edit and delete)
                        echo "<td>
                                <form method='POST' action=''>
                                    <input type='hidden' name='bid' value='" . $row['bid'] . "'>
                                    <button type='submit' name='delete_book' class='btn btn-danger'>Delete</button>
                                </form>
                              </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='error-message'>No books found in the database.</p>";
            }
        } else {
            echo "<p class='error-message'>Failed to connect to the database.</p>";
        }
    ?>

    <!-- Form to Add a New Book -->
    <div class="form-container">
        <h3>Add New Book</h3>

        <form method="POST" action="">
            <input type="text" name="name" placeholder="Book Name" required><br>
            <input type="text" name="authors" placeholder="Author's Name" required><br>
            <input type="text" name="edition" placeholder="Edition" required><br>
            <select name="status" required>
                <option value="">Select Status</option>
                <option value="1">Available</option>
                <option value="0">Checked Out</option>
            </select><br>
            <input type="number" name="quantity" placeholder="Quantity" required><br>
            <input type="text" name="department" placeholder="Department" required><br>

            <button type="submit" name="add_book">Add Book</button>
        </form>

        <!-- Error message for insert -->
        <?php
            if (isset($insert_error)) {
                echo "<p class='error-message'>$insert_error</p>";
            }
        ?>
    </div>
</div>

</body>
</html>
