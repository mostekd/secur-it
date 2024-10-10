<?php
    include("db_connection.php");
    class db_konta extends db_connection{
        function selectKonto(){
            $query = "SELECT * FROM `konta` WHERE login='$username' AND haslo='$encrypted'";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertKonto ($imie, $nazwisko, $PESEL, $email, $comments){
            $query = "INSERT INTO `konta`(`id_konto`, `id_administrator`, `id_pracownik`, `id_klient`, `imie`, `nazwisko`, `id_nick`, `adres_e_mail`, `id_numer_kierunkowy`, `numer_telefonu`, `login`, `haslo`) VALUE ('".$imie."','".$nazwisko."','".$email."','".$email."','".$comments."');";
            $data = mysqli_query($this->connect, $query);
            header('location: ../BO/student_list.php'); 
            $this->close();
        }

        function deleteKonto ($id_konto){
            $query = "Delete from konta where id_konto =".$id_konto.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ./student_list.php');   
            $this->close();
        }

        function updateKonto ($id_ucznia, $imie, $nazwisko, $PESEL, $email, $comments){
            $query = "UPDATE `uczen` SET `id_administrator`='".$id_administrator."',`id_pracownik`='".$id_pracownik."',`id_klient`='".$id_klient."',`imie`='".$imie."',`nazwisko`='".$nazwisko."' WHERE `id_konto`=".$id_konto.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../BO/student_list.php');   
            $this->close();
        }

        function selectKontoById ($id_konto){
            $query = "SELECT * FROM `konta` WHERE id_konto =".$id_konto;
            $data = mysqli_query($this->connect, $query);

            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }
    }
?>