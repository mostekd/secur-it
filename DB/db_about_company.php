<?php
include_once("db_connection.php");
    class db_about_company extends db_connection{
        function selectAbout_company(){
            $query = 'SELECT * FROM `about_company` WHERE 1';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertAbout_company($title, $description){
            $query = "INSERT INTO `about_company`(`title`, `description`) VALUES ('".$title."','".$description."');";
            $data = mysqli_query($this->connect, $query);
            header('location: ../BO/about_company.php'); 
            $this->close();
        }

        function deleteAbout_company($id_about_company){
            $query = "Delete from about_company where id_about_company =".$id_about_company.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id_about_company']);
            header('location: ../BO/about_company.php'); 
            $this->close();
        }

        function updateAbout_company($id_about_company, $title, $description){
            $query = "UPDATE `about_company` SET `title`='".$title."',`description`='".$description.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id_about_company']);
            header('location: ../BO/about_company.php');  
            $this->close();
        }
    }
?>
