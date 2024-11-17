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
                    $id_formularz_kontaktowy = $_GET['id_formularz_kontaktowy'];
                    $imie = $_GET['imie'];
                    $nazwisko = $_GET['nazwisko'];
                    $email = $_GET['email'];
                    $id_numer_kierunkowy = $_GET['id_numer_kierunkowy'];
                    $numer_telefonu = $_GET['numer_telefonu'];
                    $tytul = $_GET['tytul'];
                    $wiadomosc = $_GET['wiadomosc'];
                    $czy_zgoda = 0;
                    if(isset($_GET['czy_zgoda'])){
                       $czy_zgoda = 1;
                    }
                    $id_pracownik = $_GET['id_pracownik'];

                    $baza->updateContact($id_formularz_kontaktowy, $imie, $nazwisko, $email, $id_numer_kierunkowy, $numer_telefonu, $tytul, $wiadomosc, $czy_zgoda, $id_pracownik);
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
                                <td><?php echo ($row['imie']); ?></td>
                                <td><?php echo ($row['nazwisko']); ?></td>
                                <td><?php echo ($row['e_mail']); ?></td>
                                <td><?php echo ($row['numer_kierunkowy']), " " .($row['numer_telefonu']); ?></td>
                                <td><?php echo ($row['tytul']); ?></td>
                                <td><?php echo substr($row['wiadomosc'],0,150)." ...;" ?></td>
                                <td><?php echo $row['czy_zgoda'] ? 'Tak' : 'Nie'; ?></td>
                                <?php
                                    if ($row['pi'] == null){
                                        echo "<input type=hidden name='opcja' id='opcja' class='opcja' value='przypisz'></input>";
                                        echo "<td><button>Przypisz</button></td>";
                                    }
                                    else{
                                    ?>
                                        <td><?php echo ($row['pi']). " " .($row['pn']); ?></td>
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