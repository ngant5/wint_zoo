<?php
    session_start();
    include('../session.php');
    include('../../connection.php');
    include('../common/admin-header.php');
    include('../common/admin-footer.php');
    $conn = conn_db();
    $cateNameErr = $categoryName = "";
    $parentId = 0;
    $user_id = $_SESSION['user']["id"];
    $sql_msg = "";
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["categoryName"]) && !empty($_POST["categoryName"])) {
            $categoryName = $_POST["categoryName"];
        } else {
            $cateNameErr = "Category Name is required";
        }
    
        if (empty($cateNameErr)) {
            $sql = "INSERT INTO category (cate_name, parent_id, user)
            VALUES ('{$categoryName}', '{$parentId}', '{$user_id}')";
            if (mysqli_query($conn, $sql)) {
                $last_id = mysqli_insert_id($conn);
                $sql_msg = "Add successed <a href='view.php/?id={$last_id}' target='_blank' >New Menu</a>";
            } else {
                $sql_msg = "Add Fail";
            }
            
            $categoryName = "";
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
            <button class="btn"><a href="./view.php">&#8810; BACK</a></button>
            <form method="post" action="create.php">
                <div class="form-group">
                    <label>Menu Name:</label>
                    <input type="text" name="categoryName" required autofocus>
                </div>
                    <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
        
</body>
</html>