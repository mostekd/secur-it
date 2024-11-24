<?php
include_once("db_connection.php");
    class db_orders extends db_connection{
        function selectOrderByIdUser($id_user){
            $query = "SELECT * FROM `orders` WHERE id_user =".$id_user.";";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertOrder($id_user, $id_service, $id_discount, $final_price){
            $query = "INSERT INTO `orders`(`id_user`, `id_service`, `id_discount`, `final_price`) VALUES  ('".$id_user."','".$id_service."','".$id_discount."','".$final_price."');";
            $data = mysqli_query($this->connect, $query);
            header('location: ../BO/basket.php'); 
            $this->close();
        }

        function deleteOrder($id_order){
            $query = "Delete from orders where id_order =".$id_order.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id_order']);
            header('location: ../BO/basket.php'); 
            $this->close();
        }

        function updateOrder($id_order, $title, $description){
            $query = "UPDATE `about_company` SET `title`='".$title."',`description`='".$description.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id_order']);
            header('location: ../BO/basket.php');  
            $this->close();
        }
    }
?>
