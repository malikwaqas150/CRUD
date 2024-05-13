<?php
// Include your database connection file (db_connection.php)
include_once 'db_connection.php';
// Assume you have the record ID from somewhere (e.g., fetched from the database)
$id = isset($_GET['id']) ? $_GET['id'] : null;
// Fetch the existing record details if $id is provided
if ($id !== null) {
$result = $conn->query("SELECT * FROM items WHERE id = $id");
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$name = $row['name'];
$description = $row['description'];
$updated_date = $row['updated_date'];
} else {
echo "Record not found.";
exit;
}
}
 else {
echo "Invalid ID.";
exit;
}
?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="styles.css">
<title>Delete Data</title>
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
<form action="delete.php" method="POST">
 <div class="modal-header">                        
<h4 class="modal-title">Delete Product</h4>
<a href="list.php">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</a>
 </div>
 <div class="modal-body">                    
 <p>Are you sure you want to delete these Records?</p>
 <p class="text-warning"><small>This action cannot be undone.</small></p>
 
 <!-- Add a hidden input for 'id' -->
     <input type="hidden" name="id" value="<?php echo $id; ?>">
 </div>
 <div class="modal-footer">
<a href="list.php" class="btn btn-default">
<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
</a>
<input type="submit" class="btn btn-danger" value="Delete">
 </div>
</form>
</div>
</div>
</div>
</body>
</html>
