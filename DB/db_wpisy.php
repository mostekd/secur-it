<?php
    class db_konta extends db_connection{
        function selectKonto(){
            $query = "SELECT * FROM `formularz_kontaktowy` WHERE login='$username' AND haslo='$encrypted'";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertKonto ($id_konto, $tytul, $tresc, $data_dodania){
            $query = "INSERT INTO `formularz_kontaktowy`(`imie`, `nazwisko`, `e_mail`, `numer_telefonu`, `tytul`, `wiadomosc`) VALUES ('".$imie."','".$nazwisko."','".$email."','".$email."','".$comments."');";
            $data = mysqli_query($this->connect, $query);
            header('location: ../BO/student_list.php'); 
            $this->close();
        }

        function deleteKonto ($id_wpis){
            $query = "Delete from uczen where id_wpis =".$id_wpis.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ./student_list.php');   
            $this->close();
        }

        function updateKonto ($id_wpis, $imie, $nazwisko, $PESEL, $email, $comments){
            $query = "UPDATE `uczen` SET `imie`='".$imie."',`nazwisko`='".$nazwisko."',`PESEL`='".$PESEL."',`email`='".$email."',`comments`='".$comments."' WHERE `id_wpis`=".$id_wpis.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../BO/student_list.php');   
            $this->close();
        }

        function selectKontoById ($id_wpis){
            $query = "SELECT * FROM `uczen` WHERE id_wpis = 1;
            $data = mysqli_query($this->connect, $query);

            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }
    }
?>