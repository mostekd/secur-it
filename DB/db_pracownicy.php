<?php
    include("db_connection.php");
    class db_pracownicy extends db_connection{
        function selectPracownik(){
            $query = 'SELECT pracownicy.imie, pracownicy.nazwisko, pracownicy.zdjecie, stanowiska.nazwa, dzialy.nazwa_dzialu 
            FROM pracownicy 
            JOIN stanowiska ON pracownicy.id_stanowisko = stanowiska.id_stanowisko 
            left JOIN dzialy ON pracownicy.id_dzial = dzialy.id_dzial
            WHERE 1';

            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }
        function selectPracownikAll(){
            $query = 'SELECT * FROM `pracownicy` WHERE 1';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function insertPracownik ($imie, $nazwisko, $adres_zamieszkania, $id_numer_kierunkowy, $numer_telefonu, $adres_e_mail, $PESEL, $numer_umowy, $numer_ubezpieczenia, $data_urodzenia, $data_zatrudnienia, $wynagrodzenie, $zdjecie, $id_stanowisko, $id_lokalizacja_pracy, $id_dzial, $id_samochod){
            $query = "INSERT INTO `pracownicy`(`imie`, `nazwisko`, `adres_zamieszkania`, `id_numer_kierunkowy`, `numer_telefonu`, `adres_e_mail`, `PESEL`, `numer_umowy`, `numer_ubezpieczenia`, `data_urodzenia`, `data_zatrudnienia`, `wynagrodzenie`, `zdjecie`, `id_stanowisko`, `id_lokalizacja_pracy`, `id_dzial`, `id_samochod`) VALUES ('".$imie."','".$nazwisko."','".$adres_zamieszkania."','".$id_numer_kierunkowy."','".$numer_telefonu."','".$adres_e_mail."','".$PESEL."','".$numer_umowy."','".$numer_ubezpieczenia."','".$data_urodzenia."','".$data_zatrudnienia."','".$wynagrodzenie."','".$zdjecie."','".$id_stanowisko."','".$id_lokalizacja_pracy."','".$id_dzial."','".$id_samochod."',);";
            $data = mysqli_query($this->connect, $query);
            header('location: ../BO/pracownicy.php'); 
            $this->close();
        }

        function deletePracownik($id_pracownik){
            $query = "Delete from pracownicy where id_pracownik =".$id_pracownik.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../BO/pracownicy.php'); 
            $this->close();
        }

        function updatePracownik($id_pracownik, $imie, $nazwisko, $adres_zamieszkania, $id_numer_kierunkowy, $numer_telefonu, $adres_e_mail, $PESEL, $numer_umowy, $numer_ubezpieczenia, $data_urodzenia, $data_zatrudnienia, $wynagrodzenie, $zdjecie, $id_stanowisko, $id_lokalizacja_pracy, $id_dzial, $id_samochod){
            $query = "UPDATE `pracownicy` SET `imie`='".$imie."',`nazwisko`='".$nazwisko."',`adres_zamieszkania`='".$adres_zamieszkania."',`id_numer_kierunkowy`='".$id_numer_kierunkowy."',`numer_telefonu`='".$numer_telefonu."',`adres_e_mail`='".$adres_e_mail."',`PESEL`='".$PESEL."',`numer_umowy`='".$numer_umowy."',`numer_ubezpieczenia`='".$numer_ubezpieczenia."',`data_urodzenia`='".$data_urodzenia."',`data_zatrudnienia`='".$data_zatrudnienia."',`wynagrodzenie`='".$wynagrodzenie."',`zdjecie`='".$zdjecie."',`id_stanowisko`='".$id_stanowisko."',`id_lokalizacja_pracy`='".$id_lokalizacja_pracy."',`id_dzial`='".$id_dzial."',`id_samochod`='".$id_samochod.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../BO/pracownicy.php');  
            $this->close();
        }
    }
?>
