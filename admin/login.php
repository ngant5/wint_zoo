<?php
session_start();

require "../connection.php";
$conn = conn_db();
$user = $pass = $msg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE username = '{$user}' ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] == md5($pass)) {
            $session_user = [
                'id' => $row['user_id'],
                'username' => $row['username'],
                'role' => $row['role_id'],
                'status' => $row['status']
            ];
            $_SESSION['user'] = $session_user;
            header("Location: http://localhost/wint_zoo/admin/dashboard.php");
        } else {
            $msg = "The username or password is incorrect";
        }
    } else {
        $msg = "The username or password is incorrect";
    }
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>WINT ZOO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../asset/css/all.min.css">
  <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
  <script src="../asset/js/bootstrap.min.js"></script>
  <script src="../asset/js/jquery.slim.min.js"></script>
  <script src="../asset/js/popper.min.js"></script>
  <style>
/* * {
    border: 1px solid grey;
} */

    .admin-header {
        background-color: #b6d9de;
        height: 100%;

    }.admin-footer {
        background-color: #b6d9de;
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
        margin-bottom: 10px;
    }
</style>
<body>

    <div class="admin-header jumbotron">
        <h1>WINT ZOO</h1>
    </div>

    <div class="container">
        <form method="post">
            <h1>Login</h1> 
                <div class="text-danger"><?=$msg; ?></div>
                <div class="form-group">
                    <label for="txtTenTK">User Name</label>
                    <input id="txtTenTK" class="form-control" type="text" name="user">
                </div>
                <div class="form-group">
                    <label for="txtMK">Password</label>
                    <input id="txtMK" class="form-control" type="password" name="pass">
                </div>
                
                <button class="btn btn-success" type="submit">Subbmit</button>
        </form>
    </div>
    <div class="footer admin-footer">
        <div class="text-muted footer-copyright text-center py-3">© 2019 Copyright:
            <a href="http://localhost/wint_zoo/">wintzoo.com.</a>
            <span> All rights reserved.</span>
        </div>
    </div>
    
</body>