<?php
include("db_connection.php");

class db_konta extends db_connection
    {
        function selectKlient($login, $encrypted)
        {
            $query = "SELECT * FROM `konta` WHERE nick='$login' AND haslo='$encrypted'";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0)
            {
                return $data;
            }
        }

        function rejestrujKlienta($nazwa_firmy = '', $nazwa_cd = '', $nip = '', $id_numer_kierunkowy, $numer_telefonu_firma = '',$numer_telefonu = '', $adres_e_mail, $imie, $nazwisko, $nick, $haslo)
        {
            $query = "SELECT id_uzytkownik AS uzytkownik FROM uzytkownicy WHERE nick = '".$nick."'";
            if($nazwa_firmy != '')
            {
                $query .= " UNION ";
                $query .= "SELECT id_firma AS firma FROM firmy WHERE nazwa = '".$nazwa_firmy."'";
            }
            $data = mysqli_query($this->connect, $query);
        
            if(mysqli_num_rows($data) == 0 and $nazwa_firmy != '')
            {
				if($nazwa_firmy != '')
				{
					$nazwa_firmy = $nazwa_firmy;
					$nazwa_cd = $nazwa_cd;
					$nip = $nip;
					$id_numer_kierunkowy = $id_numer_kierunkowy;
					$numer_telefonu_firma = $numer_telefonu_firma;
					$numer_telefonu = null;
					$adres_e_mail = $adres_e_mail;
				}
				else
				{
					$nazwa_firmy = null;
					$nazwa_cd = null;
					$nip = null;
					$id_numer_kierunkowy = $id_numer_kierunkowy;
					$numer_telefonu = $numer_telefonu;
					$numer_telefonu_firma = null;
					$adres_e_mail = $adres_e_mail;
				}
				$query = "INSERT INTO `firmy`(`nazwa`, `nazwa_cd`, `nip`, `id_numer_kierunkowy`, `numer_telefonu`, `adres_e_mail`) VALUES('".$nazwa_firmy."','".$nazwa_cd."','".$nip."','".$id_numer_kierunkowy."','".$numer_telefonu_firma."','".$adres_e_mail."')";
				$data = mysqli_query($this->connect, $query);
				$id_firma = $this->connect->insert_id;
				
				if($data)
				{        
					$query = "INSERT INTO `uzytkownicy`(`id_administrator`, `id_pracownik`, `id_firma`, `imie`, `nazwisko`, `id_numer_kierunkowy`, `numer_telefonu`, `adres_e_mail`, `nick`, `haslo`, `id_rabat`) VALUES(null, null,'".$id_firma."','".$imie."','".$nazwisko."','".$id_numer_kierunkowy."','".$numer_telefonu."','".$adres_e_mail."','".$nick."','".$haslo."', null)";
					$data = mysqli_query($this->connect, $query);
					if ($data)
					{
						$this->close();
						$_POST = array();
						return 1; // OK
					}
					else 
					{
						mysqli_rollback($this->connect);
						return 4; // rollback
					}
				}
				else 
				{
					return 2; // nie wstawiono dnaych do tabeli klient
				}
			}
            else 
            {
                return 3; // jesli jest juz taki nick w bazie
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
            $query = "UPDATE `uzytkownicy` SET `id_administrator`='".$id_administrator."',`id_pracownik`='".$id_pracownik."',`id_firma`='".$id_firma."',`imie`='".$imie."',`nazwisko`='".$nazwisko."',`id_numer_kierunkowy`='".$id_numer_kierunkowy."',`numer_telefonu`='".$numer_telefonu."',`adres_e_mail`='".$adres_e_mail."'`nick`='".$nick."',,`haslo`='".$haslo."' WHERE `id_uzytkownik`=".$id_uzytkownik.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../index_admin.php');
            $this->close();
        }
    
        function selectKontoById($id_uzytkownik, $id_firma)
        {
            $query = "SELECT * FROM `uzytkownicy` WHERE id_uzytkownik =".$id_uzytkownik;
            $data = mysqli_query($this->connect, $query);
            return $data;
            if ($data)
            {
                $query = "SELECT * FROM `firmy` WHERE id_firma =".$id_firma;
                $data = mysqli_query($this->connect, $query);
        
                if (mysqli_num_rows($data) > 0) 
                {
                    return $data;
                }
            }
        }
    }
?>
