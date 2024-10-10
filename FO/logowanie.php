<?php
    session_start();

    include('../DB/db_konta.php');
    $baza = new db_konta();
    $baza->databaseConnect();
    $data = $baza->selectKonto();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
        $encrypted = sha1($password);
        $adress = "./index_admin.php";
        
        $sql = "SELECT * FROM `administratorzy` WHERE login='$login' AND haslo='$encrypted'";
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
<head>
    <link rel="stylesheet" href="login.css">
</head>
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
</div>
