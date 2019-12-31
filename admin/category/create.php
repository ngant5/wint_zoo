<?php
include('../session.php');
include('../../connection.php');
include('../common/admin-header.php');
include('../common/admin-footer.php');

$sql_msg = "";
$nameErr = $parentErr = "";
$name = $parentid = "";
$user = $_SESSION['user']["username"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["name"]) && !empty($_POST["name"])) {
        $name = $_POST["name"];
    } else {
        $nameErr = "Name is required";
    }

    if (isset($_POST["parentid"]) && !empty($_POST["parentid"])) {
        $parentid = $_POST["parentid"];
    } else {
        $parentidErr = "Parent category is required";
    }

    if (empty($nameErr) && empty($parentErr)) {
        require "./connection.php";
        $conn = conn_db();
        $sql = "INSERT INTO category (cate_name, parent_id, user)
        VALUES ('{$name}', {$parent}, '{$user}')";

        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql_msg = "Add successed <a href='view.php?id={$last_id}' target='_blank' >New item</a>";
        } else {
            $sql_err = "Add Fail";
        }

        $name = $parentid = "";
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
        margin-top: 10px;
    }
  </style>
</head>

<body> 
    <div class="row">
        <div class="col-sm-3">
            <ul class="navbar-nav">
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="../user/view.php">User</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="../menu/view.php">Menu</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href=".view.php">Category</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="#">Content</a>
                </li>
            </ul>
        </div>

        <div class="col-sm-9">
            <form method="POST" action="create.php">
                <table class="table">
                    <tr>
                        <td>Category Name:</td>
                        <td><input type="text" name="name" value="<?=$name ?>"><span><?=$nameErr ?></span></td>
                    </tr>
                    <tr>
                        <td>Parent Category:</td>
                        <td>
                            <select name="parentid" id="">
                                <option value="1" <?=$parentid == 1 ? "selected" : "" ?> >Parent Category 1 </option>
                                <option value="0" <?=$parentid == 0 ? "selected" : "" ?> >Parent Category 2 </option>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>

<html>