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
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">SL NO</th>
                                <th scope="col">Catagory Name</th>
                                <th scope="col">Blog Title</th>
                                <th scope="col">Publication Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $i= 1;
                            while($blogs = mysqli_fetch_assoc($queryResult)) { ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $blogs['catagory_name'] ?></td>
                                    <td><?php echo $blogs['blog_title'] ?></td>
                                    <td><?php echo $blogs['status'] ==1 ? 'published' : 'unpublished' ?></td>
                                    <td>
                                        <a href="view-blog.php?id=<?php echo $blogs['id']; ?>">View</a>
                                        <a href="edit-blog.php?id=<?php echo $blogs['id']; ?>">Edit</a>
                                        <a href="?delete=true&id=<?php echo $blogs['id']; ?>" onclick="return confirm('Are you sure to delete this catagory !!!')">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>

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


