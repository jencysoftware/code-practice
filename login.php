<?php

// Database configuration
include_once('db.php');


if(isset($_SESSION['user_id'])) {
    header('location:user.php');
    exit(); 
}

if(isset($_REQUEST['btnLogin'])) {
    
    $email = "";
    if(isset($_REQUEST['email'])) {
        $email =  $_REQUEST['email'];
    }

    $password = "";
    if(isset($_REQUEST['password'])) {
        $password =  $_REQUEST['password'];
    }

    $query = "SELECT * 
              FROM 
              users WHERE email = '". $email ."' AND password = '". $password ."'";

    if($debug) {
        echo "<br/>" . $query;
    }

    $result = mysqli_query($conn, $query);

    $row = array();
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        header('location:user.php'); 
    }
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
     <h1 align="center"> Login </h1>
     <h4 align="center"><?php echo $msg; ?></h4>
     <form name="frmLogin" id="frmLogin" method="post"  action="login.php">
        <table align="center" border="1">
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value=""></td>                 
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" value=""></td>                 
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="submit" name="btnLogin" value="Login">
                    <input type="reset" name="btnReset" value="Reset">
                    <input type="button" name="btnRegister" onclick='window.location.href = "register.php"' value="New User Registration">

                    <input type="button" name="btnForgotPassword" onclick='window.location.href = "forgotpassword.php"' value="Forgot Password">
                </td>
            </tr>   
        </table>
     </form>
</body>
</html>