<header>
    <!-- TODO: zrobic logowanie/rejestracje/konto w headerze - Konrad -->
    <?php
        include_once('../DB/db_accounts.php');
        if(!isset($_SESSION['sesja'])){
            session_start();
            $_SESSION['sesja'] = "test";
        }
        if ($_SESSION['loggedin'] === true) {
            $id_user = $_SESSION['id_user'];

            $baza = new db_accounts();
            $baza->databaseConnect();
            $data = $baza->selectCustomerById($id_user, null);

            if ($data && mysqli_num_rows($data) > 0) {
                $user = mysqli_fetch_assoc($data);
                echo "<div class='user_page'>";
                echo "<a href='./admin_konto.php'><i class='fa-solid fa-user'></i> ";
                echo ($user['username']);
                echo "</a></div>";
            }
            $baza->close();
        }
        else{
            echo "<p><a href='../FO/registration.php'>Rejestracja</a></p>
            <p><a href='../FO/login.php'>Logowanie</a></p>";
        }
    ?>
</header>
