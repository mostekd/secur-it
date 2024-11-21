<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../include/functions.php');
include_once('../DB/db_about_company.php');

if ($id_employee == 0) {
    header('Location: ../FO/account.php');
    exit;
}

$baza = new db_about_company();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $title = $_GET['title'];
    $description = $_GET['description'];

    $baza->insertAbout_company($title, $description);
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./admin.js" defer></script>
    <script src="https://kit.fontawesome.com/1deffa5961.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../images/ikona.png">
    <title>Secur IT | Dodaj O Firmie</title>
</head>
<body>
    <div class="tlo"></div>
    <main class="main">
        <?php
        include("./admin_header.php");
        include("./admin_nav.php");
        ?>
        <section class="content">
            <h1>Dodaj Nową Wpis w O Firmie</h1>
            <form action="add_admin_company.php" method="GET" class="form-add-service">
                <label for="title">Tytuł:</label>
                <input type="text" name="title" id="title" placeholder="Wprowadź nazwę wpisu" required>

                <label for="description">Opis:</label>
                <textarea name="description" id="description" rows="5" placeholder="Wprowadź opis wpisu" required></textarea>

                <button type="submit" class="btn-submit">Dodaj wpis</button>
            </form>
        </section>
    </main>
</body>
</html>
