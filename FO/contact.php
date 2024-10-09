<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./script.js" defer></script>
    <script src="https://kit.fontawesome.com/1deffa5961.js" crossorigin="anonymous"></script>
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
            <a class="logo" href="./index.html"><img src="../images/logo.png" alt="logo"></a>                    
            <div class="top-nav-buttons">
                <div class="dropdown">
                    <div class="dropdown-top">
                        <div class="dropdown-logo">Firma</div>
                    <div class="dropdown-toggle">
                           <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                    <ol class="dropdown-list">
                        <li class="dropdown-item" style="--i:1;--j:2"><a href="./o-firmie.html"></a>O Firmie</li>
                        <li class="dropdown-item" style="--i:2;--j:1"><a href="./nasza-historia.html"></a>Nasza historia</li>
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
                        <li class="dropdown-item" style="--i:1;--j:4"><a href="./zabezpieczanie-sieci.html"></a>Zabezpieczanie sieci</li>
                        <li class="dropdown-item" style="--i:2;--j:3"><a href="./kongfiguracja-sieci.html"></a>Kongfiguracja sieci</li>
                        <li class="dropdown-item" style="--i:3;--j:2"><a href="./systemy-operacyjne.html"></a>Systemy operacyjne</li>
                        <li class="dropdown-item" style="--i:4;--j:1"><a href="./rozwój-z nami.html"></a>Rozwój z nami</li>
                    </ol>
                </div>
                <div class="dropdown-kontakt">
                    <div class="dropdown-top-kontakt">
                        <a href="contact.php">Kontakt</a>
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
                        <li class="dropdown-item" style="--i:1;--j:7"><a href="./o-firmie.html"></a>O Firmie</li>
                        <li class="dropdown-item" style="--i:2;--j:6"><a href="./nasza-historia.html"></a>Nasza historia</li>
                        <li class="dropdown-item" style="--i:3;--j:5"><a href="./zabezpieczanie-sieci.html"></a>Zabezpieczanie sieci</li>
                        <li class="dropdown-item" style="--i:4;--j:4"><a href="./kongfiguracja-sieci.html"></a>Kongfiguracja sieci</li>
                        <li class="dropdown-item" style="--i:5;--j:3"><a href="./systemy-operacyjne.html"></a>Systemy operacyjne</li>
                        <li class="dropdown-item" style="--i:6;--j:2"><a href="./rozwój-z nami.html"></a>Rozwój z nami</li>
                        <li class="dropdown-item" style="--i:7;--j:1"> <a href="contact.php"></a>Kontakt</li>
                     
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
                        include('../DB/db_connection.php');
                        $baza->databaseConnect();
                        $query = "SELECT * FROM numery_kierunkowe";
                        $result = mysqli_query($connection, $query);
                        if ($result){
                            
                        echo '<div class="phone_number">';
                        echo '<select class="kierunkowy" name="numer_kierunkowy">';
                        while ($row = mysqli_fetch_assoc($result)){
                            echo '<option id="pole" class="kierunkowy" value=' .$row["numer_kierunkowy"] .'> ' .$row["numer_kierunkowy"]. " " .$row["kraj"] .'</option>';
                        }
                            echo '</select>';

                            mysqli_free_result($result);
                        } else {
                            echo "Błąd zaputania: " .mysqli_error($connection);
                        }

                        mysqli_close($connection)
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
                    secut-it.com i dalszej wymiany korespondencji oraz oświadczam, 
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