<?php

if(empty($_SESSION['user'])) {
    header("Location: http://localhost/wint_zoo/admin/login.php");
} 
?>

