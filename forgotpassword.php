<?php

// Database configuration
include_once('db.php');


if(isset($_SESSION['user_id'])) {
    header('location:user.php');
    exit(); 
}


$link = "#";
if(isset($_REQUEST['btnFogotPassword'])) {
    
    $email = "";
    if(isset($_REQUEST['email'])) {
        $email =  $_REQUEST['email'];
    }

    

    $query = "SELECT * 
              FROM 
              users WHERE email = '". $email ."' ";

    if($debug) {
        echo "<br/>" . $query;
    }

    $result = mysqli_query($conn, $query);

    $row = array();
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        
        $user_id  = $row['id'];
        $token = rand();
        

        $quy_ins = "INSERT INTO forgot_password (user_id, token) 
                    values('". $user_id ."',
                           '". $token ."'
                    )";

        if($debug) {
            print("<pre>");
            print_r($quy_ins);
            exit();
        }

        $link = "http://localhost/code-practice/reset_password.php?token=" . $token;


        $rec = mysqli_query($conn, $quy_ins);
        
        //header('location:login.php?'); 
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
     <h1 align="center"> Forgot Password </h1>
     <h4 align="center"><?php echo $msg; ?></h4>
     <h4 align="center"><a href="<?php echo $link?>">Reset your password<a></h4>
     <form name="frmForgotPassword" id="frmForgotPassword" method="post"  action="forgotpassword.php">
        <table align="center" border="1">
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value=""></td>                 
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="submit" name="btnFogotPassword" value="Forgot Password">
                    <input type="reset" name="btnReset" value="Reset">
                    <input type="button" name="btnRegister" onclick='window.location.href = "login.php"' value="Login">
                </td>
            </tr>   
        </table>
     </form>
</body>
</html>