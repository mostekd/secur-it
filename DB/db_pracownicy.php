<?php
    include("db_connection.php");
    class db_pracownicy extends db_connection{
        function selectPracownikById($id_pracownik){
            $query = "SELECT u.imie, u.nazwisko, u.id_numer_kierunkowy, nk.numer_kierunkowy u.numer_telefonu, u.adres_e_mail, p.adres_zamieszkania, p.data_urodzenia, p.zdjecie, u.*, s.nazwa, d.nazwa_dzialu
            FROM `uzytkownicy` as u 
            JOIN numery_kierunkowe as nk ON nk.id_numer_kierunkowy = u.id_numer_kierunkowy 
            JOIN pracownicy as p ON u.id_pracownik = p.id_pracownik
            JOIN umowy as um ON p.id_umowa = um.id_umowa
            JOIN lokalizacja as l on um.id_lokalizacja = l.id_lokalizacja
            JOIN stanowiska AS s ON p.id_stanowisko = s.id_stanowisko 
            left JOIN dzialy AS d ON um.id_dzial = d.id_dzial
            WHERE id_pracownik =".$id_pracownik;
            $data = mysqli_query($this->connect, $query);
            
            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }
        function selectPracownik(){
            $query = 'SELECT u.id_pracownik, u.imie, u.nazwisko, p.zdjecie, s.nazwa, d.nazwa_dzialu 
            FROM uzytkownicy AS u
            JOIN pracownicy as p ON u.id_pracownik = p.id_pracownik
            JOIN stanowiska AS s ON p.id_stanowisko = s.id_stanowisko 
            JOIN umowy as um ON p.id_umowa = um.id_umowa
            left JOIN dzialy AS d ON um.id_dzial = d.id_dzial
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
