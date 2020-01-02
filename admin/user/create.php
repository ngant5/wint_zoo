<?php
session_start();
include('../../connection.php');
include('../common/admin-header.php');
include('../common/admin-footer.php');

$sql_msg = "";
$nameErr  = $passErr = $statusErr = "";
$name  = $pass = $status = "";
$role = 2;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["name"]) && !empty($_POST["name"])) {
        $name = $_POST["name"];
    } else {
        $nameErr = "Name is required";
    }

    if (isset($_POST["pass"]) && !empty($_POST["pass"])) {
        $pass = md5($_POST["pass"]);
    } else {
        $passErr = "User is required";
    }

    if (isset($_POST["status"]) && in_array($_POST["status"], [1,0])) {
        $status = $_POST["status"];
    } else {
        $statusErr = "Status is required";
    }

    

    if (empty($nameErr) &&  empty($passErr) && empty($statusErr)) {

        $conn = conn_db();
        $sql = "INSERT INTO users (username, password, role_id, status)
        VALUES ('{$name}', '{$pass}', {$role}, '{$status}')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql_msg = "Add successed <a href='view.php?id={$last_id}' target='_blank' >New item</a>";
        } else {
            $sql_msg = "Add Fail";
        }

        $name   = $pass = $status = "";
        mysqli_close($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>WINT ZOO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../asset/css/all.min.css">
  <link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
  <script src="../../asset/js/bootstrap.min.js"></script>
  <script src="../../asset/js/jquery.slim.min.js"></script>
  <script src="../../asset/js/popper.min.js"></script>
  <style>
    .admin-sidebar {
        background-color: #b6d9de;
        margin-bottom: 5px;
        text-align: center;
        height: 100%;
        width: 100%;
    }
    .cate-table {
        width: 95%;
        text-align: center;
    }
  </style>
</head>

<body>
    
        <div class="row">
            <div class="col-sm-3">
                <ul class="navbar-nav">
                    <li class="nav-item admin-sidebar">
                        <a class="nav-link" href="./dashboard.php">User</a>
                    </li>
                    <li class="nav-item admin-sidebar">
                        <a class="nav-link" href="../menu/dashboard.php">Menu</a>
                    </li>
                    <li class="nav-item admin-sidebar">
                        <a class="nav-link" href="../category/dashboard.php">Category</a>
                    </li>
                    <li class="nav-item admin-sidebar">
                        <a class="nav-link" href="#">Content</a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-9 cate-view">
            <form method="post" action="create.php">
                <h1 class="text-center">USER</h1>
                <div><?=$sql_msg ?></div>
                <button class="btn"><a href="./create.php"> ADD </a></button>
                    <table>
                        <tr>
                            <td>User name </td>
                            <td><input type="text" name="name" value="<?=$name ?>"><span><?=$nameErr ?></span></td>
                        </tr>
                        <tr>
                            <td>Password </td>
                            <td><input type="text" name="pass" value="<?=$pass ?>"><span><?=$passErr ?></span></td>
                        </tr>
                        
                        <tr>
                            <td>Status:</td>
                            <td>
                                <select name="status" id="">
                                    <option value="1" <?=$status == 1 ? "selected" : "" ?> >Active</option>
                                    <option value="0" <?=$status == 0 ? "selected" : "" ?> >Deactive</option>
                                </select><span><?=$statusErr?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="SUBMIT "></td>
                        </tr>
                    </table>
            </form>
            </div>
        
</body>
</html>