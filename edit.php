<?php
include_once 'db_connection.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $result = $conn->query("SELECT * FROM items WHERE id = $id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $description = $row['description'];
        $tags = $row['tags'];
        $updated_date = $row['updated_date'];
        $product_image = $row['product_image'];
    } else {
        echo "Record not found.";
        exit;
    }
} else {
    echo "<b>Invalid ID.</b>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle uploaded image
    if (isset($_FILES["product_image"])) {
        $file_name = $_FILES["product_image"]["name"];
        $file_temp = $_FILES["product_image"]["tmp_name"];
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    
        // Generate a unique ID for the image filename
        $product_image = uniqid() . "." . $file_extension;
    
        // Move the uploaded file to a desired directory with the new filename
        $upload_directory = "uploads/";
        $target_path = $upload_directory . $product_image;
    
        if (move_uploaded_file($file_temp, $target_path)) {
            // File uploaded successfully
            echo "File uploaded successfully.";
            
            // Update the database record with the new image filename
            $conn->query("UPDATE items SET product_image = '$product_image' WHERE id = $id");
        } else {
            echo "Error uploading file.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="styles.css">
<title>CRUD Data</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div>
<div class="modal-dialog">
<div class="modal-content">
<form action="update.php" method="POST" enctype="multipart/form-data">
    <div class="modal-header">                        
        <h4 class="modal-title">Edit Product</h4>
        <a href="list.php">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </a>
    </div>
<div class="modal-body">                    
<div class="form-group">
<label>Name</label>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" required>
</div>
<div class="form-group">
<label>Description</label>
<textarea class="form-control" name="description" id="description" rows="5" required><?php echo $description; ?></textarea>
</div>
<div class="form-group">
<label>Date</label>
<input type="date" class="form-control" name="updated_date" id="" value="<?php echo $updated_date; ?>">
<label for="fileUpload"><b>Update image</b></label>
    <br>
    <input type="checkbox" name="tags[]" value="budget-friendly">Budget-friendly</input>
    <br>
    <input type="checkbox" name="tags[]" value="New Product">New Product</input>
    <br>
    <input type="checkbox" name="tags[]" value="Used Product">Used Product</input>
    <br><br>
    <input type="file" name="product_image" id="product_image" accept="image/*" >
   <br>

   <a  href="uploads/<?php echo $row["product_image"]; ?>">  
   <br>
   <img src="uploads/<?php echo $row["product_image"]; ?>" alt="Image" width="70px" style="object-fit:cover; cursor: pointer;" />
   <br><br>

<input type="hidden" name="existing_image" value="<?php echo $row['product_image']; ?>">

<input type="hidden" name="product_image"  value="<?php echo $product_image; ?>">
     </div>                    
 </div>
 <div class="modal-footer">
     <a href="list.php" class="btn btn-default">
 <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" >
 </a>
 <input type="submit" class="btn btn-info" value="Save">
 </div>
</form>
    </div>
</div>
</div>
</body>
</html>
