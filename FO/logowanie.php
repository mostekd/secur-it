<!DOCTYPE html>
<html lang="pl">
    `<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="./script.js" defer></script>
        <script src="https://kit.fontawesome.com/1deffa5961.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="../images/ikona.png">
        <title>Secur IT | Logowanie</title>
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
                include('../DB/db_konta.php');
                $baza = new db_konta();
                $baza->databaseConnect();

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $login = $_POST['login'];
                    $haslo = $_POST['haslo'];
                    $encrypted = sha1($haslo);
                    $adress = "./index.php";
                    $data = $baza->selectKonto();
                    $result = mysqli_query($connect, $sql);

                    if (mysqli_num_rows($result) == 1) {
                        // Zalogowano pomyślnie
                        $_SESSION['loggedin'] = true;
                        $_SESSION['login'] = $login;
                        header("location:". $adress); // Przekierowanie do panelu administracyjnego
                    } else {
                        $error_message = "Nieprawidłowa nazwa użytkownika lub hasło.";
                    }
                }
            ?>
            <div id="loginPage" class="login-container">
                <h2>Logowanie</h2>

                <?php
                if (isset($error_message)) {
                    echo '<p style="color: red;">' . $error_message . '</p>';
                }
            ?>
            <form method="post" action="login.php" class="login-form">
                <div class="form-group">
                    <label for="username">Nazwa użytkownika:</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <button class="button" type="submit">Zaloguj się</button><br><br>
                    <a class="button" href="./index.php">Strona Główna</a>
                </div>
            </form>
            </div>`
        </main>
    </body>
</html>