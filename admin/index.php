<?php 
include('./login.php'); 

if (isset($_SESSION['user']) && $_SESSION['user']){
    header("Location:http://localhost/wint_zoo/admin/dashboard.php");
}
?>



