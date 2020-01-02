
<style>
    .admin-header {
        background-color: #b6d9de;
        height: 150px;
        margin-bottom: 10px;
        text-align: center;
    }
</style>
</head>

<div class="admin-header">
    <h1>WINT ZOO</h1>
    <h3>Admin Page</h3>
    <div class="float-right">
        <b><?="Hello {$_SESSION['user']["username"]}! ";?></b>
        <a href="http://localhost/wint_zoo/admin/logout.php" class="float-right"> Logout.</a>
    </div>
</div>