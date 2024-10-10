<?php
session_start();

$host = "localhost"; // Host bazy danych
$dbname = "wiai"; // Nazwa bazy danych
$username = "root"; // Nazwa użytkownika bazy danych
$password = ""; // Hasło użytkownika bazy danych

$connect = mysqli_connect($host, $username, $password, $dbname);
if(!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $encrypted = sha1($password);
    $adress = "./admin_panel.php";
    
    $sql = "SELECT * FROM `administratorzy` WHERE login='$username' AND haslo='$encrypted'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Zalogowano pomyślnie
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
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
