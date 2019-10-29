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

if (isset($_POST['btn'])) {
    $massage = $catagory->addCatagory($_POST);
}



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
                        <h1 style="color: #1e7e34; padding-top: 5px"><?php echo $massage; ?></h1>
                        <form action="" method="post">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Catagory Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="catagory_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-3 col-form-label">Catagory Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="catagory_description" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Publication Status</label>
                                <div class="col-sm-9">
                                    <input type="radio" name="status" value="1">published
                                    <input type="radio" name="status" value="0">unpublished
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9">
                                    <button type="submit" name="btn" class="btn btn-success btn-block">Save Catagory Info</button>
                                </div>
                            </div>
                        </form>
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
