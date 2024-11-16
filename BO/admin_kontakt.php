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
                <tbody>63+

                    <?php 
                        while ($row = mysqli_fetch_assoc($kontakty)): 
                    ?>
                    <?php
                        echo "<a href='./admin_kontakt_caly.php?id=".$row['id_formularz_kontaktowy']."'>";
                    ?>
                            <tr>
                                <td><?php echo ($row['imie']); ?></td>
                                <td><?php echo ($row['nazwisko']); ?></td>
                                <td><?php echo ($row['e_mail']); ?></td>
                                <td><?php echo ($row['numer_kierunkowy']) .($row['numer_telefonu']); ?></td>
                                <td><?php echo ($row['tytul']); ?></td>
                                <td><?php echo substr($row['wiadomosc'],0,150)." ...;" ?></td>
                                <td><?php echo $row['czy_zgoda'] ? 'Tak' : 'Nie'; ?></td>
                                <?php
                                    if(isset($row[`pi`])) {
                                ?>
                                    <td><?php echo ($row['pi']) .($row['pn']); ?></td>
                                <?php
                                    }
                                ?>
                            </tr>
                        </a>
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