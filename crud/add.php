<?php

// Database configuration
include_once('db.php');

if(isset($_REQUEST['btnAdd'])){
    if($debug) {
        print("<pre>");
        print_r($_REQUEST);
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

    $quy_ins = "INSERT INTO users (first_name, last_name, email, password, address) 
                    values('". $first_name ."',
                           '". $last_name ."',
                           '". $email ."',
                           '". $password ."',
                           '". $address ."'
                    )";

    $rec = mysqli_query($conn, $quy_ins);
    $msg = "Record Added successfully";
    header('location:user.php?msg=' . $msg); 
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
     <h1 align="center">Add User </h1>
    <!-- <script src="js/scripts.js"></script> -->
    <form name="frmAddUser" method="post" action="add.php">
        <table align="center" border="1">
            <tr>
                <td>First name</td>
                <td><input type="text" name="first_name" value="" ></td>                 
            </tr>
            <tr>
                <td>last name</td>
                <td><input type="text" name="last_name" value="" ></td>                 
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="" ></td>                 
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" value=""></td>                 
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="confirm_password" value=""></td>                 
            </tr>
            <tr>
                <td>Addrerss</td>
                <td><textarea name="address" rows="3" ></textarea></td>                 
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="submit" name="btnAdd" value="Add">
                    <input type="reset" name="btnReset" value="Reset">
                </td>
            </tr>
        </table>
    </form>    

</body>
</html>