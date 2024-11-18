<?php
    include_once ('../include/functions.php');
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
        ?>
        <?php
            include('../DB/db_employees.php');
            $baza = new db_employees();
            $baza->databaseConnect();
            $data = $baza->selectPracownik();
            if (!empty($data)){
            ?>
        <div class="tresc">
        <?php
            while($row = mysqli_fetch_assoc($data))
            {
                echo "<div id='wpis' class='pracownik'>";
                echo "<img class='photo' src='".$row['zdjecie']."'><br>";
                echo "Imię: ".$row['imie']."
                <br>Nazwisko: ".$row['nazwisko']."
                <br>Stanowisko: ".$row['nazwa']."";
                if(!empty($row['nazwa_dzialu'])){
                    echo "<br>Dział: ".$row['nazwa_dzialu']."
                    </div>";
                }
                else{
                    echo "</div>";
                }
            }
            }else {
                echo "Brak pracowników";
            }
            $baza->close();
        ?>
        </div>
    </main>
</body>
</html>