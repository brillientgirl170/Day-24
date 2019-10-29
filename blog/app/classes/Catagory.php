<?php
namespace App\classes;


class Catagory
{
    public function addCatagory($data) {
        $sql = "INSERT INTO catagories (catagory_name, catagory_description, status) VALUES ('$data[catagory_name]', '$data[catagory_description]', '$data[status]') ";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            $massage = "Catagory Save Successfully";
            return $massage;
        } else {
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }

    public function manageCatagory() {
        $sql = "SELECT * FROM catagories";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }

    public function getCatagoryInfoById($id) {
        $sql = "SELECT * FROM catagories WHERE id= '$id' ";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }

    public function updateCatagory($data) {
        $sql = "UPDATE catagories SET catagory_name='$data[catagory_name]', catagory_description='$data[catagory_description]', status='$data[status]' WHERE id='$data[id]'";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            header("Location: manage-catagory.php");
        } else {
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }

    public function deleteCatagory($id) {
        $sql = "DELETE FROM catagories WHERE id= '$id' ";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            $massage = "Delete Catagory Successfully";
            return $massage;
        } else {
            die("Query problem".mysqli_error(Database::dbConnection()));
        }
    }
}