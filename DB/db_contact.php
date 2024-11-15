<?php
    include_once("db_connection.php");
    class db_contact extends db_connection{
        function selectContact(){
            $query = 'SELECT fk.*, nk.numer_kierunkowy FROM `formularz_kontaktowy` AS fk
            JOIN numery_kierunkowe AS nk ON nk.id_numer_kierunkowy = fk.id_numer_kierunkowy
            WHERE 1;';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertContact ($imie, $nazwisko, $email, $id_numer_kierunkowy, $numer_telefonu, $tytul, $wiadomosc, $czy_zgoda){
            $query = "INSERT INTO `formularz_kontaktowy`(`imie`, `nazwisko`, `e_mail`, `id_numer_kierunkowy`, `numer_telefonu`, `tytul`, `wiadomosc`, `czy_zgoda`) VALUES ('".$imie."','".$nazwisko."','".$email."','".$id_numer_kierunkowy."','".$numer_telefonu."','".$tytul."','".$wiadomosc."','".$czy_zgoda."');";
            $data = mysqli_query($this->connect, $query);
            if ($data) {
                $this->close();
                $$_GET = array();
                return 1; // Wiadomosc wysłana
            }
        }

        function deleteContact($id_formularz_kontaktowy){
            $query = "Delete from formularz_kontaktowy where id_formularz_kontaktowy =".$id_formularz_kontaktowy.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ./student_list.php');   
            $this->close();
        }

        function updateContact($id_formularz_kontaktowy, $imie, $nazwisko, $email, $id_numer_kierunkowy, $numer_telefonu, $tytul, $wiadomosc, $czy_zgoda){
            $query = "UPDATE `formularz_kontaktowy` SET `imie`=".$imie.",`nazwisko`=".$nazwisko.",`e_mail`=".$email.",`id_numer_kierunkowy`=".$id_numer_kierunkowy.",`numer_telefonu`=".$numer_telefonu.",`tytul`=".$tytul.",`wiadomosc`=".$wiadomosc.",`czy_zgoda`=".$czy_zgoda." WHERE  `id_formularz_kontaktowy`=".$id_formularz_kontaktowy.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../BO/student_list.php');   
            $this->close();
        }

        function selectContactByID($id_formularz_kontaktowy){
            $query = "SELECT * FROM `formularz_kontaktowy` WHERE id_formularz_kontaktowy =".$id_formularz_kontaktowy;
            $data = mysqli_query($this->connect, $query);

            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }
    }
?>