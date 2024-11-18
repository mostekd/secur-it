<?php
    include_once ('../include/functions.php');
    include_once('../DB/db_accounts.php');
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
    <title>Secur IT | Pracownicy</title>
</head>
<body>
    <div class="tlo"></div>
    <main class="main">
        <?php
            include("header.php");
            include("nav.php");
        
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $id_user = $_SESSION['id_user'];
                $id_company = $_SESSION['id_company'];

                $baza = new db_accounts();
                $baza->databaseConnect();
                $data = $baza->selectCustomerByIdCompany($id_company);
                if (!empty($data)){
                    ?>
                    <a href="./account.php"><button>Powrót</button></a>
                    <div class="tresc">
                    <?php
                    while($row = mysqli_fetch_assoc($data))
                    {
                        echo "<div class='user_page'>";
                        echo "<p>Imię: ".$row['first_name']."
                        </p><p>Nazwisko: ".$row['last_name']."
                        </p><p>Email: ".$row['uea']."
                        </p><p>Numer teoefonu: ".$row['ucc']." ".$row['upn']."</p></div>";
                    }
                }else {
                    echo "Brak pracowników";
                }
            }
            $baza->close();
        ?>
        </div>
    </main>
</body>
</html>