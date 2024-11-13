<?php
include('../DB/db_firmy.php');
include('../DB/db_numery_kierunkowe.php');
session_start();

$baza = new db_firmy();
$baza->databaseConnect();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $id_uzytkownik = $_SESSION['id_uzytkownik'];
}
if (isset($_SESSION['id_firma'])) {
    $id_firma = $_SESSION['id_firma'];
    $data = $baza->selectFirmaById($id_firma);
    $firma = mysqli_fetch_assoc($data);
} else {
    echo $id_firma;
    echo "Error: No firm ID specified.";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $nazwa = $_POST['nazwa'];
    $nazwacd = $_POST['nazwa_cd'];
    $nip = $_POST['nip'];
    $id_numer_kierunkowy = $_POST['id_numer_kierunkowy'];
    $numer_telefonu = $_POST['numer_telefonu'];
    $adres_e_mail = $_POST['adres_e_mail'];

    $baza->updateFirma($id_firma, $nazwa, $nazwacd, $nip, $id_numer_kierunkowy, $numer_telefonu, $adres_e_mail);
}   

$baza->close();
?>
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
    <title>Secur IT | Edytuj Dane Firmy</title>
</head>
<body>
    <div class="tlo"></div>
    <main class="main">
        <?php include("header.php"); ?>
        <?php include("nav.php"); ?>
        
        <section class="form-section">
            <h2>Edytuj Dane Firmy</h2>
            <form action="edytuj_firme.php?id_firma=<?php echo $id_firma; ?>" method="post">
            <label for="nazwa">Nazwa firmy:</label>
            <input type="text" id="nazwa" name="nazwa" value="<?php echo $firma['nazwa']; ?>" required><br>

            <label for="nazwa_cd">Nazwa firmy cd:</label>
            <input type="text" id="nazwa_cd" name="nazwa_cd" value="<?php echo $firma['nazwa_cd']; ?>" required><br>

            <label for="nip">NIP:</label>
            <input type="text" id="nip" name="nip" value="<?php echo $firma['nip']; ?>" required><br>

            <label for="id_numer_kierunkowy">Numer kierunkowy:</label>
            <?php
                $baza = new db_numery_kierunkowe();
                
                $dataPolska = $baza->selectNrKierunkowePolska();
                if ($dataPolska){
                    while ($row = mysqli_fetch_assoc($dataPolska)){
                        $selectedId = $row["id_numer_kierunkowy"];
                    } 
                }
                
                $data = $baza->selectNrKierunkowe();
                if ($data)
                {
                    echo '<div class="phone_number">';
                    echo '<select class="kierunkowy" name="numer_kierunkowy" default="">';
                    while ($row = mysqli_fetch_assoc($data))
                    {
                        $text = '<option id="pole" class="kierunkowy"';
                        if($row["id_numer_kierunkowy"] == $selectedId)
                        {
                        $text .= 'selected = "selected"';
                        } 
                        $text .= ' value=' .$firma["id_numer_kierunkowy"] .'> ' .$firma["numer_kierunkowy"]. " " .$firma["kraj"] .'</option>';

                        echo $text;
                    }
                    echo '</select>';
                    echo '</div>';
                    mysqli_free_result($data);
                } 
                else 
                {
                    echo "Błąd zapytania: " .mysqli_error($connect);
                }
                $baza->close();
            ?>

            <label for="numer_telefonu">Numer telefonu:</label>
            <input type="text" id="numer_telefonu" name="numer_telefonu" value="<?php echo $firma['numer_telefonu']; ?>" required><br>

            <label for="adres_e_mail">Adres e-mail:</label>
            <input type="email" id="adres_e_mail" name="adres_e_mail" value="<?php echo $firma['adres_e_mail']; ?>" required><br>

            <button type="submit" name="update">Zaktualizuj dane</button>
        </form>
        </section>
    </main>
</body>
</html>
