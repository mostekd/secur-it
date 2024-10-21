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
    <title>Secur IT | Usługi - Bazy Danych</title>
</head>
<body>
    <div class="tlo"></div>
    <main class="main">
        <header>
            <a href="https://www.facebook.com/profile.php?id=61554027179435" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-facebook" style="color: #51ca52;"></i>
            </a>
            <a href="#ig" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-instagram" style="color: #51ca52;"></i>
            </a>
            <a href="#yt" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-youtube" style="color: #51ca52;"></i>
            </a>
            <a href="https://www.linkedin.com/company/secur-it2/" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-linkedin" style="color: #000000;"></i>
            </a>
            <a href="#github" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-github" style="color: #000000;"></i>
            </a>
        </header>
        
        <?php
            include("nav.php");
        ?>
        <?php
            include('../DB/db_uslugi.php');
            $baza = new db_uslugi();
            $baza->databaseConnect();
            $data = $baza->selectUslugi_bazy_danych();
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