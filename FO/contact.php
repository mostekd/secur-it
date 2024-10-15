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
    <title>Secur IT | Kontakt</title>
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
                        <li class="dropdown-item" style="--i:2;--j:2"><a href="./pracownicy.php"></a>Pracownicy</li>
                        <li class="dropdown-item" style="--i:3;--j:1"><a href="./wpisy.php"></a>Wpisy</li>
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
                        <li class="dropdown-item" style="--i:1;--j:11"><a href="./o-firmie.php"></a>O Firmie</li>
                        <li class="dropdown-item" style="--i:2;--j:10"><a href="./pracownicy.php"></a>Pracownicy</li>
                        <li class="dropdown-item" style="--i:3;--j:9"><a href="./wpisy.php"></a>Wpisy</li>
                        <li class="dropdown-item" style="--i:4;--j:8"><a href="./sieci_komputerowe.php"></a>Sieci komputerowe</li>
                        <li class="dropdown-item" style="--i:5;--j:7"><a href="./systemy_operacyjne.php"></a>Systemy Operacyjne</li>
                        <li class="dropdown-item" style="--i:6;--j:6"><a href="./bazy_danych.php"></a>Bazy Danych</li>
                        <li class="dropdown-item" style="--i:7;--j:5"><a href="./strony_internetowe.php"></a>Strony Internetowe</li>
                        <li class="dropdown-item" style="--i:8;--j:4"><a href="./serwis_komputerowy.php"></a>Serwis Komputerowy</li>
                        <li class="dropdown-item" style="--i:9;--j:3"> <a href="contact.php"></a>Kontakt</li>
                        <li class="dropdown-item" style="--i:10;--j:2"> <a href="logowanie.php"></a>Logowanie</li>
                        <li class="dropdown-item" style="--i:11;--j:1"> <a href="rejestracja.php"></a>Rejestracja</li>
                     
                    </ol>
                </div>
            </div>
        </nav>
        <div class="spinaczcenter"> 
            <div class="formularz">
            <form id="MyForm" action="./add.php" method="post">
                    Imię:
                    <br>
                    <input type="text" placeholder="Imię" name="name" id="pole" alt="pole imię">
                    <br>
                    Nazwisko:
                    <br>
                    <input type="text" placeholder="Nazwisko" name="surname" id="pole" alt="pole nazwisko">
                    <br>
                    Adres e-mail:
                    <br>
                    <input type="email" placeholder="Adres e-mail" name="email" id="pole" alt="pole e-mail">
                    <br>
                    Numer Telefonu:
                    <br>
                    <div class="phonenumber">
                        <?php
                            include("../DB/db_connection.php");
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
                            echo '<select class="kierunkowy" name="numer_kierunkowy" default="">';
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
                            <input type="tel" placeholder="Numer Telefonu" name="nr_telefonu" id="pole_nrtel" alt="pole numer telefonu">
                        </div>
                    </div>
                    Tytuł:
                    <br>
                    <input type="text" placeholder="Tytuł" name="tytuł" id="pole" alt="pole tytuł">
                    <br>
                    Wiadomość:
                    <br>
                    <textarea name="message" placeholder="Treść Wiadomości" id="message"></textarea>
            </div>
                    <br><br>
                    Zgoda na przetwarzanie danych w celu odpowiedzi na wiadomość:
                    <br><br>
                    <input type="checkbox">
                    Wyrażam zgodę na przetwarzanie moich danych osobowych przez firmę Secur IT Sp. z o.o. 
                    w celu odpowiedzi na wiadomość skierowaną z wykorzystaniem funkcjonalności strony internetowej 
                    secut-it.pl i dalszej wymiany korespondencji oraz oświadczam, 
                    że zapoznałem się z treścią informacji o przetwarzaniu danych osobowych dostępnej w <a href="./polityka_prywatności.html">polityce prywatności</a>
                    <br><br>
                    <input type="button" value="Resetuj" onclick="resetujPola()" class="przycisk">
                    <button type="submit" name="submit" class="przycisk">
                        Wyślij
                    </button>
                </form><br>
        </div>
        </div>
    </main>
    </body>
</html>