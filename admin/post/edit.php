<?php
    session_start();
    include('../session.php');
    include('../../connection.php');
    include('../common/admin-header.php');
    include('../common/admin-footer.php');
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $conn = conn_db();
        $row[] = '';
        $category = $title = $detail = "";
        $categoryErr = $titleErr = $detailErr = "";
        $target_dir = $target_file = $image = "";
        $user_id = $_SESSION['user']["id"];
        $sql_msg = "";
        $query = "SELECT * FROM category WHERE parent_id != 0";
        $result_category = mysqli_query($conn, $query);

        $id = $_GET['id'];
        $sql_content = "SELECT * FROM content left join users on content.user_id = users.user_id
                                              left join category on content.cate_id = category.id WHERE content_id = $id";
        $result_content = mysqli_query($conn, $sql_content);
        if (mysqli_num_rows($result_content) == 1) {
            $row = mysqli_fetch_assoc($result_content);
        }
    }

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
        if (isset($_FILES['image']) && !empty($_POST["image"])) {
            $target_dir = "../../asset/img/";
            $target_file = $target_dir . basename($_FILES['image']['name']);
            $image = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        } else {
            $image = $row['img_id'];
        }
        if (empty($categoryErr) && empty($titleErr) && empty($detailErr)) {
            $conn = conn_db();
            $sql = "UPDATE content SET content.title = '{$title}', content.detail = '{$detail}', content.cate_id = {$category}, content.user_id = {$user_id}, content.img_id = '{$image}' WHERE content_id = $id";
            mysqli_query($conn, $sql);
            $last_id = mysqli_insert_id($conn);
            header("Location: http://localhost/wint_zoo/admin/post/dashboard.php");
            $sql_msg = "Add successed <a href='view.php/?id={$last_id}' target='_blank' >View</a>";
            } else {
                echo "Add page fail";
            }
            $category = $title = $detail = "";
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
                <form method="post" action="edit.php?id=<?=$row['content_id']?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Main Category:</label>
                        <select name="category" required>
                            <?php
                                while ($row_parent = mysqli_fetch_assoc($result_category)) {
                                    $_parent[] = $row_parent;
                                }
                                echo "<option value='$id'>Select main category</option>";
                                foreach ($_parent as $key => $value) : ?>
                                <option value="<?=$value['id']?>" <?=$row['cate_id'] == $value['id'] ? "selected" : ""  ?>><?=$value['cate_name']?></option>
                                <?php endforeach ?>
                            </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="my-input">Title</label>
                        <input id="my-input" class="form-control" type="text" name="title" value="<?=$row['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="my-textarea">Detail</label>
                        <textarea id="my-textarea" class="form-control" type="text" name="detail" rows="3"><?php echo $row['detail']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                            <br><?php echo "<img style='width:120px;' src='../../asset/img/".$row['img_id']."'>"; ?>
                        <input type="file" name="image" ></div>
                    </div>
                        <button class="btn btn-success" type="submit">Submit</button>
                </form>
            </div>
        </div>
</body>
</html>