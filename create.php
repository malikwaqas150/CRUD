<?php
include_once 'db_connection.php';
// Number of items per page
$itemsPerPage = 5;
// Determine the current page
if (isset($_GET['page']) && is_numeric($_GET['page']))
{
$currentPage = intval($_GET['page']);
}
else 
{
$currentPage = 1;
}
// Determine the search term
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
// Calculate the offset for the SQL query
$offset = ($currentPage - 1) * $itemsPerPage;
// Modify the SELECT query with a WHERE clause for searching
$sql = "SELECT * FROM items WHERE name LIKE '%$searchTerm%' ORDER BY id DESC LIMIT $itemsPerPage OFFSET $offset";
$result = $conn->query($sql);
// Fetch all rows for total count with the same WHERE clause
$totalRowsResult = $conn->query("SELECT COUNT(*) as total FROM items WHERE name LIKE '%$searchTerm%'");
$totalRowsData = $totalRowsResult->fetch_assoc();
$totalRows = $totalRowsData['total'];
// Calculate the total number of pages
$totalPages = ceil($totalRows / $itemsPerPage);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="styles.css">
<title>CRUD Data </title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <title >PHP CRUD Example</title>
    <style> body
    {  margin: 0; padding: 0;  
    
}

</style>
</head>
<body>
    <div class="container-xl table-responsive table-wrapper col-sm-6">
    <h2 class="modal-title">Add Product</h2>
    <div class="modal-body">
    <form method="POST" action="process.php" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="123">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" required>
    <br>
    <label for="description">Description:</label>
    <textarea type="text" class="form-control" name="description" rows="1" id="description" required></textarea>
    <br>
    <div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-danger" type="button">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                    <input type="text" class="form-control" name="new_row[]" id="new_row_1">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button class="btn btn-danger" type="button">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                    <input type="text" class="form-control" name="new_row[]" id="new_row_2">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="newinput"></div>
            <button id="rowAdder" type="button" class="btn btn-dark">
                <span class="bi bi-plus-square-dotted"></span> ADD Field
            </button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#rowAdder").click(function () {
            var newRowAdd =
                '<div class="row">' +
                '<div class="col-lg-6"> <div class="form-group">' +
                '<div class="input-group">' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-danger DeleteRow" type="button">' +
                '<i class="bi bi-trash"></i> Delete</button> </div>' +
                '<input type="text" class="form-control" name="new_row[]"> </div> </div> </div>' +
                '<div class="col-lg-6"> <div class="form-group">' +
                '<div class="input-group">' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-danger DeleteRow" type="button">' +
                '<i class="bi bi-trash"></i> Delete</button> </div>' +
                '<input type="text" class="form-control" name="new_row[]"> </div> </div> </div>' +
                '</div>';

            $('#newinput').append(newRowAdd);
        });

        $("body").on("click", ".DeleteRow", function () {
            $(this).closest(".row").remove();
        });
    });
</script>




    <b>
    <label for="status">Status</label>
    </b>
    <br>
    <!-- Radio buttons for status -->
    <input type="radio" name="status" value="1" checked>Yes</input>
    <br>
    <input type="radio" name="status" value="0">No</input>
    <br>
    <!-- Checkboxes for tags -->
    <input type="checkbox" name="tags[]" value="Budget-friendly">Budget-friendly</input>
    <br>
    <input type="checkbox" name="tags[]" value="New Product">New Product</input>
    <br>
    <input type="checkbox" name="tags[]" value="Used Product">Used Product</input>
    <br>
    
    <!-- File input for product image -->
    <label for="fileUpload"><b>Products images</b></label>
    <br>
    <?php
// Assuming you have already included your database connection file and executed the query to fetch the row

// Fetch the row from the database
$row = $result->fetch_assoc();

// Extract the 'id' value from the row
$id = $row['id'];
?>

<!-- Use the fetched id in your HTML input element -->
<input type="file" name="image[]" multiple id="<?php echo ($row["id"]); ?>">

   
    <br>
    <br>
    <input type="submit" class="btn btn-success" name="submit" value="Submit">
    <!-- Submit button -->
    <!-- <input type="submit" class="btn btn-success" value="Add Product"> -->
</form>

    </div>
    </div>
 
</body>
</html>
