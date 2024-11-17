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
        <title>Secur IT | Kontakt</title>
    </head>
    <body>
        <?php
            include("../DB/db_connection.php");
            include('../DB/db_numery_kierunkowe.php');
            include('../DB/db_contact.php');
            $baza = new db_contact();

            if(!empty($_GET)){
                $baza->databaseConnect();
                if(isset($_GET['opcja'])){
                    if($_GET['opcja'] == 'dodaj'){
                        $imie = $_GET['imie'];
                        $nazwisko = $_GET['nazwisko'];
                        $email = $_GET['e_mail'];
                        $id_numer_kierunkowy = $_GET['id_numer_kierunkowy'];
                        $numer_telefonu = $_GET['numer_telefonu'];
                        $tytul = $_GET['tytul'];
                        $wiadomosc = $_GET['wiadomosc'];
                        $czy_zgoda = 0;
                        if(isset($_GET['czy_zgoda'])){
                            $czy_zgoda = 1;
                        }
                        $baza->insertContact ($imie, $nazwisko, $email, $id_numer_kierunkowy, $numer_telefonu, $tytul, $wiadomosc, $czy_zgoda);
                        if(isset($baza)){
                            switch($baza){
                                case 1:
                                    echo "<script>alert('Wiadomość została wysłana')</script>";
                                    header('location: ./contact.php');
                                    break;
                                default:
                                    header("Location: ./contact.php?echo=".$baza."");
                                    break;
                            }
                        }
                    }
                }
                else{
                    echo "<p>Wiadomość nie została wysłana</p>";
                }
            }    
        ?>
        <div class="tlo"></div>
        <main class="main">
            <?php
                include("header.php");
                include("nav.php");
            ?>
            <div class="spinaczcenter"> 
                <div class="formularz">
                    <form id="MyForm" method="get">
                        <?php
                            $isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
                            $userData = [];

                            if ($isLoggedIn) {
                                $id_uzytkownik = $_SESSION['id_uzytkownik'];
                                $konto = new db_konta();
                                $konto->databaseConnect();
                                $result = $konto->selectKontoById($id_uzytkownik, null);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $userData = mysqli_fetch_assoc($result);
                                }
                                $konto->close();
                            }
                        ?>
                        <label>
                            <input type="checkbox" id="useOtherData" onclick="toggleUserData(this)">
                            Użyj innych danych
                        </label>
                        <br><br>

                        Imię:
                        <br>
                        <input type="text" placeholder="Imię" name="imie" id="imie" alt="pole imię" 
                               value="<?php echo $isLoggedIn ? ($userData['imie']) : ''; ?>" 
                               <?php echo $isLoggedIn ? 'readonly data-default-value="'.($userData['imie']).'"' : ''; ?>>
                        <br>
                        Nazwisko:
                        <br>
                        <input type="text" placeholder="Nazwisko" name="nazwisko" id="nazwisko" alt="pole nazwisko"
                               value="<?php echo $isLoggedIn ? ($userData['nazwisko']) : ''; ?>" 
                               <?php echo $isLoggedIn ? 'readonly data-default-value="'.($userData['nazwisko']).'"' : ''; ?>>
                        <br>
                        Adres e-mail:
                        <br>
                        <input type="email" placeholder="Adres e-mail" name="e_mail" id="e_mail" alt="pole e-mail" 
                               value="<?php echo $isLoggedIn ? ($userData['uae']) : ''; ?>" 
                               <?php echo $isLoggedIn ? 'readonly data-default-value="'.($userData['uae']).'"' : ''; ?>>
                        <br>
                        Numer Telefonu:
                        <br>
                        <div class="phonenumber">
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
                                if ($data){
                                    
                                echo '<div class="phone_number">';
                                echo '<select class="kierunkowy" name="id_numer_kierunkowy" default="">';
                                while ($row = mysqli_fetch_assoc($data)){
                                    $text = '<option id="pole" class="kierunkowy"';
                                    if($row["id_numer_kierunkowy"] == $selectedId)
                                    {
                                    $text .= 'selected = "selected"';
                                    } 
                                    $text .= ' value=' .$row["id_numer_kierunkowy"] .'> ' .$row["numer_kierunkowy"]. " " .$row["kraj"] .'</option>';

                                    echo $text;
                                }
                                    echo '</select>';

                                    mysqli_free_result($data);
                                } else {
                                    echo "Błąd zapytania: " .mysqli_error($connection);
                                }
                                
                                $baza->close();
                            ?>
                            <input type="tel" placeholder="Numer Telefonu" name="numer_telefonu" id="numer_telefonu" alt="pole numer telefonu" 
                               value="<?php echo $isLoggedIn ? ($userData['unt']) : ''; ?>" 
                               <?php echo $isLoggedIn ? 'readonly data-default-value="'.($userData['unt']).'"' : ''; ?>>
                            </div>
                        </div>
                        <br>
                        Tytuł:
                        <br>
                        <input type="text" placeholder="Tytuł" name="tytul" id="tytul" alt="pole tytuł">
                        <br>
                        Wiadomość:
                        <br>
                        <textarea name="wiadomosc" placeholder="Treść Wiadomości" id="wiadomosc"></textarea>
                        <br><br>
                        Zgoda na przetwarzanie danych:
                        <br><br>
                        <input type="checkbox" name="czy_zgoda" required>
                        <span> Wyrażam zgodę na przetwarzanie moich danych osobowych przez firmę Secur IT Sp. z o.o.w celu odpowiedzi na wiadomość skierowaną z wykorzystaniem funkcjonalności strony internetowej secur-it.pl i dalszej wymiany korespondencji oraz oświadczam, 
                        że zapoznałem się z treścią informacji o przetwarzaniu danych osobowych dostępnej w <a href="./polityka_prywatności.html">polityce prywatności</a></span>
                        <br><br>
                        <input type="hidden" name="opcja" id="opcja" value="dodaj">
                        <button type="submit" name="submit" class="przycisk">Wyślij</button>
                        <input type="button" value="Resetuj" onclick="resetujPola()" class="przycisk">
                    </form><br>
                </div>
                <i class="fa-solid fa-phone"></i>+48123456789
                <i class="fa-solid fa-at"></i>contact@secut-it.pl
            </div>
        </main>
    </body>
</html>