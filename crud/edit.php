<?php

// Database configuration
include_once('db.php');
if(isset($_REQUEST['btnEdit'])){
    if($debug) {
        print("<pre>");
        print_r($_REQUEST);
    }

    $id = "";
    if(isset($_REQUEST['id'])) {
        $id =  $_REQUEST['id'];
    }

    $first_name = "";
    if(isset($_REQUEST['first_name'])) {
        $first_name =  $_REQUEST['first_name'];
    }
   
    $last_name = "";
    if(isset($_REQUEST['last_name'])) {
        $last_name =  $_REQUEST['last_name'];
    }


   $email = "";
    if(isset($_REQUEST['email'])) {
        $email =  $_REQUEST['email'];
    }

    $password = "";
    if(isset($_REQUEST['password'])) {
        $password =  $_REQUEST['password'];
    }

   $address = "";
   if(isset($_REQUEST['address'])) {
        $address =  $_REQUEST['address'];
   }

    $quy_ins = "UPDATE users 
                SET first_name = '". $first_name ."', 
                    last_name = '". $last_name ."',
                    email = '". $email ."',
                    password  = '". $password ."', 
                    address = '". $address ."'
                WHERE id = '" . $id ."'";

    $rec = mysqli_query($conn, $quy_ins);
    $msg = "Record Updated successfully";
    header('location:user.php?msg=' . $msg); 
    exit();
}

$user_id = "";
if(isset($_REQUEST['id'])) {
    $user_id =  $_REQUEST['id'];
}

if($user_id == "") {
    $msg = "Somethig goes wrong...";
    header('location:user.php?msg=' . $msg); 
    exit();
}

if($debug) {
    echo "<br/> User ID => " . $user_id;
}

$query = "SELECT * 
          FROM 
          users WHERE id = '". $user_id ."'";

if($debug) {
    echo "<br/>" . $query;
}

$result = mysqli_query($conn, $query);

$row = array();
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}
else {
    $msg = "Record not found.";
    header('location:user.php?msg=' . $msg); 
    exit();
}


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
     <h1 align="center">Edit User </h1>
    <!-- <script src="js/scripts.js"></script> -->
    <form name="frmEditUser" method="post" action="edit.php">
        <table align="center" border="1">
            <tr>
                <td>First name</td>
                <td><input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" ></td>                 
            </tr>
            <tr>
                <td>last name</td>
                <td><input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" ></td>                 
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $row['email']; ?>" ></td>                 
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" value="<?php echo $row['password']; ?>"></td>                 
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="confirm_password" value="<?php echo $row['password']; ?>"></td>                 
            </tr>
            <tr>
                <td>Addrerss</td>
                <td><textarea name="address" rows="3" ><?php echo $row['address']; ?></textarea></td>                 
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="btnEdit" value="Update">
                    <input type="reset" name="btnReset" value="Reset">
                    <input type="button" name="btBack" onclick='window.location.href = "user.php"' value="Back">
                </td>
            </tr>
        </table>
    </form>    

</body>
</html>