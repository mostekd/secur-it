<?php
    include("db_connection.php");
    class db_konta extends db_connection{
        function selectKlient($login, $encrypted){
            $query = "SELECT * FROM `konta` WHERE nick='$login' AND haslo='$encrypted'";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }

        function rejestrujKlienta ($imie, $nazwisko, $nazwa_firmy, $nip, $nick, $adres_e_mail, $id_numer_kierunkowy, $numer_telefonu, $haslo){
            $query = "SELECT id_firmid_uzytkownik AS res FROM uzytkownicy WHERE nick = '".$nick."'";
            if($nazwa_firmy != '')
            {
                $query .= " UNION ";
                $query .= "SELECT id_firma AS res FROM firmy WHERE nazwa = '".$nazwa_firmy."'";
            }
            $data = mysqli_query($this->connect, $query);
            if(mysqli_num_rows($data) == 0)
            {
                $query = "INSERT INTO `uzytkownicy`(`imie`, `nazwisko`, `id_numer_kierunkowy`, `numer_telefonu`, `adres_e_mail`) VALUES ('".$imie."','".$nazwisko."','".$id_numer_kierunkowy."','".$numer_telefonu."','".$adres_e_mail."');";
           
                $data = mysqli_query($this->connect, $query);
                if($data) 
                {
                    $id_klient = $this->connect->insert_id;
                    
                    $query = "INSERT INTO `konta`(`id_klient`, `nick`, `haslo`) VALUES ('".$id_klient."','".$nick."','".$haslo."')";
                    $data = mysqli_query($this->connect, $query);
                    if($data) 
                    {
                        $this->close();
                        $_POST = array();
                        return 1; //OK
                    }
                    else{
                        mysqli_rollback($this->connect);
                        return 4; //rollback
                    }     
                }
                else{
                   return 2; //nie wstawiono dnaych do tabeli klient
                }
            }
            else{
                return 3; //jesli jest juz taki nick w bazie
            }
        }

        function deleteKlient ($id_konto){
            $query = "Delete from konta where id_konto =".$id_konto.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            $this->close();
        }

        function updateklient ($id_konto, $id_administrator, $id_pracownik, $id_klient, $imie, $nazwisko, $id_nick, $adres_e_mail, $id_numer_kierunkowy, $numer_telefonu, $haslo){
            $query = "UPDATE `uczen` SET `id_administrator`='".$id_administrator."',`id_pracownik`='".$id_pracownik."',`id_klient`='".$id_klient."',`imie`='".$imie."',`nazwisko`='".$nazwisko."',`id_nick`='".$id_nick."',`adres_e_mail`='".$adres_e_mail."',`id_numer_kierunkowy`='".$id_numer_kierunkowy."',`numer_telefonu`='".$numer_telefonu."',`haslo`='".$haslo."' WHERE `id_konto`=".$id_konto.";";
            $data = mysqli_query($this->connect, $query);
            unset($_GET['id']);
            header('location: ../index_admin.php');   
            $this->close();
        }

        function selectKontoById ($id_konto){
            $query = "SELECT `id_klient`, `nick`, `haslo` FROM `konta` WHERE id_konto =".$id_konto;
            $data = mysqli_query($this->connect, $query);
            if($data)
            {
                $query = "SELECT * FROM `klienci` WHERE id_klient =".$id_klient;
                $data = mysqli_query($this->connect, $query);

                if (mysqli_num_rows($data) > 0) {
                    return $data;
                }
            }
        }
    }
?>