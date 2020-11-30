<?php
// Database configuration
include_once('db.php');



if(!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit(); 
}

if($debug) {
    print("<br/>_SESSION<pre>");
    print_r($_SESSION);
}

if(isset($_REQUEST['id'])) {
    $quy_del = "DELETE FROM  users WHERE ID = '". $_REQUEST['id'] ."'";

    if($debug) {
        echo "<br/>" . $quy_del;
    }

    mysqli_query($conn, $quy_del);
}

$sort_col = "id";
$sort_order = "ASC";
if(isset($_REQUEST['sort_col'])) {
    $sort_col = $_REQUEST['sort_col'];
}

if(isset($_REQUEST['sort_order'])) {
    $sort_order = $_REQUEST['sort_order'];
}



// Select users records
$query = "SELECT * 
          FROM 
          users WHERE 1 ";

if(isset($_REQUEST['str_search']) && $_REQUEST['str_search']  != '') {
    $query .= " AND (first_name like '%" . $_REQUEST['str_search'] . "%'";
    $query .= " OR last_name like '%" . $_REQUEST['str_search'] . "%'";
    $query .= " OR email like '%" . $_REQUEST['str_search'] . "%'";
    $query .= " OR address like '%" . $_REQUEST['str_search'] . "%')";
}          
          
if($sort_col == "name") {
    $query .= " ORDER BY first_name " . $sort_order . ", last_name " .  $sort_order;
}   
else {
    $query .= " ORDER BY " . $sort_col . " " . $sort_order;
} 

if($debug) {
    echo "<br/> Pagination Query" . $query;
}

$result = mysqli_query($conn, $query);
$total_no_of_rec = mysqli_num_rows($result);

if($debug) {
    print("<pre>");
    print_r($result);
}

$per_page  = 5;
$page = 1;
$record_form = 0;
if(isset($_REQUEST['page']) && $_REQUEST['page'] != '' && $_REQUEST['page'] > 1) {
    $record_form = ($_REQUEST['page'] - 1 )* $per_page;
    $record_form = $record_form;
}


$no_of_pages = ceil($total_no_of_rec / $per_page);



 $query .= " LIMIT ". $record_form . ", " . $per_page; 

$result = mysqli_query($conn, $query);

$total_no_of_rec = mysqli_num_rows($result);

?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">
  <!-- <link rel="stylesheet" href="css/styles.css?v=1.0"> -->
</head>

<body>
    <a align="right" href="logout.php" > Logout</a>
    <br/>
    <br/>
    <br/>
     <h1 align="center"> Users </h1>
     <h4 align="center"><?php echo $msg; ?></h4>
    
    <!-- <script src="js/scripts.js"></script> -->
    <input type="button" onclick='window.location.href = "add.php"' value="Add">
    <br/>
    <br/>
    <br/>

    <form name="frmSearch" method="post" id="frmSearch" action="user.php">
        <input type="text" name="str_search" value="<?php echo $_REQUEST['str_search'] ?? ''; ?>">
        <input type="submit" name="btnSearch" value="Search">
    </form>    

    <table style="width:100%" border="1">
        <tr>
            <th align="left"><?php
                
                if($sort_col == 'id' && $sort_order == 'ASC'){
                    $sort_order = "DESC";
                }
                else {
                    $sort_order = "ASC";
                }

                ?><a href="user.php?sort_col=id&sort_order=<?php echo $sort_order ?>">ID</a>
            </th>
            <th align="left"><?php
                
                if($sort_col == 'email' && $sort_order == 'ASC'){
                    $sort_order = "DESC";
                }
                else {
                    $sort_order = "ASC";
                }
                ?><a href="user.php?sort_col=email&sort_order=<?php echo $sort_order ?>">Email</a>
            </th>
            <th align="left"><?php
                
                if($sort_col == 'name' && $sort_order == 'ASC'){
                    $sort_order = "DESC";
                }
                else {
                    $sort_order = "ASC";
                }
                ?><a href="user.php?sort_col=name&sort_order=<?php echo $sort_order ?>">Name</a>
            </th>
            <th align="left"><?php
                
                if($sort_col == 'address' && $sort_order == 'ASC'){
                    $sort_order = "DESC";
                }
                else {
                    $sort_order = "ASC";
                }
                ?><a href="user.php?sort_col=address&sort_order=<?php echo $sort_order ?>">Address</a>
            </th>
            <th align="left"><?php
                
                if($sort_col == 'created_at' && $sort_order == 'ASC'){
                    $sort_order = "DESC";
                }
                else {
                    $sort_order = "ASC";
                }
                ?><a href="user.php?sort_col=created_at&sort_order=<?php echo $sort_order ?>">Created</a>
            </th>
            <th align="left">Created By</th>
            <th align="left">Last Updated</th>
            <th align="left">Updated By</th>
            <th align="left">Action</th>
        </tr><?php
        if($total_no_of_rec > 0){
            while($row = mysqli_fetch_assoc($result)){
                if($debug) {
                    print("row<pre>");
                    print_r($row);
                }
                ?><tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['first_name'] . ' ' . $row['last_name'];?></td>
                    <td><?php echo $row['address'];?></td>
                    <td><?php echo date($date_format, strtotime($row['created_at']));?></td>
                    <td><?php echo $row['created_by'];?></td>
                    <td><?php echo date($date_format, strtotime($row['updated_at']));?></td>
                    <td><?php echo $row['updated_by'] ;?></td>
                    <td><a href="edit.php?id=<?php echo $row['id'];?>">Edit</a> | <a href="user.php?id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure you want to delete this item')">Delete</a></td>
                </tr><?php
            } 
        }
        else {
            ?><tr>
                <td colspan="9" align="center">Currently, No record avaliable.</td>
            </tr><?php
        }
          
    ?></table>
    <a href="user.php?page=1">First</a><?php
    for($counter = 1; $counter <= $no_of_pages; $counter++) {
        ?>&nbsp;<a href="user.php?page=<?php echo $counter?>"><?php echo $counter?></a>&nbsp;<?php
    }   
    
    ?><a href="user.php?page=<?php echo $no_of_pages?>">Last</a>

</body>
</html>