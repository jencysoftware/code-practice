<?php
// Database configuration
include_once('db.php');

if(isset($_REQUEST['btnResetPassword'])) {

    $password = "";
    if(isset($_REQUEST['password'])) {
        $password =  $_REQUEST['password'];
    }

    $user_id = "";
    if(isset($_REQUEST['user_id'])) {
        $user_id =  $_REQUEST['user_id'];
    }

    $quy_update = "UPDATE users 
                SET password  = '". $password ."'
                WHERE id = '" . $user_id ."'";

    $rec = mysqli_query($conn, $quy_update);

    $quy_del = "DELETE FROM  forgot_password WHERE user_id = '".$user_id ."'";

    if($debug) {
        echo "<br/>" . $quy_del;
    }

    mysqli_query($conn, $quy_del);


    header('location:login.php');
    exit();
}





//Validation checks 
if(!isset($_REQUEST['token']) || $_REQUEST['token'] == '' ){
    header('location:login.php');
    exit(); 
}

$token = $_REQUEST['token'];

$query = "SELECT * 
            FROM 
            forgot_password WHERE token = '". $token ."' ";

if($debug) {
    echo "<br/>" . $query;
}

$result = mysqli_query($conn, $query);

$row = array();
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $user_id  = $row['user_id'];
    echo $user_id;
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
     <h1 align="center"> Reset Password </h1>
     <h4 align="center"><?php echo $msg; ?></h4>
     <form name="frmResetPassword" id="frmResetPassword" method="post"  action="reset_password.php">
        <table align="center" border="1">
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" value=""></td>                 
            </tr>
            <tr>
                <td>Confirm Password</td>
                <td><input type="password" name="confirm_password" value=""></td>                 
            </tr>
            <tr align="center">
                <td colspan="2">
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                    <input type="submit" name="btnResetPassword" value="Reset Password">
                </td>
            </tr>   
        </table>
     </form>
</body>
</html>