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
        <title>Secur IT | Logowanie</title>
    </head>
    <body>
    <?php
        include('../DB/db_konta.php');
        session_start();

        $baza = new db_konta();
        $baza->databaseConnect();

        if (isset($_POST['nick'])) {
            $login = $_POST['nick'];
            $haslo = $_POST['haslo'];
            $encrypted = sha1($haslo);
            $data = $baza->selectKlient($login, $encrypted);

            if ($data && mysqli_num_rows($data) > 0) {
                $user = mysqli_fetch_assoc($data);
                $_SESSION['loggedin'] = true;
                $_SESSION['login'] = $login;
                $_SESSION['id_uzytkownik'] = $user['id_uzytkownik'];

                header("Location: ./konto.php");
            } else {
                $error_message = "Nieprawidłowa nazwa użytkownika lub hasło.";
            }
        }
    ?>

        <div class="tlo"></div>
        <main class="main">
            <?php
                include("header.php");
                include("nav.php");
            ?>
            <div id="loginPage" class="login-container">
                <h2>Logowanie</h2>

                <?php
                if (isset($error_message)) {
                    echo '<p style="color: red;">' . $error_message . '</p>';
                }
            ?>
            <form method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Nazwa użytkownika:</label>
                    <input type="text" id="nick" name="nick" placeholder="Enter your nick" required>
                </div>
                <div class="form-group">
                    <label for="password">Hasło:</label>
                    <input type="password" id="haslo" name="haslo" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <button class="button" type="submit">Zaloguj się</button><br><br>
                    <a class="button" href="./index.php">Strona Główna</a>
                </div>
            </form>
            </div>
        </main>
    </body>
</html>