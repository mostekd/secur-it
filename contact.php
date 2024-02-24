<!-- Dear user:
When I wrote this code, only I and God knew what it was.
Now, only God knows!

So if you are done trying to 'optimize' this code (and failed), please increment the following counter as a warning:
to the next guy:

total_hours_wasted_here = 187

notes:
use icons from the fontawesome website plase and not all the svg
-->
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./script.js" defer></script>
    <script src="https://kit.fontawesome.com/1deffa5961.js" crossorigin="anonymous"></script>
    <title>Secur IT</title>
</head>
<body>
    <main class="main">
        <header>
            <a href="https://www.facebook.com/profile.php?id=61554027179435" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-facebook" style="color: #51ca52;"></i>
            </a>
            <a href="#ig" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-instagram" style="color: #51ca52;"></i>
            </a>
            <a href="#yt" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-youtube" style="color: #51ca52;""></i>
            </a>
            <a href="https://www.linkedin.com/company/secur-it2/" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-linkedin" style="color: #000000;"></i>
            </a>
            <a href="#github" class="spolecznosci" target="_blank">
                <i class="fa-brands fa-github" style="color: #000000;"></i>
            </a>
        </header>
        <nav class="top-nav">
            <a class="logo" href="./index.html"><img src="./images/logo.png" alt="logo"></a>                    
            <div class="top-nav-buttons">
                <!-- the code for an animated dropdown menu i made -->
                <div class="dropdown">
                    <div class="dropdown-top">
                        <div class="dropdown-logo">Firma</div>
                        <div class="dropdown-toggle">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                    <ol class="dropdown-list">
                        <li class="dropdown-item" style="--i:1;--j:4"><a href=""></a>O Firmie</li>
                        <li class="dropdown-item" style="--i:2;--j:3"><a href=""></a>Nasza historia</li>
                        <li class="dropdown-item" style="--i:3;--j:2"><a href=""></a>Nagrody</li>
                        <li class="dropdown-item" style="--i:4;--j:1"><a href=""></a>Rozwój z nami</li>
                    </ol>
                </div>
                <!-- ----------- -->
                <div class="dropdown">
                    <div class="dropdown-top">
                        <div class="dropdown-logo">Branże</div>
                        <div class="dropdown-toggle">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                    <ol class="dropdown-list">
                        <li class="dropdown-item" style="--i:1;--j:4"><a href=""></a>Motoryzacja</li>
                        <li class="dropdown-item" style="--i:2;--j:3"><a href=""></a>Metale i górnictwo</li>
                        <li class="dropdown-item" style="--i:3;--j:2"><a href=""></a>Handel</li>
                        <li class="dropdown-item" style="--i:4;--j:1"><a href=""></a>High tech</li>
                        <li class="dropdown-item" style="--i:4;--j:1"><a href=""></a>Opieka zdrowotna</li>
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
                        <li class="dropdown-item" style="--i:1;--j:4"><a href=""></a>Zabezpieczanie sieci</li>
                        <li class="dropdown-item" style="--i:2;--j:3"><a href=""></a>Kongfiguracja sieci</li>
                        <li class="dropdown-item" style="--i:3;--j:2"><a href=""></a>Systemy operacyjne</li>
                        <li class="dropdown-item" style="--i:4;--j:1"><a href=""></a>Rozwój z nami</li>
                    </ol>
                </div>
                <div class="dropdown-kontakt">
                    <div class="dropdown-top-kontakt">
                        <a href="contact.php">Kontakt</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="spinaczcenter"> 
            <div class="formularz">
                <form id="MyForm" action="./add.php" method="post">
                    Imię i Nazwisko:
                    <br>
                    <input type="text" name="name" id="pole">
                    <br>
                    Adres e-mail:
                    <br>
                    <input type="email" name="email" id="pole">
                    <br>
                    Numer telefonu:
                    <br>
                    <div class="phone">
                            <?php include ('connect.php')?>
                        <div class="phone_number">
                            <input type="tel" name="nr. telefonu:" id="pole">
                        </div>
                    </div>
                    <br>
                    Wiadomość:
                    <br>
                    <textarea name="message" id="message"></textarea>
            </div>
                    <br><br>
                    Zgoda na przetwarzanie danych w celu odpowiedzi na wiadomość:
                    <br><br>
                    <input type="checkbox">
                    Wyrażam zgodę na przetwarzanie moich danych osobowych przez firmę Secur IT Sp. z o.o. 
                    w celu odpowiedzi na wiadomość skierowaną z wykorzystaniem funkcjonalności strony internetowej 
                    secut-it.com i dalszej wymiany korespondencji oraz oświadczam, 
                    że zapoznałem się z treścią informacji o przetwarzaniu danych osobowych dostępnej w polityce prywatności
                    <br><br>
                    <input type="button" value="Resetuj" onclick="resetujPola()" id="przycisk">
                    <button type="submit" name="submit" id="przycisk">
                        Wyślij
                    </button>
                </form><br>
                <div class="dane_kontaktowe">
                    Numer Telefonu: +48 535525904
                </div><br>
        </div>
    </main>
    </body>
</html>
