<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./script.js" defer></script>
    <script src="https://kit.fontawesome.com/1deffa5961.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="./images/ikona.png">
    <title>Secur IT | Pracownicy</title>
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
        <nav class="top-nav">
            <a class="logo" href="./index.php"><img src="../images/logo.png" alt="logo"></a>                    
            <div class="top-nav-buttons">
                <div class="dropdown">
                    <div class="dropdown-top">
                        <div class="dropdown-logo">Firma</div>
                    <div class="dropdown-toggle">
                           <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                    <ol class="dropdown-list">
                        <li class="dropdown-item" style="--i:1;--j:2"><a href="./o_firmie.php"></a>O Firmie</li>
                        <li class="dropdown-item" style="--i:2;--j:1"><a href="./pracownicy.php"></a>Pracownicy</li>
                    </ol>
                </div>
                <div class="dropdown">
                    <div class="dropdown-top">
                        <div class="dropdown-logo">Usługi</div>
                        <div class="dropdown-toggle">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                    <ol class="dropdown-list">
                        <li class="dropdown-item" style="--i:1;--j:5"><a href="./sieci_komputerowe.php"></a>Sieci komputerowe</li>
                        <li class="dropdown-item" style="--i:2;--j:4"><a href="./systemy_operacyjne.php"></a>Systemy Operacyjne</li>
                        <li class="dropdown-item" style="--i:3;--j:3"><a href="./bazy_danych.php"></a>Bazy Danych</li>
                        <li class="dropdown-item" style="--i:4;--j:2"><a href="./strony_internetowe.php"></a>Strony Internetowe</li>
                        <li class="dropdown-item" style="--i:5;--j:1"><a href="./serwis_komputerowy.php"></a>Serwis Komputerowy</li>
                    </ol>
                </div>
                <div class="dropdown-kontakt">
                    <div class="dropdown-top-kontakt">
                        <a href="contact.php">Kontakt</a>
                    </div>
                </div>
                <div class="dropdown-kontakt">
                    <div class="dropdown-top-kontakt">
                        <a href="logowanie.php">Logowanie</a>
                    </div>
                </div>
                <div class="dropdown-kontakt">
                    <div class="dropdown-top-kontakt">
                        <a href="rejestracja.php">Rejestracja</a>
                    </div>
                </div>
            </div>
            <div class="phone">
                <div class="dropdown">
                    <div class="dropdown-top">
                        <div class="dropdown-toggle-phone">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                    <ol class="dropdown-list">
                        <li class="dropdown-item" style="--i:1;--j:10"><a href="./o-firmie.html"></a>O Firmie</li>
                        <li class="dropdown-item" style="--i:2;--j:9"><a href="./nasza-historia.html"></a>Nasza historia</li>
                        <li class="dropdown-item" style="--i:3;--j:8"><a href="./sieci_komputerowe.php"></a>Sieci komputerowe</li>
                        <li class="dropdown-item" style="--i:4;--j:7"><a href="./systemy_operacyjne.php"></a>Systemy Operacyjne</li>
                        <li class="dropdown-item" style="--i:5;--j:6"><a href="./bazy_danych.php"></a>Bazy Danych</li>
                        <li class="dropdown-item" style="--i:6;--j:5"><a href="./strony_internetowe.php"></a>Strony Internetowe</li>
                        <li class="dropdown-item" style="--i:7;--j:4"><a href="./serwis_komputerowy.php"></a>Serwis Komputerowy</li>
                        <li class="dropdown-item" style="--i:8;--j:3"> <a href="contact.php"></a>Kontakt</li>
                        <li class="dropdown-item" style="--i:9;--j:2"> <a href="logowanie.php"></a>Logowanie</li>
                        <li class="dropdown-item" style="--i:10;--j:1"> <a href="rejestracja.php"></a>Rejestracja</li>
                     
                    </ol>
                </div>
            </div>
        </nav>
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
                echo "<div id='wpis' class='artykul'>";
                echo "<img src='".$row['zdjecie']."'><br>";
                echo "Imię: ".$row['imie']."
                <br>Nazwisko: ".$row['nazwisko']."
                <br>Stanowisko: ".$row['id_stanowisko']."
                <br>Dział: ".$row['id_dzial']."
                </div>";
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