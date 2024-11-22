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
        <title>Secur IT | Admin - Edytuj Strony Internetowe</title>
    </head>
    <body>
        <div class="tlo"></div>
        <main class="main">
            <?php
                include("./admin_header.php");
                include("./admin_nav.php"); 
                include('../DB/db_services.php');
                $baza = new db_services();
            
                if(!empty($_GET)){                
                    $baza->databaseConnect();
                    $id_service=$_GET['id_service'];
                    $data = $baza->selectServiceById($id_service);
                    if (!empty($data)){
                        while($row = mysqli_fetch_assoc($data))
                        {
                            echo "<form class='MyForm' action='./admin_websites.php' method = 'get'>
                                <input type='text' name='name' id='name' value='".$row['name']."'></input>
                                <input type='text' name='description' id='description' value='".$row['description']."'></input>
                                <input type='number' name='price' placeholder='cena' id='price' class='price' value=".$row['price']."></input>";
                            echo "<input type='hidden' name='id_service' id='id_service' class='id_service' value=".$row['id_service']."></input>
                                <input type='hidden' name='opcja' id='opcja' class='opcja' value='edytuj'></input>
                                <input type='submit'></input>
                                </form>";
                        }
                    }
                }
            ?>
        </main>        
    </body>
</html>s