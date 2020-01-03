<?php
session_start();
include('../session.php');
include('../../connection.php');
include('../common/admin-header.php');
include('../common/admin-footer.php');
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
                        <a class="nav-link" href="../user/dashboard.php">User</a>
                    </li>
                    <li class="nav-item admin-sidebar">
                        <a class="nav-link" href="../menu/dashboard.php">Menu</a>
                    </li>
                    <li class="nav-item admin-sidebar">
                        <a class="nav-link" href="../category/dashboard.php">Category</a>
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
            <form method="get" action="create.php">
            <h1 class="text-center">PAGE</h1>
                <button class="btn"><a href="./create.php"> ADD </a></button>
                <table class="table table-hover cate-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Datetime</th>
                            <th>User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $conn = conn_db();
                            $row[] = '';
                            $id = $_GET["id"];
                            $sql = "SELECT * FROM content left join users on content.user_id = users.user_id
                                                          left join category on content.cate_id = category.id WHERE content.content_id = {$id}";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows(($result)) > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $i++  ?></td>
                                    <td><?= $row['cate_name'] ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td><?php echo "<img style='width:120px;' src='../../asset/img/".$row['img_id']."'>"; ?></td>
                                    <td><?= $row['date_post'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td>
                                        <a href="<?="./view.php?id={$row['content_id']}" ?>" target="_blank"> View </a> ||
                                        <a href="<?="./edit.php?id={$row['content_id']}" ?>" target="_blank"> Edit </a> ||
                                        <a href="<?="./delete.php?id={$row['content_id']}" ?>" target="_blank"> Delete </a>
                                    </td>
                                </tr>

                                <?php
                                }
                            }
                            mysqli_close($conn);
                        ?>
                    </tbody>
                </table>
            </form>
            </div>

</body>
</html>