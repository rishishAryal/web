<?php
// Include your database connection file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "comment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the comment from the POST data
    $comment = $_POST['comment'];

    // Validate and sanitize the comment (you may want to improve this)
    $comment = htmlspecialchars($comment);

    // Insert the comment into the database
    $sql = "INSERT INTO comments (text) VALUES ('$comment')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Output the new comment as HTML
        echo "<p>$comment</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}