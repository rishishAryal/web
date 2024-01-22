<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "noteWeb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CRUD operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a new note
    if (isset($_POST["create_note"])) {
        $note_content = $_POST["note_content"];
        $sql = "INSERT INTO user_note (content) VALUES ('$note_content')";
        $conn->query($sql);
    }

    // Update a note
    if (isset($_POST["update_note"])) {
        $note_id = $_POST["note_id"];
        $note_content = $_POST["note_content"];
        $sql = "UPDATE user_note SET content='$note_content' WHERE id=$note_id";
        $conn->query($sql);
    }

    // Delete a note
    if (isset($_POST["delete_note"])) {
        $note_id = $_POST["note_id"];
        $sql = "DELETE FROM user_note WHERE id=$note_id";
        $conn->query($sql);
    }
}

// Retrieve all notes
$sql = "SELECT * FROM user_note";
$result = $conn->query($sql);
$notes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    /* height: 100vh; */
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex; /* Add display flex to make the form and notes side by side */
}

.form-container {
    flex: 1; /* Make the form container take up the available space */
    padding-right: 20px; /* Add some right padding for spacing */
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 200;
}

label {
    margin-bottom: 8px;
}

textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 12px;
}

.notes-container {
    flex: 1; /* Make the notes container take up the available space */
}

.note {
    background-color: #f9f9f9;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 8px;
}

.delete-button {
    background-color: #e74c3c;
}

    </style>
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Create a Note</h2>
            <label for="note_content">Note Content:</label>
            <textarea id="note_content" name="note_content" required></textarea>
            <button type="submit" name="create_note">Create Note</button>
        </form>
        <div>
            <h2>Notes</h2>
        <?php
        foreach ($notes as $note) {
            echo '<div class="note">';
            echo '<p>' . $note["content"] . '</p>';
            echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
            echo '<input type="hidden" name="note_id" value="' . $note["id"] . '">';
            echo '<label for="note_content">Update Note:</label>';
            echo '<textarea id="note_content" name="note_content" required>' . $note["content"] . '</textarea>';
            echo '<button type="submit" name="update_note">Update Note</button>';
            echo '<button type="submit" name="delete_note" class="delete-button">Delete Note</button>';
            echo '</form>';
            echo '</div>';
        }
        ?>
        </div>
        
    </div>
</body>
</html>
