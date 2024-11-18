<?php
    include_once('../DB/db_konta.php');
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
    <title>Secur IT | Pracownicy</title>
</head>
<body>
    <div class="tlo"></div>
    <main class="main">
        <?php
            include("header.php");
            include("nav.php");
        
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $id_uzytkownik = $_SESSION['id_uzytkownik'];
                $id_firma = $_SESSION['id_firma'];

                $baza = new db_konta();
                $baza->databaseConnect();
                $data = $baza->selectKontoByIdFirma($id_firma);
                if (!empty($data)){
                    ?>
                    <a href="./konto.php"><button>Powrót</button></a>
                    <div class="tresc">
                    <?php
                    while($row = mysqli_fetch_assoc($data))
                    {
                        echo "<div class='user_page'>";
                        echo "<p>Imię: ".$row['imie']."
                        </p><p>Nazwisko: ".$row['nazwisko']."
                        </p><p>Email: ".$row['uae']."
                        </p><p>Numer teoefonu: ".$row['unk']." ".$row['unt']."</p></div>";
                    }
                }else {
                    echo "Brak pracowników";
                }
            }
            $baza->close();
        ?>
        </div>
    </main>
</body>
</html>