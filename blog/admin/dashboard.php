<?php
session_start();
if ($_SESSION['id'] == null) {
    header("Location: index.php");
}

require_once '../vendor/autoload.php';
$login = new \App\classes\Login();

if (isset($_GET['logout'])) {
    $login->adminLogout();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>

    <?php include "includes/menu.php" ?>

    <script src="../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
