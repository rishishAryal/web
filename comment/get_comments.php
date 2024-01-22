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

// Retrieve comments from the database
$sql = "SELECT * FROM comments";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Output comments as HTML
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>{$row['text']}</p>";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
