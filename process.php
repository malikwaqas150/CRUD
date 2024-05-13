<?php
include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle uploaded images
    if (isset($_FILES["image"])) {
        $upload_directory = "uploads/";

        // Loop through each file
        foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["image"]["name"][$key];
            $file_temp = $_FILES["image"]["tmp_name"][$key];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

            // Generate a unique ID for the image filename
            $product_image = uniqid() . "." . $file_extension;

            // Move the uploaded file to the desired directory with the new filename
            $target_path = $upload_directory . $product_image;

            if (move_uploaded_file($file_temp, $target_path)) {
                // File uploaded successfully
                echo "File $file_name uploaded successfully.<br>";

                // Example: Insert the data into the database
                $date = date("Y-m-d H:i:s");
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $status = (int)$_POST['status'];
                $created_date = $date;
                $updated_date = $date;

                // Handle dynamic fields (new_row)
                $new_row = $_POST['new_row'];
                $new_row_json = json_encode($new_row);

                if (isset($_POST['tags']) && !empty($_POST['tags'])) {
                    // Escape each selected option for security
                    $tags = array_map(function ($tag) use ($conn) {
                        return mysqli_real_escape_string($conn, $tag);
                    }, $_POST['tags']);
                    $tags_string = implode(',', $tags);
                } else {
                    $tags_string = "";
                }

                // Prepare data for JSON insertion
                $data = array(
                    'name' => $name,
                    'description' => $description,
                    'status' => $status,
                    'tags' => $tags_string,
                    'new_row' => $new_row_json,
                    'created_date' => $created_date,
                    'updated_date' => $updated_date,
                    'product_image' => $product_image
                );

                // Insert data into the database
                $sql = "INSERT INTO items (name, description, status, tags, new_row, created_date, updated_date, product_image)
                VALUES ('{$data['name']}', '{$data['description']}', '{$data['status']}', '{$data['tags']}', '{$data['new_row']}', 
                '{$data['created_date']}', '{$data['updated_date']}', '{$data['product_image']}')";

                if ($conn->query($sql) === TRUE) {
                    header('location:list.php');
                    echo "Data inserted successfully.<br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error uploading file $file_name.<br>";
            }
        }
    }
}
$conn->close();
?>
