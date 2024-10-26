
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $haslo = sha1($_GET['haslo']);

        // Obsługa zapisu danych do bazy
        $return = $baza->rejestrujKlienta($imie, $nazwisko, $nazwa_firmy, $nip, $nick, $adres_e_mail, $id_numer_kierunkowy, $numer_telefonu, $haslo);
        if(isset($return)){
            switch($return) {
                case 1:
                    header("Location: ./logowanie.php");
                    break;
                case 2:
                    header("Location: ./rejestracja.php?echo=blad1");
                    echo "Bład strony";
                    break;
                case 3:
                    header("Location: ./rejestracja.php?echo=blad2");
                    break;
                case 4:
                    header("Location: ./rejestracja.php?echo=blad3");
                    break;
                default:
                    header("Location: ./rejestracja.php?echo=".$return."");
                    break;
            }
        } else {
            header("Location: ./rejestracja.php?echo=else");
        }
        exit();
    }
?>

<div class="form-group">
    <label for="haslo">Hasło:</label>
    <input type="password" id="haslo" name="haslo" placeholder="Wpisz hasło" required>
</div>