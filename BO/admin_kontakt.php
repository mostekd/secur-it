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
    <div class="container">
        <h1>Lista Kontaktów</h1>
        <?php if ($kontakty && mysqli_num_rows($kontakty) > 0): ?>
            <table border="1" cellpadding="15" cellspacing="0">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>E-mail</th>
                        <th>Numer Telefonu</th>
                        <th>Tytuł</th>
                        <th>Wiadomość</th>
                        <th>Zgoda na przetwarzanie danych</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($kontakty)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['imie']); ?></td>
                            <td><?php echo htmlspecialchars($row['nazwisko']); ?></td>
                            <td><?php echo htmlspecialchars($row['e_mail']); ?></td>
                            <td><?php echo htmlspecialchars($row['numer_kierunkowy']) .htmlspecialchars($row['numer_telefonu']); ?></td>
                            <td><?php echo htmlspecialchars($row['tytul']); ?></td>
                            <td><?php echo htmlspecialchars($row['wiadomosc']); ?></td>
                            <td><?php echo $row['czy_zgoda'] ? 'Tak' : 'Nie'; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Brak danych do wyświetlenia.</p>
        <?php endif; ?>
        <?php $baza->close(); ?>
    </div>
</body>
</html>
