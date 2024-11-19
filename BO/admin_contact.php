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
        <title>Secur IT | Admin - Kontakt</title>
    </head>
    <body>
        <?php
            include("./admin_header.php");
            include("./admin_nav.php");
            include("../DB/db_contact.php");

            $baza = new db_contact();
            $baza->databaseConnect();
            $kontakty = $baza->selectContact();

            if(isset($_GET['opcja'])){
                if($_GET['opcja'] == 'przypisz'){
                    $id_contact_form = $_GET['id_contact_form'];
                    // $first_name = $_GET['first_name'];
                    // $last_name = $_GET['last_name'];
                    // $email = $_GET['email'];
                    // $id_country_code = $_GET['id_country_code'];
                    // $phone_number = $_GET['phone_number'];
                    // $title = $_GET['title'];
                    // $message = $_GET['message'];
                    // $consent = 0;
                    // if(isset($_GET['consent'])){
                    //    $consent = 1;
                    // }

                    $baza->updateContactSetEmployee($id_contact_form, $id_employee);
                }}
        ?>
        <main class="main">
            <h1>Lista Kontaktów</h1>
            <?php 
                if ($kontakty && mysqli_num_rows($kontakty) > 0): 
            ?>
            <table class="kontakt_table" border="1" cellpadding="15" cellspacing="0">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>E-mail</th>
                        <th>Numer Telefonu</th>
                        <th>Tytuł</th>
                        <th>Wiadomość</th>
                        <th>Zgoda na przetwarzanie danych</th>
                        <th>Przypisano do</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        while ($row = mysqli_fetch_assoc($kontakty)): 
                    ?>
                            <tr>
                                <td><?php echo ($row['first_name']); ?></td>
                                <td><?php echo ($row['last_name']); ?></td>
                                <td><?php echo ($row['email']); ?></td>
                                <td><?php echo ($row['country_code']), " " .($row['phone_number']); ?></td>
                                <td><?php echo ($row['title']); ?></td>
                                <td><?php echo substr($row['message'],0,150)." ...;" ?></td>
                                <td><?php echo $row['consent'] ? 'Tak' : 'Nie'; ?></td>
                                <?php
                                    if ($row['ufn'] == null){
                                        echo "<td><input type=hidden name='opcja' id='opcja' class='opcja' value='przypisz'></input><input type='submit' value='Przypisz'></input></td>";
                                    }
                                    else{
                                    ?>
                                        <td><?php echo ($row['ufn']). " " .($row['uln']); ?></td>
                                    <?php
                                    }
                                    ?>
                            </tr>
                    <?php 
                        endwhile; 
                    ?>
                </tbody>
            </table>
            <?php 
                else: 
            ?>
                <p>Brak danych do wyświetlenia.</p>
            <?php 
                endif; 
            ?>
            <?php 
                $baza->close(); 
            ?>
        </main>
    </body>
</html>