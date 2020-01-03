<?php
    session_start();
    include('../session.php');
    include('../../connection.php');
    include('../common/admin-header.php');
    include('../common/admin-footer.php');
    $conn = conn_db();
    $category = $title = $detail = "";
    $categoryErr = $titleErr = $detailErr = "";
    $target_dir = $target_file = $image = "";
    $user_id = $_SESSION['user']["id"];
    $datetime = getdate();
    $sql_msg = "";
    $msg = "";
    $query = "SELECT * FROM category WHERE parent_id = 0";
    $result = mysqli_query($conn, $query);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["category"]) && !empty($_POST["category"])) {
            $category = $_POST["category"];
        } else {
            $categoryErr = "Category Name is required";
        }
        if (isset($_POST["title"]) && !empty($_POST["title"])) {
            $title = $_POST["title"];
        } else {
            $titleErr = "Title is required";
        }
        if (isset($_POST["detail"]) && !empty($_POST["detail"])) {
            $detail = $_POST["detail"];
        } else {
            $detailErr = "Title is required";
        }
        if (isset($_FILES['image'])) {
            $target_dir = "../../asset/img/";
            $target_file = $target_dir . basename($_FILES['image']['name']);
            $image = $_FILES['image']['name'];
        }
        if (empty($categoryErr) && empty($titleErr) && empty($detailErr)) {
            
            $sql = "INSERT INTO content (title, detail, cate_id, user_id, img_id)
            VALUES ('{$title}', '{$detail}', {$category}, {$user_id}, '{$image}')";
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    mysqli_query($conn, $sql);
                    $last_id = mysqli_insert_id($conn);
                    $sql_msg = "Add successed <a href='view.php/?id={$last_id}' target='_blank' >View</a>";
                }
            } else {
                echo "Add page fail";
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
<?=$sql_msg ?>
    <div class="row">
        <div class="col-sm-3">
            <ul class="navbar-nav">
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="../user/dashboard.php">User</a>
                </li>
                <li class="nav-item admin-sidebar">
                    <a class="nav-link" href="dashboard.php">Menu</a>
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
            <button class="btn"><a href="./dashboard.php">&#8810; BACK</a></button>
            <div class="container">
                <form method="post" action="./create.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Main Category:</label>
                        <select name="category" required>
                            <?php
                            echo "<option value='$id'>Select main category</option>";
                                while($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $parent_name = $row['cate_name'];
                                    echo "<option value='$id'>$parent_name</option>";
                                }
                                mysqli_close($conn);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Title</label>
                        <input id="my-input" class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group">
                        <label for="my-textarea">Detail</label>
                        <textarea id="my-textarea" class="form-control" name="detail" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Page image</label>
                        <div><input type="file" name="image"></div>
                    </div>
                        <button class="btn btn-success" type="submit">Submit</button>
                </form>
            </div>
        </div>
</body>
</html>