<?php
session_start();
if ($_SESSION['id'] == null) {
    header("Location: index.php");
}
$massage = ' ';
require_once '../vendor/autoload.php';
$login = new \App\classes\Login();
$catagory = new \App\classes\Catagory();

if (isset($_GET['logout'])) {
    $login->adminLogout();
}

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $massage = $catagory->deleteCatagory($id);
}

$queryResult = $catagory->manageCatagory();

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

    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h style="color: #1e7e34; padding-top: 3px"><?php echo $massage; ?></h>
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">SL NO</th>
                                <th scope="col">Catagory Name</th>
                                <th scope="col">Catagory Description</th>
                                <th scope="col">Publication Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php while($catagories = mysqli_fetch_assoc($queryResult)) { ?>
                            <tr>
                                <td><?php echo $catagories['id']; ?></td>
                                <td><?php echo $catagories['catagory_name']; ?></td>
                                <td><?php echo $catagories['catagory_description']; ?></td>
                                <td><?php echo $catagories['status']; ?></td>
                                <td>
                                    <a href="edit-catagory.php?id=<?php echo $catagories['id']; ?>">Edit</a>
                                    <a href="?delete=true&id=<?php echo $catagories['id']; ?>" onclick="return confirm('Are you sure to delete this catagory !!!')">Delete</a>
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
<?php
