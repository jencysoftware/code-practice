<?php
include_once('db.php');

if(1) {
    print("<br/>_SESSION<pre>");
    print_r($_SESSION);
}

if(isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}

header('location:login.php'); 

?>
