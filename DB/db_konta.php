<?php
include_once("db_connection.php");
class db_konta extends db_connection
    {
        function selectKlient($login, $encrypted)
        {
            $query = "SELECT * FROM `uzytkownicy` AS u LEFT JOIN pracownicy AS p ON u.id_pracownik = p.id_pracownik WHERE nick='$login' AND haslo='$encrypted'";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0)
            {
                return $data;
            }
        }

        function rejestrujKlienta($id_firma = null, $nazwa_firmy = '', $nazwa_cd = '', $nip = '', $id_numer_kierunkowy, $id_numer_kierunkowy_firma = '', $numer_telefonu_firma = '', $numer_telefonu = '', $adres_e_mail = '', $adres_e_mail_firma = '', $imie, $nazwisko, $nick, $haslo, $czy_admin_firmy = '0')
        {
            // Krok 1: Sprawdzenie, czy użytkownik o podanym nicku lub firma o podanej nazwie już istnieją
            $query = "SELECT id_uzytkownik AS uzytkownik FROM uzytkownicy WHERE nick = '".$nick."'";
            if ($nazwa_firmy != '') {
                $query .= " UNION ";
                $query .= "SELECT id_firma AS firma FROM firmy WHERE nazwa = '".$nazwa_firmy."'";
            }
            $data = mysqli_query($this->connect, $query);

            // Krok 2: Jeśli nie istnieje użytkownik lub firma o podanych danych, przechodzimy do rejestracji
            if (mysqli_num_rows($data) == 0) {
                // Sprawdzenie, czy podano nazwę firmy
                if ($nazwa_firmy != '') {
                    // Rejestracja firmy
                    $query = "INSERT INTO `firmy`(`nazwa`, `nazwa_cd`, `nip`, `id_numer_kierunkowy`, `numer_telefonu`, `adres_e_mail`) VALUES('".$nazwa_firmy."', '".$nazwa_cd."', '".$nip."', '".$id_numer_kierunkowy_firma."', '".$numer_telefonu_firma."', '".$adres_e_mail_firma."')";
                    $data = mysqli_query($this->connect, $query);
                    $id_firma = $this->connect->insert_id;

                    if ($data) {
                        // Ustawienie użytkownika jako administratora firmy
                        $czy_admin_firmy = 1;
                    } else {
                        return 2; // Błąd przy tworzeniu firmy. Spróbuj ponownie.
                    }
                }

                // Krok 3: Rejestracja użytkownika
                $query = "INSERT INTO `uzytkownicy`(`id_pracownik`, `id_firma`, `imie`, `nazwisko`, `id_numer_kierunkowy`, `numer_telefonu`, `adres_e_mail`, `nick`, `haslo`, `czy_admin_firmy`, `id_rabat`) VALUES (null, '".$id_firma."', '".$imie."', '".$nazwisko."', '".$id_numer_kierunkowy."', '".$numer_telefonu."', '".$adres_e_mail."', '".$nick."', '".$haslo."', '".$czy_admin_firmy."', null)";
                $data = mysqli_query($this->connect, $query);

                if ($data) {
                    $this->close();
                    $_POST = array();
                    return 1; // Rejestracja zakończona sukcesem
                } else {
                    mysqli_rollback($this->connect);
                    return 4; // Użytkownik o takim loginie już istnieje. Wybierz inny login
                }
            } else {
                // Krok 4: Firma już istnieje, przekazanie użytkownikowi informacji o kontakcie z administratorem
                return 3; // Firma o takiej nazwie już istnieje. Skontaktuj się z administratorem firmy
            }
        }
    
        function deleteKlient($id_uzytkownik)
        {
            $query = "Delete from konta where id_uzytkownik =".$id_uzytkownik.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            $this->close();
        }
    
        function updateklient($id_uzytkownik, $id_administrator, $id_pracownik, $id_firma, $imie, $nazwisko, $id_numer_kierunkowy, $numer_telefonu, $adres_e_mail, $nick, $haslo)
        {
            $query = "UPDATE `uzytkownicy` SET `id_administrator`='".$id_administrator."',`id_pracownik`='".$id_pracownik."',`id_firma`='".$id_firma."',`imie`='".$imie."',`nazwisko`='".$nazwisko."',`id_numer_kierunkowy`='".$id_numer_kierunkowy."',`numer_telefonu`='".$numer_telefonu."',`adres_e_mail`='".$adres_e_mail."'`nick`='".$nick."',`haslo`='".$haslo."' WHERE `id_uzytkownik`=".$id_uzytkownik.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../index_admin.php');
            $this->close();
        }
    
        function selectKontoById($id_uzytkownik, $id_firma)
        {
            $query = "SELECT u.id_uzytkownik, u.id_firma, u.imie, u.nazwisko, u.id_numer_kierunkowy, nk1.numer_kierunkowy as unk, u.numer_telefonu as unt, u.adres_e_mail as uae, u.nick, u.haslo, u.czy_admin_firmy, f.nazwa, f.nazwa_cd, f.nip, f.id_numer_kierunkowy, nk2.numer_kierunkowy as fnk, f.numer_telefonu as fnt, f.adres_e_mail as fae
            FROM uzytkownicy as u
            JOIN numery_kierunkowe as nk1 ON nk1.id_numer_kierunkowy = u.id_numer_kierunkowy 
            JOIN firmy as f ON f.id_firma = u.id_firma
            JOIN numery_kierunkowe as nk2 ON nk2.id_numer_kierunkowy = f.id_numer_kierunkowy 
            WHERE id_uzytkownik =".$id_uzytkownik;
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0) 
            {
                return $data;
            }
        }
        function selectKontoByIdFirma($id_firma)
        {
            $query = "SELECT u.id_uzytkownik, u.id_firma, u.imie, u.nazwisko, u.id_numer_kierunkowy, nk1.numer_kierunkowy as unk, u.numer_telefonu as unt, u.adres_e_mail as uae, u.nick, u.haslo, u.czy_admin_firmy
            FROM uzytkownicy as u
            JOIN numery_kierunkowe as nk1 ON nk1.id_numer_kierunkowy = u.id_numer_kierunkowy
            WHERE u.id_firma =".$id_firma;
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0) 
            {
                return $data;
            }
        }
    }
?>
