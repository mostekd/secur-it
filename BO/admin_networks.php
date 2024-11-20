<?php
    include_once ('../include/functions.php');

    if ($id_employee == 0){
        header('Location: ../FO/account.php');
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
    <title>Secur IT | Admin - Sieci Komputerowe</title>
</head>
<body>
    <div class="tlo"></div>
    <main class="main">
        <?php
            include("./admin_header.php");
            include("./admin_nav.php");
            // include("footer_admin.php");

            include('../DB/db_services.php');
            $baza = new db_services();
        
            if(!empty($_GET)){
                $baza->databaseConnect();
                if(isset($_GET['del']))
                {
                    $id_service=$_GET['id_service'];
                    $baza->deleteServices($id_service);
                }
                if(isset($_GET['opcja'])){
                    if($_GET['opcja'] == 'dodaj'){
                        $id_service_type = 1;
                        $name = $_GET['name'];
                        $description = $_GET['description'];
                        $price = $_GET['price'];
                        $comment = $_GET['comment'];
                        $baza->insertServices ($id_service_type, $name, $description, $price);
                    }
                    elseif($_GET['opcja'] == 'edytuj'){
                        $id_service_type = $_GET['id_service_type'];
                        $name = $_GET['name'];
                        $description = $_GET['description'];
                        $price = $_GET['price'];
                        $baza->updateServices ($id_service_type, $name, $description, $price);
                    }
                }
                else{
                    echo "<p>Usługi nie ma w naszej bazie</p>";
                }
            }
            
            $baza->databaseConnect();
            $data = $baza->selectServices_networks();
            if (!empty($data)){ 
        ?>
            <div class="services">
                <?php
                    while($row = mysqli_fetch_assoc($data))
                    {
                        echo "<div id='service' class='service'>Nazwa: ".$row['name']." Opis: ".$row['description']." Cena: ".$row['price']."
                        <button class='delete'><a href=admin_networks.php?del=True&id_service=".$row['id_service'].">
                        Usuń usługę
                        </a></button>
                        <button class='delete'><a href=networks_edit.php.php?id_service=".$row['id_service'].">
                        Edytuj usługę
                        </a></button>
                        </div>";
                    }
                    } else {
                        echo "Brak książek";
                    }
                    $baza->close();
                ?>
            </div>
        </main>
    </body>
</htm>