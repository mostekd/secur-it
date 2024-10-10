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
        <title>Secur IT | Rejestracja</title>
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
                    // Pobranie danych z formularza
                    $imie = $_POST['imie'];
                    $nazwisko = $_POST['nazwisko'];
                    $id_nick = $_POST['id_nick'];
                    $email = $_POST['email'];
                    $id_numer_kierunkowy = $_POST['id_numer_kierunkowy'];
                    $numer_telefonu = $_POST['numer_telefonu'];
                    $haslo = sha1($_POST['haslo']);  // Szyfrowanie hasła

                    // Wywołanie funkcji dodającej konto
                    $baza->insertKonto($imie, $nazwisko, $id_nick, $email, $id_numer_kierunkowy, $numer_telefonu, $haslo);

                    // Przekierowanie na stronę po pomyślnym dodaniu użytkownika
                    header('location: ./student_list.php');
                    exit();
                }

                if (isset($error_message)) {
                    echo '<p style="color: red;">' . $error_message . '</p>';
                }
            ?>
            <div id="loginPage" class="login-container">
                <h2>Rejestracja</h2>

                <?php
                if (isset($error_message)) {
                    echo '<p style="color: red;">' . $error_message . '</p>';
                }
            ?>
            <form method="post" action="rejestracja.php" class="registration-form">
                <div class="form-group">
                    <label for="imie">Imię:</label>
                    <input type="text" id="imie" name="imie" placeholder="Wpisz imię" required>
                </div>

                <div class="form-group">
                    <label for="nazwisko">Nazwisko:</label>
                    <input type="text" id="nazwisko" name="nazwisko" placeholder="Wpisz nazwisko" required>
                </div>

                <div class="form-group">
                    <label for="id_nick">Nazwa użytkownika (Nick):</label>
                    <input type="text" id="id_nick" name="id_nick" placeholder="Wpisz nazwę użytkownika" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Wpisz email" required>
                </div>
                <?php
                    include('../DB/db_numery_kierunkowe.php');
                    $baza = new db_numery_kierunkowe();
                    $baza->databaseConnect();
                    $data = $baza->selectNrKierunkowe();
                    if ($data){
                        
                    echo '<div class="phone_number">';
                    echo '<select class="kierunkowy" name="numer_kierunkowy">';
                    while ($row = mysqli_fetch_assoc($data)){
                        echo '<option id="pole" class="kierunkowy" value=' .$row["numer_kierunkowy"] .'> ' .$row["numer_kierunkowy"]. " " .$row["kraj"] .'</option>';
                    }
                        echo '</select>';

                        mysqli_free_result($data);
                    } else {
                        echo "Błąd zaputania: " .mysqli_error($connection);
                    }

                    
                    $baza->close();
                ?>
                <div class="form-group">
                    <label for="numer_telefonu">Numer telefonu:</label>
                    <input type="text" id="numer_telefonu" name="numer_telefonu" placeholder="Wpisz numer telefonu" required>
                </div>

                <div class="form-group">
                    <label for="haslo">Hasło:</label>
                    <input type="password" id="haslo" name="haslo" placeholder="Wpisz hasło" required>
                </div>

                <div class="form-group">
                    <button class="button" type="submit">Zarejestruj użytkownika</button>
                </div>
            </form>
            </div>`
        </main>
    </body>
</html>