<?php
    include('../DB/db_konta.php');
    $baza = new db_konta();
    $baza->databaseConnect();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $nick = $_POST['nick'];
        $adres_e_mail = $_POST['adres_e_mail'];
        $id_numer_kierunkowy = $_POST['id_numer_kierunkowy'];
        $numer_telefonu = $_POST['numer_telefonu'];
        $haslo = sha1($_POST['haslo']);


        $baza->insertKonto($imie, $nazwisko, $nick, $adres_e_mail, $id_numer_kierunkowy, $numer_telefonu, $haslo);
        if(isset($data)){
            switch($data):
                case 0:
                    header("Location: ./logowanie.php");
                case 1:
                    header("Location: ./rejestracja.php");
                    echo "Bład 1"; //nie wstawiono dnaych do tabeli klient
                case 2:
                    header("Location: ./rejestracja.php");
                    echo "Użytkownik o danym nicku już istnieje. Wybierz inny nick";//jesli jest juz taki nick w bazie
            endswitch;
        }
        else{
            header("Location: ./rejestracja.php");
        }
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">
    `<head>
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
            <?php
                if (isset($error_message)) {
                    echo '<p style="color: red;">' . $error_message . '</p>';
                }
            ?>
            <div id="loginPage" class="login-container">
                <h2>Rejestracja</h2>

                <?php
                if (isset($error_message)) {
                    echo '<p style="color: red;">' . $error_message . '</p>';
                }
            ?>
            <form method="post" action="rejestracja.php" class="registration-form">
                <div class="form-group">
                    <label for="imie">Imię:</label>
                    <input type="text" id="imie" name="imie" placeholder="Wpisz imię" required>
                </div>

                <div class="form-group">
                    <label for="nazwisko">Nazwisko:</label>
                    <input type="text" id="nazwisko" name="nazwisko" placeholder="Wpisz nazwisko" required>
                </div>

                <div class="form-group">
                    <label for="nick">Nazwa użytkownika (Nick):</label>
                    <input type="text" id="nick" name="nick" placeholder="Wpisz nazwę użytkownika" required>
                </div>

                <div class="form-group">
                    <label for="adres_e_mail">Email:</label>
                    <input type="email" id="adres_e_mail" name="adres_e_mail" placeholder="Wpisz email" required>
                </div>
                <div class="form-group">
                    <label for="numer_telefonu">Numer telefonu:</label>
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
                    <input type="text" id="numer_telefonu" name="numer_telefonu" placeholder="Wpisz numer telefonu" required>
                </div>

                <div class="form-group">
                    <label for="haslo">Hasło:</label>
                    <input type="password" id="haslo" name="haslo" placeholder="Wpisz hasło" required>
                </div>

                <div class="form-group">
                    <button class="button" type="submit">Zarejestruj użytkownika</button>
                </div>
            </form>
            </div>
        </main>
    </body>
</html>