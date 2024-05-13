<?php
include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form field 'id' is set in the $_POST array
    if (isset($_POST['id'])) {
        // Sanitize the ID to prevent SQL injection
        $id = $conn->real_escape_string($_POST['id']);

        // Delete the record from the database
        $sql = "DELETE FROM items WHERE id = '$id'";
        echo "SQL Query: $sql";

        if ($conn->query($sql) === TRUE) {
           header('Location:list.php');
        } 
        else {
            echo "Error deleting record: " . $conn->error;
        }
    }
     else {
        echo "Invalid ID.";
    }
} 
else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
