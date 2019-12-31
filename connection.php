<?php
function conn_db() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wint_zoo";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " .mysqli_connect_error());
    }
    return $conn;
}
?>