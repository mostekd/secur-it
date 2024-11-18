<?php
    include('../DB/db_konta.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./admin.js" defer></script>
    <script src="https://kit.fontawesome.com/1deffa5961.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../images/ikona.png">
    <title>Secur IT | Admin Konto</title>
</head>
<body>
    <div class="tlo"></div>
    <main class="main">
    <?php
            include("./admin_header.php");
            include("./admin_nav.php");

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $id_uzytkownik = $_SESSION['id_uzytkownik'];

                $baza = new db_konta();
                $baza->databaseConnect();
                $data = $baza->selectKontoById($id_uzytkownik, null);

                if ($data && mysqli_num_rows($data) > 0) {
                    $user = mysqli_fetch_assoc($data);
                    echo "<div class='user_page'>";
                    echo "<h2>Witaj, " . htmlspecialchars($user['nick']) . "!</h2>";
                    echo "<p>Imię: " . htmlspecialchars($user['imie']) . "</p>";
                    echo "<p>Nazwisko: " . htmlspecialchars($user['nazwisko']) . "</p>";
                    echo "<p>Email: " . htmlspecialchars($user['uae']) . "</p>";
                    echo "<p>Numer telefonu: " . htmlspecialchars($user['unk']) . " " . htmlspecialchars($user['unt']) . "</p>";
                    
                    // Sprawdzamy, czy użytkownik należy do firmy
                    if (!empty($user['nazwa'])) {
                        echo "</div><div class='firma_page'>";
                        echo "<h2>Twoja Firma:</h2>";
                        echo "<p>Nazwa firmy:  " . htmlspecialchars($user['nazwa']) . " " . htmlspecialchars($user['nazwa_cd']) . "</p>";
                        echo "<p>NIP: " . htmlspecialchars($user['nip']) . "</p>";
                        echo "<p>Numer telefonu firmy: " . htmlspecialchars($user['fnk']) . " " . htmlspecialchars($user['fnt']) . "</p>";
                        echo "<p>Email firmy: " . htmlspecialchars($user['fae']) . "</p>";
                        
                        // Dodanie opcji administracyjnych, jeśli użytkownik jest administratorem firmy
                        if ($user['czy_admin_firmy'] == 1) {
                            echo "<a href='./dodawanie_pracownika.php'><button>Dodaj pracownika</button</a>";
                            echo "<a href='./admin_pracownicy.php'><button>Wyświetl pracowników</botton></a>";
                            echo "<a href='./edytuj_firme.php'><button>Edytuj dane firmy</button></a>";
                        }
                        echo "</div>";
                    }
                    echo "<a href='./admin_wyloguj.php' class='button_logout'>Wyloguj się</a>";
                } else {
                    echo "<p>Nie znaleziono danych użytkownika.</p>";
                }
            } else {
                echo "<p>Musisz być <a href='./logowanie.php'>zalogowany</a>, aby zobaczyć tę stronę.</p>";
            }
            $baza->close();
        ?>
    </main>
</body>
</html>
