<?php
function building_menu($parent, $menuData) {
        $html = "";
        if (isset($menuData['parent_id'][$parent])) {
            $html .= "<ul class='nav'>";
            foreach($menuData['parent_id'][$parent] as $value) {
                $html .= "<li class='dropdown'>";
                $html .= "<a href='#'>".$menuData['items'][$value]['cate_name']."</a>";
                $html .= building_menu($value, $menuData);
                $html .= "</li>";
            }
            $html .= "</ul>";
        }
        return $html;
    }

    include('./connection.php');
    $conn = conn_db();
    $sql = "SELECT * FROM category";
    $result = mysqli_query($conn,$sql);
    foreach($result as $value) {
        $menuData['items'][$value['id']]=$value;
        $menuData['parent_id'][$value['parent_id']][] = $value['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>

<title>Menu da cap</title>
</head>
<body>
    <?php
        echo building_menu(0, $menuData);
    ?>
</body>
</html>
