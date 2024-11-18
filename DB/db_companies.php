<?php
include_once("db_connection.php");
class db_companies extends db_connection
    {
        function selectFirmy()
        {
            $query = "SELECT * FROM `companies` WHERE 1";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0)
            {
                return $data;
            }
        }

        function selectFirmaById($id_company)
        {
            $query = "SELECT c.* FROM `companies` AS c WHERE c.id_company = ".$id_company.";";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0) 
            {
                return $data;
            }
        }

        function deleteFirmaById($id_company)
        {
            $query = "Delete from companies where id_company =".$id_company.";";
            $data = mysqli_query($this->connect, $query);
            $this->close();
        }

        function updateFirma($id_company, $name, $additional_name, $tax, $id_country_code, $numer_telefonu, $adres_e_mail)
        {
            $query = "UPDATE `companies` SET `name`='".$name."',`additional_name`='".$additional_name."',`tax`='".$tax."',`id_country_code`='".$id_country_code."',`phone_number`='".$phone_number."',`email_address`='".$email_address."' WHERE `id_company`=".$id_company.";";
            $data = mysqli_query($this->connect, $query);
            header('location: ./account.php');
            $this->close();
        }
    }
?>