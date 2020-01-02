<?php
    session_start();
    include('../session.php');
    include('../../connection.php');
    include('../common/admin-header.php');
    include('../common/admin-footer.php');
    $conn = conn_db();
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $parentId = 0;
        $categoryName = "";
        $sql_msg = "";
        $user_id = $_SESSION['user']["id"];
        $id = $_GET['id'];
        $sql_category = "SELECT * FROM category WHERE id = $id";
        $result_category = mysqli_query($conn, $sql_category);
        if (mysqli_num_rows($result_category) == 1) {
            $row = mysqli_fetch_assoc($result_category);
            } else {
                echo "a";
                // header("Location: http://localhost/some_php/dashboard.php");
                // die();
                }
            } else {
                echo 'b';
                // header("Location: http://localhost/some_php/dashboard.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["categoryName"]) && !empty($_POST["categoryName"])) {
            $categoryName = $_POST["categoryName"];
        } else {
            $cateNameErr = "Category Name is required";
        }
        if (empty($cateNameErr)) {
            $conn = conn_db();
            $sql = "UPDATE category SET category.id = $id, category.cate_name = '{$categoryName}', category.parent_id = {$parentId}, category.user = {$user_id} WHERE id = $id ";

            
            if (mysqli_query($conn, $sql)) {
                $last_id = mysqli_insert_id($conn);
                $sql_msg = "Add successed <a href='./view.php/?id={$id}' target='_blank' >New Menu</a>";
            } else {
                $sql_msg = "Add Fail";
            }
            
            $categoryName = $id = "";
            // mysqli_close($conn);
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
<?=$sql_msg ?>
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
                    <a class="nav-link" href="#">Content</a>
                </li>
            </ul>
        </div>

        

        <div class="col-sm-9 cate-view">
            <h1 class="text-center">MENU</h1>
            <form method="post" action="edit.php?id=<?=$row['id']?>">
            <button class="btn"><a href="./view.php">&#8810; BACK</a></button>
                <div class="form-group">
                    <label>Category Name:</label>
                    <input type="text" name="categoryName" value="<?=$row['cate_name']?>" required autofocus>
                </div>
                    <button class="btn btn-success" type="submit">Submit</button>
                <div class="form-group">
                </div>
            </form>
        </div>
        
</body>
</html>