<?php
include("db_connection.php");

class db_firmy extends db_connection
    {
        function selectFirmy()
        {
            $query = "SELECT * FROM `firmy` WHERE 1";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0)
            {
                return $data;
            }
        }

        function selectFirmaById($id_firma)
        {
            $query = "SELECT * FROM `firmy` WHERE id_firma = ".$id_firma.";";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0) 
            {
                return $data;
            }
        }

        function deleteFirmaById($id_firma)
        {
            $query = "Delete from firmy where id_firma =".$id_firma.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            $this->close();
        }

        function updateFirma($id_firma, $nazwa, $nazwacd, $nip, $id_numer_kierunkowy, $numer_telefonu, $adres_e_mail)
        {
            $query = "UPDATE `firmy` SET `nazwa`='".$nazwa."',`nazwa_cd`='".$nazwacd."',`nip`='".$nip."',`id_numer_kierunkowy`='".$id_numer_kierunkowy."',`numer_telefonu`='".$numer_telefonu."',`adres_e_mail`=''".$adres_e_mail."' WHERE `id_firma`=".$id_firma.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../index_admin.php');
            $this->close();
        }
    }
?>