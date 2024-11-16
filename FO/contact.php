<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="./script.js" defer></script>
    <title>Secur IT | Kontakt</title>
</head>
<body>
    <?php
    include("../DB/db_connection.php");
    include('../DB/db_numery_kierunkowe.php');
    include('../DB/db_contact.php');

    session_start();
    $isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
    $selectedCountryId = null; // Domyślna wartość
    $userData = [];

    if ($isLoggedIn) {
        $id_uzytkownik = $_SESSION['id_uzytkownik'];
        $konto = new db_konta();
        $konto->databaseConnect();
        $userResult = $konto->selectKontoById($id_uzytkownik, null);
        if ($userResult && mysqli_num_rows($userResult) > 0) {
            $userData = mysqli_fetch_assoc($userResult);
            $selectedCountryId = $userData['id_numer_kierunkowy'] ?? null;
        }
        $konto->close();
    }

    $baza = new db_numery_kierunkowe();
    $baza->databaseConnect();
    $dataPolska = $baza->selectNrKierunkowePolska();
    if ($dataPolska) {
        $row = mysqli_fetch_assoc($dataPolska);
        $selectedId = $row["id_numer_kierunkowy"];
    }
    $selectedCountryId = $selectedCountryId ?? $selectedId; // Ustaw domyślnie Polska
    ?>
    <main class="main">
        <form id="MyForm" method="get">
            <?php if ($isLoggedIn): ?>
                <label>
                    <input type="checkbox" id="useOtherData" onclick="toggleUserData(this)">
                    Użyj innych danych
                </label>
                <br><br>
            <?php endif; ?>
            
            Imię:<br>
            <input type="text" name="imie" id="imie" 
                   value="<?php echo $isLoggedIn ? htmlspecialchars($userData['imie']) : ''; ?>" 
                   <?php echo $isLoggedIn ? 'readonly data-default-value="' . htmlspecialchars($userData['imie']) . '"' : ''; ?>>
            <br>
            
            Nazwisko:<br>
            <input type="text" name="nazwisko" id="nazwisko" 
                   value="<?php echo $isLoggedIn ? htmlspecialchars($userData['nazwisko']) : ''; ?>" 
                   <?php echo $isLoggedIn ? 'readonly data-default-value="' . htmlspecialchars($userData['nazwisko']) . '"' : ''; ?>>
            <br>
            
            Numer kierunkowy i telefon:<br>
            <select name="id_numer_kierunkowy" id="id_numer_kierunkowy" 
                    data-default-value="<?php echo $selectedCountryId; ?>">
                <?php
                $data = $baza->selectNrKierunkowe();
                if ($data) {
                    while ($row = mysqli_fetch_assoc($data)) {
                        echo '<option value="' . $row["id_numer_kierunkowy"] . '"' .
                            (($row["id_numer_kierunkowy"] == $selectedCountryId) ? ' selected' : '') . '>' .
                            $row["numer_kierunkowy"] . ' ' . $row["kraj"] . '</option>';
                    }
                }
                ?>
            </select>
            <input type="tel" name="numer_telefonu" id="numer_telefonu"
                   value="<?php echo $isLoggedIn ? htmlspecialchars($userData['unt']) : ''; ?>" 
                   <?php echo $isLoggedIn ? 'readonly data-default-value="' . htmlspecialchars($userData['unt']) . '"' : ''; ?>>
            <br><br>
            
            Tytuł:<br>
            <input type="text" name="tytul" id="tytul">
            <br>
            
            Wiadomość:<br>
            <textarea name="wiadomosc" id="wiadomosc"></textarea>
            <br><br>
            
            <input type="checkbox" name="czy_zgoda"> Wyrażam zgodę na przetwarzanie danych.<br><br>
            <input type="hidden" name="opcja" value="dodaj">
            <button type="submit">Wyślij</button>
            <button type="button" onclick="resetujPola()">Resetuj</button>
        </form>
    </main>
    <?php $baza->close(); ?>
</body>
</html>
