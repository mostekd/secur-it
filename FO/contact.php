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
                        $baza->insertContact ($imie, $nazwisko, $email, $id_numer_kierunkowy, $numer_telefonu, $tytul, $wiadomosc);
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
                        Imię:
                        <br>
                        <input type="text" placeholder="Imię" name="imie" id="pole" alt="pole imię">
                        <br>
                        Nazwisko:
                        <br>
                        <input type="text" placeholder="Nazwisko" name="nazwisko" id="pole" alt="pole nazwisko">
                        <br>
                        Adres e-mail:
                        <br>
                        <input type="email" placeholder="Adres e-mail" name="e_mail" id="pole" alt="pole e-mail">
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
                                    echo "Błąd zaputania: " .mysqli_error($connection);
                                }
                                
                                $baza->close();
                            ?>
                            <input type="tel" placeholder="Numer Telefonu" name="numer_telefonu" id="pole_nrtel" alt="pole numer telefonu">
                            </div>
                        </div>
                        Tytuł:
                        <br>
                        <input type="text" placeholder="Tytuł" name="tytul" id="pole" alt="pole tytuł">
                        <br>
                        Wiadomość:
                        <br>
                        <textarea name="message" placeholder="Treść Wiadomości" id="wiadomosc"></textarea>
                        <br><br>
                        Zgoda na przetwarzanie danych w celu odpowiedzi na wiadomość:
                        <br><br>
                        <input type="checkbox" name="checkbox">
                        Wyrażam zgodę na przetwarzanie moich danych osobowych przez firmę Secur IT Sp. z o.o. 
                        w celu odpowiedzi na wiadomość skierowaną z wykorzystaniem funkcjonalności strony internetowej 
                        secut-it.pl i dalszej wymiany korespondencji oraz oświadczam, 
                        że zapoznałem się z treścią informacji o przetwarzaniu danych osobowych dostępnej w <a href="./polityka_prywatności.html">polityce prywatności</a>
                        <br><br>
                        <input type=hidden name="opcja" id="opcja" class="opcja" value='dodaj'></input>
                        <button type="submit" name="submit" class="przycisk">
                            Wyślij
                        </button>
                        <input type="button" value="Resetuj" onclick="resetujPola()" class="przycisk">
                    </form><br>
                </div>
                <i class="fa-solid fa-phone"></i>+48123456789
                <i class="fa-solid fa-at"></i>contact@secut-it.pl
            </div>
        </main>
    </body>
</html>