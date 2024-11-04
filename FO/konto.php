<?php
    include('../DB/db_konta.php');
    session_start();
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
    <title>Secur IT | Konto</title>
</head>
<body>
    <div class="tlo"></div>
    <main class="main">
        <?php
            include("header.php");
            include("nav.php");

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $id_uzytkownik = $_SESSION['id_uzytkownik'];

                $baza = new db_konta();
                $baza->databaseConnect();
                $data = $baza->selectKontoById($id_uzytkownik, null);

                if ($data && mysqli_num_rows($data) > 0) {
                    $user = mysqli_fetch_assoc($data);
                    echo "<h2>Witaj, " . htmlspecialchars($user['nick']) . "!</h2>";
                    echo "<p>Imię: " . htmlspecialchars($user['imie']) . "</p>";
                    echo "<p>Nazwisko: " . htmlspecialchars($user['nazwisko']) . "</p>";
                    echo "<p>Email: " . htmlspecialchars($user['adres_e_mail']) . "</p>";
                    echo "<p>Numer telefonu: " . htmlspecialchars($user['numer_telefonu']) . "</p>";
                    echo "<a href='./wyloguj.php' class='button'>Wyloguj się</a>";
                } else {
                    echo "<p>Nie znaleziono danych użytkownika.</p>";
                }
            } else {
                echo "<p>Musisz być zalogowany, aby zobaczyć tę stronę.</p>";
            }
        ?>
    </main>
</body>
</html>
