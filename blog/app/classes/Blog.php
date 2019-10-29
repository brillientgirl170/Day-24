<?php
namespace App\classes;


class Blog
{
    public function addBlog($data) {
        $fileName = $_FILES['blog_image']['name'];
        $directory = '../assets/images/';
        $imageUrl = $directory.$fileName;
        $fileType = pathinfo($fileName,PATHINFO_EXTENSION);
        $check = getimagesize($_FILES['blog_image']['tmp_name']);
        if ($check) {
            if (file_exists($imageUrl)) {
                die("This file is already exist,, Please chose another one. Thanks !!!");
            } else {
                if ($_FILES['blog_image']['size'] > 500000) {
                    die("Your file size is too large, Please select with in 10kb !!!");
                } else {
                    if ($fileType !='jpg' && $fileType != 'png' && $fileType != 'JPG') {
                        die("File type is not supported,, please input jpg Or png" );
                    } else {
                        move_uploaded_file($_FILES['blog_image']['tmp_name'], $imageUrl);
                        $sql = "INSERT INTO blogs (catagory_id, blog_title, short_description, long_description, blog_image, status) VALUES ('$data[catagory_id]', '$data[blog_title]', '$data[short_description]', '$data[long_description]', '$imageUrl', '$data[status]') ";
                        if (mysqli_query(Database::dbConnection(), $sql)) {
                            $massage = "Blog Save Successfully";
                            return $massage;
                        } else {
                            die("Query problem".mysqli_error(Database::dbConnection()));
                        }

                    }
                }
            }
        } else {
            die("Please upload an image file ,,thanks !!");
        }

    }

    public function manageBlog() {
        $sql = "SELECT b.*, c.catagory_name FROM blogs as b, catagories as c WHERE b.catagory_id= c.id";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }

    public function getBlogInfoById($id) {
        $sql = "SELECT * FROM blogs WHERE id= $id ";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }

    public function updateBlog($data) {
        $blogImage = $_FILES['blog_image']['name'];
        if ($blogImage) {
            $sql = "SELECT * FROM blogs WHERE id ='$data[blog_id]' ";
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            $blogInfo = mysqli_fetch_assoc($queryResult);
            unlink($blogInfo['blog_image']);

            $fileName = $_FILES['blog_image']['name'];
            $directory = '../assets/images/';
            $imageUrl = $directory.$fileName;
            $fileType = pathinfo($fileName,PATHINFO_EXTENSION);
            $check = getimagesize($_FILES['blog_image']['tmp_name']);
            if ($check) {
                if (file_exists($imageUrl)) {
                    die("This file is already exist,, Please chose another one. Thanks !!!");
                } else {
                    if ($_FILES['blog_image']['size'] > 500000) {
                        die("Your file size is too large, Please select with in 10kb !!!");
                    } else {
                        if ($fileType !='jpg' && $fileType != 'png' && $fileType != 'JPG') {
                            die("File type is not supported,, please input jpg Or png" );
                        } else {
                            move_uploaded_file($_FILES['blog_image']['tmp_name'], $imageUrl);
                            $sql = "UPDATE blogs SET catagory_id='$data[catagory_id]', blog_title='$data[blog_title]', short_description='$data[short_description]', long_description='$data[long_description]', blog_image='$data[$imageUrl]', status='$data[status]' WHERE id='$data[blog_id]' ";
                            if (mysqli_query(Database::dbConnection(), $sql)) {
                                header("Location: manage-blog.php");
                            } else {
                                die("Query problem".mysqli_error(Database::dbConnection()));
                            }

                        }
                    }
                }
            } else {
                die("Please upload an image file ,,thanks !!");
            }
        } else {
            $sql = "UPDATE blogs SET catagory_id='$data[catagory_id]', blog_title='$data[blog_title]', short_description='$data[short_description]', long_description='$data[long_description]', status='$data[status]' WHERE id='$data[blog_id]' ";
            if (mysqli_query(Database::dbConnection(), $sql)) {
                header("Location: manage-blog.php");
            } else {
                die("Query problem".mysqli_error(Database::dbConnection()));
            }
        }
    }

    public function deleteBlog($id) {
        $sql = "DELETE FROM blogs WHERE id= $id ";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            $massage = "Delete Blog Successfully";
            return $massage;
        } else {
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }

    public function getAllPublishedCatagoryInfo() {
        $sql = "SELECT * FROM catagories WHERE status = 1 ";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }
}