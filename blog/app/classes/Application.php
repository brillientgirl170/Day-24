<?php
namespace App\classes;
use App\classes\Database;

class Application
{
    Public function getAllPublishedBlogInfo() {
        $sql = "SELECT * FROM blogs WHERE  status = 1 ";
        if (mysqli_query(Database::dbConnection(), $sql)) {
            $queryResult = mysqli_query(Database::dbConnection(), $sql);
            return $queryResult;
        } else {
            die("Query problem".mysqli_error( Database::dbConnection() ));
        }
    }
}