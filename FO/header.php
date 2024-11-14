<header>
    <!-- TODO: zrobic logowanie/rejestracje/konto w headerze - Konrad -->
    <?php
        include_once('../DB/db_konta.php');
        if(!isset($_SESSION['sesja'])){
            session_start();
            $_SESSION['sesja'] = "test";
        }
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $id_uzytkownik = $_SESSION['id_uzytkownik'];

            $baza = new db_konta();
            $baza->databaseConnect();
            $data = $baza->selectKontoById($id_uzytkownik, null);

            if ($data && mysqli_num_rows($data) > 0) {
                $user = mysqli_fetch_assoc($data);
                echo "<div class='user_page'>";
                echo "<a href='./konto.php'><i class='fa-solid fa-user'></i> ";
                echo htmlspecialchars($user['nick']);
                echo "</a></div>";
            }
            $baza->close();
        }
        else{
            echo "<p><a href='./rejestracja.php'>Rejestracja</a></p>
            <p><a href='./logowanie.php'> Logowanie</a></p>";
        }
    ?>
</header>
