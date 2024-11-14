<?php
    include_once("db_connection.php");
    class db_wpisy extends db_connection{
        function selectKonto(){
            $query = "SELECT * FROM `wpisy` WHERE login='$username' AND haslo='$encrypted'";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertWpis ($id_konto, $tytul, $tresc, $data_dodania){
            $query = "INSERT INTO `wpisy`(`imie`, `nazwisko`, `e_mail`, `numer_telefonu`, `tytul`, `wiadomosc`) VALUES ('".$imie."','".$nazwisko."','".$email."','".$email."','".$comments."');";
            $data = mysqli_query($this->connect, $query);
            header('location: ../BO/student_list.php'); 
            $this->close();
        }

        function deleteWpis ($id_wpis){
            $query = "Delete from wpisy where id_wpis =".$id_wpis.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ./student_list.php');   
            $this->close();
        }

        function updateWpis ($id_wpis, $imie, $nazwisko, $PESEL, $email, $comments){
            $query = "UPDATE `uczen` SET `imie`='".$imie."',`nazwisko`='".$nazwisko."',`PESEL`='".$PESEL."',`email`='".$email."',`comments`='".$comments."' WHERE `id_wpis`=".$id_wpis.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../BO/student_list.php');   
            $this->close();
        }

        function selectCheckWpis (){
            $query = "SELECT `id_wpis`, `id_uzytkownik`, `tytul`, `tresc`, `data_zatwierdzenia` FROM `wpisy` WHERE data_zatwierdzenia != 0";
            $data = mysqli_query($this->connect, $query);

            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }
    }
?>

