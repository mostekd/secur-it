<?php
    include_once ('../include/functions.php');
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
        <title>Secur IT | Admin Panel</title>
    </head>
    <body>
        <div class="tlo"></div>
        <main class="main">
            <?php
                include("./admin_header.php");
                include("./admin_nav.php");
                // include("footer_admin.php");
            ?>
            <div id="contactInfo" class="contact-container">
            <?php
                include('../DB/db_employees.php');
                $baza = new db_employees();
                
                $baza->databaseConnect();
                $id_employee = $_GET['id_employee'];
                $data = $baza->selectEmployeeById($id_employee);
                
                while($row = mysqli_fetch_assoc($data))
                {
                    echo "<div class='pracownik_ingo'>";
                    echo "<img class='photo' src='".$row['zdjecie']."'><br>";
                    echo "Imię: ".$row['first_name']."<br>
                    Nazwisko: ".$row['last_name']."<br>
                    Numer telefonu: Numer telefonu: " .($row['country_code']) . " " .($row['phone_number']) . "<br>
                    Adres e-mail: ".$row['email_address']."<br>
                    Adres zamieszkania: ".$row['home_address']."<br>
                    Data urodzenia: ".$row['date_of_birth']."<br>
                    Numer umowy: ".$row['contract_number']."<br>
                    PESEL: ".$row['PESEL']."<br>
                    Numer ubezpieczenia: ".$row['insurance_number']."<br>
                    Okres zatrudnienia: ".$row['employment_period']."<br>
                    Data rozpoczęcia pracy: ".$row['start_date']."<br>
                    Data zakończenia pracy: ".$row['end_date']."<br>
                    Wynagrodzenie: ".$row['salary']."<br>
                    Wysokość premii: ".$row['bonus']."<br>
                    Lokalizacja pracy: ".$row['id_work_location']."<br>
                    Stanowisko: ".$row['name']."<br>
                    Dział: ".$row['department_name']."
                    </div>";
                }

                $baza->close();
            ?>
            <a href="./admin_employee.php">Powrót</a>
            </div>
        </main>
    </body>
</html>