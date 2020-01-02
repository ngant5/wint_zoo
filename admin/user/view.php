<?php
session_start();
include('../session.php');
include('../../connection.php');
include('../common/admin-header.php');
include('../common/admin-footer.php');
if(isset($_GET["id"]) && $_GET["id"] > 0) {
    $conn = conn_db();
    $id = $_GET["id"];
    $sql = "SELECT * FROM users WHERE user_id = $id";
    //mysqli_set_charset($conn, "utf8");
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
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
                    <a class="nav-link" href="../user/dashboard.php">User</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="../menu/dashboard.php">Menu</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="dashboard.php">Category</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="#">Content</a>
                </li>
            </ul>
        </div>

        <div class="col-sm-9 cate-view">
            <h1 class="text-center">USER</h1>
            <button class="btn"><a href="./view.php">&#8810; BACK</a></button>
            <button class="btn"><a href="./create.php"> ADD </a></button>
            <form method="get" action="create.php">
                
                <table class="table table-hover cate-table table-bordered">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $row['username'] ?></td>
                            <td>
                                <a href="<?="./view.php?id={$row['user_id']}" ?>" target="_blank"> View </a> ||
                                <a href="<?="./edit.php?id={$row['user_id']}" ?>" target="_blank"> Edit </a> ||
                                <a href="<?="./delete.php?id={$row['user_id']}" ?>" target="_blank"> Delete </a>
                            </td>
                        </tr>
                        <?php
                                
                            } else {
                                header("Location: http://localhost/wint_zoo/admin/user/dashboard.php");
                            }
                            mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</body>
</html>