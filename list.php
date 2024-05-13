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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="/fancybox/jquery.easing-1.4.pack.js"></script>
<script type="text/javascript" src="/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<link rel="stylesheet" href="/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script src="fancybox.umd.js"></script>
<link rel="stylesheet" href="fancybox.css" />
<title>CRUD Data</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
 <div class="container-xl">
 <div class="table-responsive">
<div class="table-wrapper">
 <div class="table-title">
 <div class="row">
 <div class="col-sm-3">
         <h2>Manage <b>Products</b>
         </h2>
     </div>
     <div class="col-sm-2">
         <form method="GET" action="">
             <b> Search : </b><input type="text" name="search" id="search" value="<?php echo htmlentities($searchTerm); ?>">
             <button type="submit" class="btn btn-secondary">
             <i class="material-icons">&#xe8b6;</i><span>Search</span></button>
         </form>
     </div>
 <div class="col-sm-6">
 <a href="create.php" class="btn btn-success"><i class="material-icons">&#xE147;</i>
 <span> Add New Product</span></a>
 <span> <a href="list.php" class="btn btn-success btn-lg">Reset</a></span>
 </div>
 </div>
 </div>
 <table class="table table-striped table-hover">
 <thead>
  <tr>
  <th><span>ID</span></th>
  <th>Name</th>
  <th>Description</th>
  <th>Date</th>
  <th>Categories</th>
  <th>Extra Features</th>
  <th>Product image</th>

  <th>Actions</th>
  </tr>
 </thead>
<tbody>
<?php while ($row = $result->fetch_assoc()):?>
<tr>
<td><span><?php echo ($row["id"]); ?></span></td>
<td><?php echo ($row["name"]); ?>
</td>
<td><?php echo ($row["description"]); ?></td>
<td><?php echo ($row["created_date"]); ?></td>
<td>
<?php echo ($row["tags"]); ?> 
</td>
<td>
<?php echo ($row["new_row"]); ?> 
</td>
<td >     
<a  href="uploads/<?php echo $row["product_image"]; ?>">
<img class="imageHover" src="uploads/<?php echo $row["product_image"]; ?>" alt="Image" width="50" style="object-fit: cover; cursor: pointer;" />
</a>
</td>
<td>
<a href="edit.php?id=<?php echo $row['id']; ?>"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
<a href="remove.php?id=<?php echo $row['id']; ?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
 </div>
 </div>
 <div class="clearfix">
 <div class="hint-text col-md-3">
 <b>Showing <b><?php echo min($itemsPerPage, $totalRows); ?></b> out of <b><?php echo $totalRows; ?></b> <b>
 entries</b>
</div>
 <ul class="pagination col-sm-6">
 <li class="page-item "><a class="page-link" href="?page=<?php echo max($currentPage - 1, 1) . '&search=' . $searchTerm; ?>">Previous</a></li>
 <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
 <li class="page-item <?php echo ($currentPage == $page) ? 'active' : ''; ?>">
 <a href="?page=<?php echo $page . '&search=' . $searchTerm; ?>" class="page-link"><?php echo $page; ?></a>
</li>
<?php endfor; ?>
<li class="page-item">
<a class="page-link" href="?page=<?php echo min($currentPage + 1, $totalPages) . '&search=' . $searchTerm; ?>">Next</a>
</li>
</ul>
</div>
</div>
</div>
</div>

</body>
</html>