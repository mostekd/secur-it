<?php
    include('../DB/db_konta.php');
    session_start();
    
    // Sprawdzenie, czy użytkownik jest zalogowany, jeśli nie, przekierowanie na stronę logowania
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: logowanie.php");
        exit();
    }
    
    // Pobierz id_firma użytkownika z sesji, aby przypisać je nowemu pracownikowi
    $id_firma = $_SESSION['id_firma'];
    $baza = new db_konta();
    $baza->databaseConnect();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $nick = $_POST['nick'];
        $adres_e_mail = $_POST['adres_e_mail'];
        $numer_kierunkowy = $_POST['numer_kierunkowy'];
        $numer_telefonu = $_POST['numer_telefonu'];
        $haslo = sha1($_POST['haslo']);
        $czy_admin_firmy = 0; // Pracownik ma wartość 0 w polu czy_admin_firmy

        // Dodanie nowego użytkownika do firmy
        $return = $baza->rejestrujKlienta('', '', '', $numer_kierunkowy, '', '', $numer_telefonu, $adres_e_mail, '', $imie, $nazwisko, $nick, $haslo, $czy_admin_firmy);
        
        if ($return == 1) {
            echo "Pracownik został dodany pomyślnie.";
        } else {
            echo "Wystąpił błąd podczas dodawania pracownika.";
        }
        $baza->close();
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
        <title>Secur IT | Dodaj Pracownika</title>
    </head>
    <body>
        <main class="main">
            <?php
                include("header.php");
                include("nav.php");
            ?>
            <div id="addEmployeePage" class="add-employee-container">
                <h2>Dodaj Pracownika</h2>
                <form method="post" action="dodaj_pracownika.php" class="employee-form">
                    <div class="form-group">
                        <label for="imie">Imię:</label>
                        <input type="text" id="imie" name="imie" placeholder="Wpisz imię" required><br>
                        
                        <label for="nazwisko">Nazwisko:</label>
                        <input type="text" id="nazwisko" name="nazwisko" placeholder="Wpisz nazwisko" required><br>
                        
                        <label for="nick">Nazwa użytkownika (Nick):</label>
                        <input type="text" id="nick" name="nick" placeholder="Wpisz nazwę użytkownika" required><br>
                        
                        <label for="adres_e_mail">Email:</label>
                        <input type="email" id="adres_e_mail" name="adres_e_mail" placeholder="Wpisz email" required><br>
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
                                echo '<select class="kierunkowy" name="numer_kierunkowy" default="">';
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
                        <input type="text" id="numer_telefonu" name="numer_telefonu" placeholder="Wpisz numer telefonu"><br>
                        <label for="haslo">Hasło:</label>
                        <input type="password" id="haslo" name="haslo" placeholder="Wpisz hasło" required><br>
                        <button class="button" type="submit">Dodaj pracownika</button>
                    </div>
                </form>
            </div>
        </main>
        <script src="./script.js"></script>
    </body>
</html>
