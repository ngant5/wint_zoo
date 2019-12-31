<?php
include('../common-header.php');
include('../connection.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<link rel="stylesheet" href="../../asset/css/all.min.css">
<link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
<script src="../../asset/js/bootstrap.min.js"></script>

<script src="../../asset/js/jquery.slim.min.js"></script>
<script src="../..asset/js/popper.min.js"></script>

<title>WINT ZOO - Category</title>

<style>
    .cate-view {
        text-align: center;
    }
</style>

</head>
<body>


<div class="container cate-view">
    <form method="get" action="create.php">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>User Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $conn = conn_db();
                    if (!$conn) {
                        exit ("Fail to connection Database! ". mysqli_connect_error($conn));
                    }

                    $sql = "SELECT * FROM category inner join";
                    //mysqli_set_charset($conn, "utf8");
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows(($result)) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <tr>
                            <td><?php echo $i++  ?></td>
                            <td><?= $row['cate_name'] ?></td>
                            <td></td>
                        </tr>

                        <?php
                        }
                    }
                ?>
            </tbody>
        </table>

        
    </form>

    
</div>




</body>
</html>


<?php
include('../common-footer.php');
?>