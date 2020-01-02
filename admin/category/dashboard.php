<?php
session_start();
include('../session.php');
include('../../connection.php');
include('../common/admin-header.php');
include('../common/admin-footer.php');

$conn = conn_db();
$sql = "SELECT * FROM category inner join users on category.user = users.user_id WHERE parent_id != 0";
//mysqli_set_charset($conn, "utf8");
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $_data[] = $row;
        }
    }
    mysqli_close($conn);
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
            <button class="btn"><a href="./create.php"> ADD PRODUCT</a></button>
            <form method="get" action="create.php">
                
                <table class="table table-hover cate-table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>User Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($_data as $key => $value) : ?>
                            <tr>
                                <td><?php echo $i++  ?></td>
                                <td><?= $value['cate_name'] ?></td>
                                <td><?= $value['username'] ?></td>
                                <td>
                                    <a href="<?="view.php?id={$value['id']}" ?>" target="_blank"> View </a> ||
                                    <a href="<?="./edit.php?id={$value['id']}" ?>" target="_blank"> Edit </a> ||
                                    <a href="<?="delete.php?id={$value['id']}" ?>" target="_blank"> Delete </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </form>
        </div>
        
</body>
</html>