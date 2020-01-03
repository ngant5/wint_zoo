<?php
session_start();
include('../../connection.php');
include('../common/admin-header.php');
include('../common/admin-footer.php');
$conn = conn_db();
$sql_msg = "";
$nameErr  = $passErr = $statusErr = "";
$name  = $pass = $status = "";
$role = 2;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE user_id = $id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        } else {
            echo "a";
            // header("Location: http://localhost/wint_zoo/admin/user/dashboard.php");
            // die();
            }
        } else {
            echo "b";
            // header("Location: http://localhost/wint_zoo/admin/dashboard.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && !empty($_POST["name"])) {
        $name = $_POST["name"];
    } else {
        $nameErr = "Username is required";
    }
    if (isset($_POST["pass"]) && !empty($_POST["pass"])) {
        $pass = md5($_POST["pass"]);
    } else {
        $passErr = "Password is required";
    }
    if (isset($_POST["status"]) && in_array($_POST["status"], [1,0])) {
        $status = $_POST["status"];
    } else {
        $statusErr = "Status is required";
    }

    if (empty($nameErr) &&  empty($passErr) && empty($statusErr)) {
        $conn = conn_db();
        $sql = "UPDATE users SET users.user_id = $id, users.username = '{$name}', users.password = '{$pass}', users.role_id = {$role}, users.status = {$status} WHERE user_id = $id";
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql_msg = "Edit user successed <a href='view.php?id={$last_id}' target='_blank' >View</a>";
        } else {
            $sql_msg = "Edit Fail";
        }
        $name = $pass = $status = "";
        // mysqli_close($conn);
    }
}
echo $nameErr;
echo $passErr;

// mysqli_close($conn);

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
                    <a class="nav-link" href="dashboard.php">Category</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="../../admin/page/dashboard.php">Page</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="../../admin/post/dashboard.php">Post</a>
                </li>
            </ul>
        </div>

        <div class="col-sm-9 cate-view">
            <h1 class="text-center">USER</h1>
            <form method="post" action="edit.php?id=<?=$row['user_id']?>">
                <div><?=$sql_msg ?></div>
                <button class="btn"><a href="./create.php"> ADD </a></button>
                    <table>
                        <tr>
                            <td>User name </td>
                            <td><input type="text" name="name" value="<?=$row['username'] ?>" required></td>
                        </tr>
                        <tr>
                            <td>Change Password </td>
                            <td><input type="password" name="pass" required></td>
                        </tr>
                        
                        <tr>
                            <td>Status </td>
                            <td>
                                <select name="status" id="" required>
                                    <option value="0" <?=$row['status'] == 0 ? "selected" : "" ?> >Deactive</option>
                                    <option value="1" <?=$row['status'] == 1 ? "selected" : "" ?> >Active</option>
                                </select><span><?=$statusErr?></span>
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
</body>
</html>