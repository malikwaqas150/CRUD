<?php
include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set in the $_POST array
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['updated_date']) && isset($_POST['tags'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $description = $conn->real_escape_string($_POST['description']);
        $updated_date = $conn->real_escape_string($_POST['updated_date']);
        $existing_image = $conn->real_escape_string($_POST['product_image']);
        
        // Escape each tag in the tags array
        $tags = array_map(function($tag) use ($conn) {
            return $conn->real_escape_string($tag);
        }, $_POST['tags']);

        // Convert the escaped tags array into a comma-separated string
        $tags_string = implode(',', $tags);

        // Ensure $id is set before using it
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        
            // Check if a new image file is uploaded
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) 
              {
          // Upload the new image file
          $targetDirectory = "uploads/";
          $targetFile = $targetDirectory . basename($_FILES["product_image"]["name"]);   
          if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
              // Replace the existing image file with the new one
              if (!empty($existing_image) && file_exists($existing_image)) 
              {
              unlink($existing_image); // Delete the existing image file
              }
              $image_file = basename($_FILES["product_image"]["name"]);
              }
           else
            {
              echo "Sorry, there was an error uploading your image file.";
              exit();
          }
        } 
            else
             {
                // No new image file uploaded, keep the existing image filename
                $image_file = $existing_image;
              }
             
            // Update the record in the database
            $sql = "UPDATE items SET name='$name', description='$description', 
            updated_date='$updated_date', product_image='$existing_image', tags='$tags_string' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                header('Location:list.php');
                exit();
            }
             else {
                echo "Error updating record: " . $conn->error;
            }
        } 
        else
         {
            echo "Invalid ID.";
        }
    } 
    else {
        echo "Invalid form data.";
    }


{
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
