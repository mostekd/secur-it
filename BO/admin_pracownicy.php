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
    <title>Secur IT | Admin - Pracownicy</title>
</head>
<body>
    
<?php
    include("./admin_header.php");
    include("./admin_nav.php");
?>
    <div class="panel_lewy">
    <a class="przycisk" href="./dodawanie_pracownika.php"><i class="fa-solid fa-user-plus" style="color: #fff;"></i>Dodaj pracownika</a>
    </div>
    <main class="main">
        <?php
            include('../DB/db_pracownicy.php');
            $baza = new db_pracownicy();
            $baza->databaseConnect();
            $data = $baza->selectPracownik();
            if (!empty($data)){
            ?>
        <div class="tresc">
        <?php
            while($row = mysqli_fetch_assoc($data))
            {
                echo "<a href='./pracownik.php?id_pracownik=".$row['id_pracownik']."'>";
                echo "<div class='pracownik'>";
                echo "<img class='photo' src='".$row['zdjecie']."'><br>";
                echo "Imię: ".$row['imie']."
                <br>Nazwisko: ".$row['nazwisko']."
                <br>Stanowisko: ".$row['nazwa']."";
                if(!empty($row['nazwa_dzialu'])){
                    echo "<br>Dział: ".$row['nazwa_dzialu']."
                    </div> </a>";
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