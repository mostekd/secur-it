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
    <title>Secur IT | Usługi - Strony Internetowe</title>
</head>
<body>
    <div class="tlo"></div>
    <main class="main">
        <?php
            include("header.php");
            include("nav.php");
        ?>
        <?php
            include('../DB/db_uslugi.php');
            $baza = new db_uslugi();
            $baza->databaseConnect();
            $data = $baza->selectUslugi_strony_internetowe();
            if (!empty($data)){
            ?>
        <div class="tresc">
        <?php
            while($row = mysqli_fetch_assoc($data))
            {
                echo "<div id='wpis' class='artykul'>
                ".$row['nazwa']."
                <br>".$row['opis']."
                <br>".$row['cena']."
                </div>";
            }
            }else {
                echo "Brak usług";
            }
            $baza->close();
        ?>
        </div>
    </main>
</body>
</html>