<?php
include_once("db_connection.php");
class db_companies extends db_connection
    {
        function selectCompanies()
        {
            $query = "SELECT * FROM `companies` WHERE 1";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0)
            {
                return $data;
            }
        }

        function selectCompanyByID($id_company)
        {
            $query = "SELECT c.* FROM `companies` AS c WHERE c.id_company = ".$id_company.";";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0) 
            {
                return $data;
            }
        }

        function deleteCompany($id_company)
        {
            $query = "Delete from companies where id_company =".$id_company.";";
            $data = mysqli_query($this->connect, $query);
            $this->close();
        }

        function updateCompany($id_company, $name, $additional_name, $tax, $id_country_code, $phone_number, $email_address)
        {
            $query = "UPDATE `companies` SET `name`='".$name."',`additional_name`='".$additional_name."',`tax`='".$tax."',`id_country_code`='".$id_country_code."',`phone_number`='".$phone_number."',`email_address`='".$email_address."' WHERE `id_company`=".$id_company.";";
            $data = mysqli_query($this->connect, $query);
            header('location: ./account.php');
            $this->close();
        }
    }
?>