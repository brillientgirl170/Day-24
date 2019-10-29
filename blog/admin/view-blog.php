<?php
session_start();
if ($_SESSION['id'] == null) {
    header("Location: index.php");
}
require_once '../vendor/autoload.php';
$login = new \App\classes\Login();
$blog = new \App\classes\Blog();

$massage = ' ';
if (isset($_GET['logout'])) {
    $login->adminLogout();
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $massage = $blog->deleteBlog($id);
}

$queryResult = $blog->manageBlog();

$id = $_GET['id'];
$queryResult = $blog->getBlogInfoById($id);
$view= mysqli_fetch_assoc($queryResult);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
<?php include "includes/menu.php" ?>

<div class="container" style="margin-top: 5px;">
    <div class="row">
        <div class="col-sm-12 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 style="color: #1e7e34; padding-top: 3px"><?php echo $massage; ?></h1>
                    <table class="table table-bordered">
                        <tr>
                            <th>Blog Id</th>
                            <td><?php echo $view['id']; ?></td>
                        </tr>
                        <tr>
                            <th>Blog Title</th>
                            <td><?php echo $view['blog_title']; ?></td>
                        </tr>
                        <tr>
                            <th>Catagory ID</th>
                            <td><?php echo $view['catagory_id']; ?></td>
                        </tr>
                        <tr>
                            <th>Blog Short Description</th>
                            <td><?php echo $view['short_description']; ?></td>
                        </tr>
                        <tr>
                            <th>Blog Long Description</th>
                            <td><?php echo $view['long_description']; ?></td>
                        </tr>
                        <tr>
                            <th>Blog Image</th>
                            <td><img src="<?php echo $view['blog_image']; ?>" alt="" height="200" width="250"></td>
                        </tr>
                        <tr>
                            <th>Publication Status</th>
                            <td><?php echo $view['status']==1 ? 'published' : 'unpublished' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="../assets/js/jquery-3.4.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>



