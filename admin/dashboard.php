<?php
    session_start();
    // include('./session.php');
    include('./common/admin-header.php');
    include('./common/admin-footer.php');
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
    .admin-sidebar {
        background-color: #b6d9de;
        margin-bottom: 5px;
        text-align: center;
        height: 100%;
        width: 100%;
    }
</style>
</head>

<body>
    <div class="row">
        <div class="col-sm-3">
            <ul class="navbar-nav">
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="../admin/user/view.php">User</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="../admin/category/view.php">Category</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="#">Content</a>
                </li>
            </ul>
        </div>
</body>
</html>
