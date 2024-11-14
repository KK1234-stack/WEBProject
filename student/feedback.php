<?php
  include "navbar.php";
  include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  
  <style type="text/css">
    /* General Styles */
    body {
      background-color: #1f1f1f; /* Dark background */
      font-family: 'Arial', sans-serif;
      color: #f1f1f1; /* Light text */
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .wrapper {
      max-width: 900px;
      margin: 50px auto;
      padding: 30px;
      background-color: #2c2c2c;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      color: #fff;
    }

    h4 {
      text-align: center;
      font-size: 22px;
      color: #fff;
      margin-bottom: 30px;
      font-weight: bold;
    }

    .form-control {
      width: 100%;
      padding: 15px;
      margin: 10px 0;
      border: 1px solid #333;
      border-radius: 5px;
      background-color: #444;
      color: #fff;
      font-size: 16px;
    }

    .form-control:focus {
      outline: none;
      border-color: #f39c12;
      background-color: #333;
    }

    .btn-submit {
      background-color: #f39c12;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      width: 100%;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-submit:hover {
      background-color: #e67e22;
    }

    .scroll {
      max-height: 400px;
      overflow-y: auto;
      margin-top: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background-color: #333;
    }

    table th, table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #444;
    }

    table th {
      background-color: #444;
      color: #f39c12;
    }

    table td {
      color: #ddd;
    }

    table tr:nth-child(even) {
      background-color: #555;
    }

    table tr:nth-child(odd) {
      background-color: #444;
    }

    table tr:hover {
      background-color: #666;
    }

    @media (max-width: 768px) {
      .wrapper {
        width: 95%;
        margin: 20px auto;
      }

      h4 {
        font-size: 18px;
      }
      
      .form-control, .btn-submit {
        font-size: 14px;
        padding: 12px;
      }
    }

  </style>
</head>
<body>

  <div class="wrapper">
    <h4>If you have any suggestions or questions, please comment below.</h4>

    <form action="" method="post">
      <input class="form-control" type="text" name="comment" placeholder="Write something..." required><br>
      <input class="btn-submit" type="submit" name="submit" value="Comment">
    </form>

    <div class="scroll">
      <?php
        // Ensure the connection is established
        if (isset($_POST['submit'])) {
          $comment = mysqli_real_escape_string($db, $_POST['comment']);
          $sql = "INSERT INTO `comments` (`comment`) VALUES ('$comment')";

          if (mysqli_query($db, $sql)) {
            // Fetch and display all comments
            $q = "SELECT * FROM `comments` ORDER BY `id` DESC";
            $res = mysqli_query($db, $q);

            echo "<table>";
            while ($row = mysqli_fetch_assoc($res)) {
              echo "<tr>";
                echo "<td>" . htmlspecialchars($row['comment']) . "</td>";
              echo "</tr>";
            }
            echo "</table>";
          } else {
            echo "<p style='color: red;'>Failed to submit comment. Please try again.</p>";
          }
        } else {
          // Fetch and display all comments if no new submission
          $q = "SELECT * FROM `comments` ORDER BY `id` DESC";
          $res = mysqli_query($db, $q);

          echo "<table>";
          while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>";
              echo "<td>" . htmlspecialchars($row['comment']) . "</td>";
            echo "</tr>";
          }
          echo "</table>";
        }
      ?>
    </div>
  </div>

</body>
</html>
