<?php
include("db_connection.php");
class db_o_firmie extends db_connection{
    function selectOFirmie(){
        $query = 'SELECT *FROM `o_firmie` WHERE 1';
        $data = mysqli_query($this->connect, $query);
        if (mysqli_num_rows($data) > 0){
		return $data;
        }
    }

    function insertOFirmie ($tytul, $opis){
        $query = "INSERT INTO `o_firmie`(`tytul`, `opis`) VALUES ('".$tytul."','".$opis."');";
        $data = mysqli_query($this->connect, $query);
        header('location: ../BO/o_firmie.php'); 
        $this->close();
    }

    function deleteOFirmie($id_o_firmie){
        $query = "Delete from o_firmie where id_o_firmie =".$id_o_firmie.";";
        $data = mysqli_query($this->connect, $query);
        unset($_GET['id']);
        header('location: ../BO/o_firmie.php'); 
        $this->close();
    }

    function updateOFirmie($id_o_firmie, $tytul, $opis){
        $query = "UPDATE `o_firmie` SET `tytul`='".$tytul."',`opis`='".$opis.";";
        $data = mysqli_query($this->connect, $query);
        unset($_GET['id']);
        header('location: ../BO/o_firmie.php');  
        $this->close();
    }
}
?>
