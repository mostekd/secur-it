<?php
    include("db_connection.php");
    class db_uslugi extends db_connection{
        function selectUslugi_sieci(){
            $query = 'SELECT * FROM `uslugi` WHERE id_typ_uslugi = 1';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }
        
        function selectUslugi_systemy(){
            $query = 'SELECT * FROM `uslugi` WHERE id_typ_uslugi = 2';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function selectUslugi_bazy_danych(){
            $query = 'SELECT * FROM `uslugi` WHERE id_typ_uslugi = 3';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function selectUslugi_strony_internetowe(){
            $query = 'SELECT * FROM `uslugi` WHERE id_typ_uslugi = 4';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function selectUslugi_serwis_komputerowy(){
            $query = 'SELECT * FROM `uslugi` WHERE id_typ_uslugi = 5';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertUslugi ($nazwa, $opis, $cena){
            $query = "INSERT INTO `uslugi`(`nazwa`, `opis`, `cena`) VALUES ('".$nazwa."','".$opis."','".$cena."');";
            $data = mysqli_query($this->connect, $query);
            header('location: ../BO/uslugi.php'); 
            $this->close();
        }

        function deleteUslugi ($id_uslugi){
            $query = "Delete from uslugi where id_uslugi =".$id_uslugi.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../BO/uslugi.php'); 
            $this->close();
        }

        function updateUslugi ($id_uslugi, $nazwa, $opis, $cena){
            $query = "UPDATE `uslugi` SET `nazwa`='".$nazwa."',`opis`='".$opis."',`cena`='".$cena.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../BO/uslugi.php');  
            $this->close();
        }
    }
?>
