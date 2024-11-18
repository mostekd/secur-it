<?php
include_once ('../include/functions.php');
include('../DB/db_companies.php');

$baza = new db_companies();
$baza->databaseConnect();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $id_user = $_SESSION['id_user'];
}
if (isset($_SESSION['id_company'])) {
    $id_company = $_SESSION['id_company'];
    $data = $baza->selectCompanyByID($id_company);
    $company = mysqli_fetch_assoc($data);
} else {
    echo "Error: No company ID specified.";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $name = $_POST['name'];
    $additional_name = $_POST['additional_name'];
    $tax = $_POST['tax'];
    $id_country_code = $_POST['id_country_code'];
    $phone_number = $_POST['phone_number'];
    $email_address = $_POST['email_address'];

    $baza->updateCompany($id_company, $name, $additional_name, $tax, $id_country_code, $phone_number, $email_address);
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
            <form action="edit_company.php?id_firma=<?php echo $id_company; ?>" method="post">
                <label for="name">Nazwa firmy:</label>
                <input type="text" id="nazwa" name="name" value="<?php echo $company['name']; ?>" required><br>

                <label for="additional_name">Nazwa firmy cd:</label>
                <input type="text" id="additional_name" name="additional_name" value="<?php echo $company['additional_name']; ?>" required><br>

                <label for="tax">NIP:</label>
                <input type="text" id="tax" name="tax" value="<?php echo $company['tax']; ?>" required><br>

                <label for="id_numer_kierunkowy">Numer kierunkowy:</label>
                <?php
                    include('../DB/db_country_codes.php');
                    $baza_numery = new db_country_codes();
                    $baza_numery->databaseConnect();

                    $selectedId = $company['id_country_code']; 
                    $data = $baza_numery->selectCountryCodes();
                    if ($data) {
                        echo '<div class="phone_number">';
                        echo '<select class="kierunkowy" name="id_country_code">';
                        while ($row = mysqli_fetch_assoc($data)) {
                            $text = '<option value="' . $row["id_country_code"] . '"';
                            if ($row["id_country_code"] == $selectedId) {
                                $text .= ' selected="selected"';
                            }
                            $text .= ' value=' .$row["id_country_code"] .'> ' .$row["country_code"]. " " .$row["country"] .'</option>';
                            echo $text;
                        }
                        echo '</select>';
                        echo '</div>';
                        mysqli_free_result($data);
                    } else {
                        echo "Błąd zapytania: " . mysqli_error($connect);
                    }
                    $baza_numery->close();
                ?>

                <label for="phone_number">Numer telefonu:</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo $company['phone_number']; ?>" required><br>

                <label for="email_address">Adres e-mail:</label>
                <input type="email" id="email_address" name="email_address" value="<?php echo $company['email_address']; ?>" required><br>

                <button type="submit" name="update">Zaktualizuj dane</button>
                <button><a href="./konto.php">Powrót</a></button>
            </form>
        </section>
    </main>
</body>
</html>
