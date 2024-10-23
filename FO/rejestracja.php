<?php
    include('../DB/db_konta.php');
    $baza = new db_konta();
    $baza->databaseConnect();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $typ_konta = $_POST['typ_konta'];
        $imie = ($typ_konta == 'osoba_publiczna') ? $_POST['imie'] : '';
        $nazwisko = ($typ_konta == 'osoba_publiczna') ? $_POST['nazwisko'] : '';
        $nazwa_firmy = ($typ_konta == 'firma') ? $_POST['nazwa_firmy'] : '';
        $nip = ($typ_konta == 'firma') ? $_POST['nip'] : '';
        $nick = $_POST['nick'];
        $adres_e_mail = $_POST['adres_e_mail'];
        $id_numer_kierunkowy = $_POST['id_numer_kierunkowy'];
        $numer_telefonu = $_POST['numer_telefonu'];
        $haslo = sha1($_POST['haslo']);

        // Obsługa zapisu danych do bazy
        $return = $baza->insertKonto($imie, $nazwisko, $nazwa_firmy, $nip, $nick, $adres_e_mail, $id_numer_kierunkowy, $numer_telefonu, $haslo);
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
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="./script.js" defer></script>
        <script src="https://kit.fontawesome.com/1deffa5961.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="../images/ikona.png">
        <title>Secur IT | Rejestracja</title>
    </head>
    <body>
        <div class="tlo"></div>
        <main class="main">
            <?php
                include("header.php");
                include("nav.php");
            ?>
            <div id="loginPage" class="login-container">
                <h2>Rejestracja</h2>

                <form method="post" action="rejestracja.php" class="registration-form">
                    <!-- Wybór typu konta -->
                    <div class="form-group">
                        <label for="typ_konta">Wybierz typ konta:</label>
                        <input type="radio" id="firma" name="typ_konta" value="firma" checked>
                        <label for="firma">Firma</label>
                        <input type="radio" id="osoba_publiczna" name="typ_konta" value="osoba_publiczna">
                        <label for="osoba_publiczna">Osoba publiczna</label>
                    </div>

                    <div id="firma_form">
                        <?php
                        include("./firma_form.php");
                        ?>
                    </div>
                    <div id="osoba_publiczna_form">
                        <?php
                        include("uzytkownik_form.php");
                        ?>
                    </div>

                    <div class="form-group">
                        <button class="button" type="submit">Zarejestruj użytkownika</button>
                    </div>
                </form>
            </div>
        </main>
        <script src="./script.js"></script>
    </body>
</html>
