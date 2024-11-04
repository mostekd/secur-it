<?php
    include('../DB/db_konta.php');
    $baza = new db_konta();
    $baza->databaseConnect();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $typ_konta = $_POST['typ_konta'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $nazwa_firmy = ($typ_konta == 'firma') ? $_POST['nazwa_firmy'] : '';
        $nazwa_cd = ($typ_konta == 'firma') ? $_POST['nazwa_firmy_cd'] : '';
        $nip = ($typ_konta == 'firma') ? $_POST['nip'] : '';
        $nick = $_POST['nick'];
        $adres_e_mail = $_POST['adres_e_mail'];
        $adres_e_mail_firma = $_POST['adres_e_mail_firma'];
        $id_numer_kierunkowy = $_POST['id_numer_kierunkowy'];
        $numer_telefonu_firma = $_POST['numer_telefonu_firma'];
        $numer_telefonu = $_POST['numer_telefonu'];
        $haslo = sha1($_POST['haslo']);

        // Obsługa zapisu danych do bazy
        $return = $baza->rejestrujKlienta($nazwa_firmy, $nazwa_cd, $nip, $id_numer_kierunkowy, $numer_telefonu_firma, $numer_telefonu, $adres_e_mail, $imie, $nazwisko, $nick, $haslo);
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
                    <div class="form-group">
                        <label for="typ_konta">Wybierz typ konta:</label>
                        <input type="radio" id="firma" name="typ_konta" value="firma" checked>
                        <label for="firma">Firma</label>
                        <input type="radio" id="osoba_publiczna" name="typ_konta" value="osoba_publiczna">
                        <label for="osoba_publiczna">Osoba publiczna</label>
                        <div class="firma">
                            <label for="nazwa_firmy">Nazwa firmy:</label>
                            <input type="text" id="nazwa_firmy" name="nazwa_firmy" placeholder="Wpisz nazwę firmy">
                            <br>
                            <label for="nazwa_firmy">Nazwa firmy c.d.:</label>
                            <input type="text" id="nazwa_firmy_cd" name="nazwa_firmy_cd" placeholder="Wpisz nazwę firmy">
                            <br>
                            <label for="nip">NIP:</label>
                            <input type="text" id="nip" name="nip" placeholder="Wpisz NIP firmy">
                            <br>
                            <label for="adres_e_mail_firma">Email firmy:</label>
                            <input type="email" id="adres_e_mail_firma" name="adres_e_mail_firma" placeholder="Wpisz email firmy" required>
                            <br>
                            <label for="numer_telefonu_firma" id="numer_telefonu_firma_txt" >Numer telefonu firmy:</label>
                            <?php
                                include('../DB/db_numery_kierunkowe.php');
                                $baza = new db_numery_kierunkowe();
                                $baza->databaseConnect();
                                
                                $dataPolska = $baza->selectNrKierunkowePolska();
                                if ($dataPolska){
                                    while ($row = mysqli_fetch_assoc($dataPolska)){
                                        $selectedId = $row["id_numer_kierunkowy"];
                                    } 
                                }
                                
                                $data = $baza->selectNrKierunkowe();
                                if ($data)
                                {
                                    echo '<div class="phone_number">';
                                    echo '<select class="kierunkowy" name="id_numer_kierunkowy" default="">';
                                    while ($row = mysqli_fetch_assoc($data))
                                    {
                                        $text = '<option id="pole" class="kierunkowy"';
                                        if($row["id_numer_kierunkowy"] == $selectedId)
                                        {
                                        $text .= 'selected = "selected"';
                                        } 
                                        $text .= ' value=' .$row["id_numer_kierunkowy"] .'> ' .$row["numer_kierunkowy"]. " " .$row["kraj"] .'</option>';

                                        echo $text;
                                    }
                                    echo '</select>';
                                    echo '</div>';
                                    mysqli_free_result($data);
                                } 
                                else 
                                {
                                    echo "Błąd zapytania: " .mysqli_error($connect);
                                }
                                $baza->close();
                            ?>
                            <input type="text" id="numer_telefonu_firma" name="numer_telefonu_firma" placeholder="Wpisz numer telefonu firmy" required>  
                        </div>
                        <br>
                        <label for="imie">Imię:</label>
                        <input type="text" id="imie" name="imie" placeholder="Wpisz imię">
                        <br>
                        <label for="nazwisko">Nazwisko:</label>
                        <input type="text" id="nazwisko" name="nazwisko" placeholder="Wpisz nazwisko">
                        <br>
                        <label for="nick">Nazwa użytkownika (Nick):</label>
                        <input type="text" id="nick" name="nick" placeholder="Wpisz nazwę użytkownika" required>
                        <br>
                        <label for="adres_e_mail">Email:</label>
                        <input type="email" id="adres_e_mail" name="adres_e_mail" placeholder="Wpisz email" required>
                        <br>
                        <label for="numer_telefonu" id="numer_telefonu_txt" >Numer telefonu:</label>
                        <?php
                            $baza = new db_numery_kierunkowe();
                            $baza->databaseConnect();
                            
                            $dataPolska = $baza->selectNrKierunkowePolska();
                            if ($dataPolska){
                                while ($row = mysqli_fetch_assoc($dataPolska)){
                                    $selectedId = $row["id_numer_kierunkowy"];
                                } 
                            }
                            
                            $data = $baza->selectNrKierunkowe();
                            if ($data)
                            {
                                echo '<div class="phone_number">';
                                echo '<select class="kierunkowy" name="id_numer_kierunkowy" default="">';
                                while ($row = mysqli_fetch_assoc($data))
                                {
                                    $text = '<option id="pole" class="kierunkowy"';
                                    if($row["id_numer_kierunkowy"] == $selectedId)
                                    {
                                    $text .= 'selected = "selected"';
                                    } 
                                    $text .= ' value=' .$row["id_numer_kierunkowy"] .'> ' .$row["numer_kierunkowy"]. " " .$row["kraj"] .'</option>';

                                    echo $text;
                                }
                                echo '</select>';
                                echo '</div>';
                                mysqli_free_result($data);
                            } 
                            else 
                            {
                                echo "Błąd zapytania: " .mysqli_error($connect);
                            }
                            $baza->close();
                        ?>
                        <input type="text" id="numer_telefonu" name="numer_telefonu" placeholder="Wpisz numer telefonu:" required>
                        
                        <br>
                        <label for="haslo">Hasło:</label>
                        <input type="password" id="haslo" name="haslo" placeholder="Wpisz hasło" required><br>
                        <button class="button" type="submit">Zarejestruj użytkownika</button>
                    </div>
                </form>
            </div>
        </main>
        <script src="./script.js"></script>
    </body>
</html>
