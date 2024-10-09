<?php
    class db_contact extends db_connection{
        function selectContact(){
            $query = 'SELECT * FROM `formularz_kontaktowy` WHERE 1';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertContact ($imie, $nazwisko, $PESEL, $email, $comments){
            $query = "INSERT INTO `formularz_kontaktowy`(`imie`, `nazwisko`, `e_mail`, `numer_telefonu`, `tytul`, `wiadomosc`) VALUES ('".$imie."','".$nazwisko."','".$email."','".$email."','".$comments."');";
            $data = mysqli_query($this->connect, $query);
            header('location: ../BO/student_list.php'); 
            $this->close();
        }

        function deleteUczen($id_ucznia){
            $query = "Delete from uczen where id_ucznia =".$id_ucznia.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ./student_list.php');   
            $this->close();
        }

        function updateUczen($id_ucznia, $imie, $nazwisko, $PESEL, $email, $comments){
            $query = "UPDATE `uczen` SET `imie`='".$imie."',`nazwisko`='".$nazwisko."',`PESEL`='".$PESEL."',`email`='".$email."',`comments`='".$comments."' WHERE `id_ucznia`=".$id_ucznia.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../BO/student_list.php');   
            $this->close();
        }

        function selectUczenByID($id_ucznia){
            $query = "SELECT * FROM `uczen` WHERE id_ucznia =".$id_ucznia;
            $data = mysqli_query($this->connect, $query);

            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }
    }
?>
