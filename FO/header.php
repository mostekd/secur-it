    <header>
        <!-- TODO: zrobic logowanie/rejestracje/konto w headerze - Konrad -->
        <?php
            include_once('../DB/db_accounts.php');
            if(!isset($_SESSION['sesja'])){
                session_start();
                $_SESSION['sesja'] = "test";
            }
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $id_user = $_SESSION['id_user'];

                $baza = new db_accounts();
                $baza->databaseConnect();
                $data = $baza->selectCustomerById($id_user, null);

                if ($data && mysqli_num_rows($data) > 0) {
                    $user = mysqli_fetch_assoc($data);
                    echo "<div class='user_page'>";
                    echo "<a href='./account.php'><i class='fa-solid fa-user'></i> ";
                    echo ($user['username']);
                    echo "<a href='basket.php'><i class='fa-solid fa-basket-shopping'></i>Koszyk</a>";
                    echo "</a></div>";
                }
                $baza->close();
            }
            else{
                echo "<a href='./registration.php'><i class='fa-solid fa-user-plus'></i>Rejestracja</a>
                <a href='./login.php'><i class='fa-solid fa-user'></i>Logowanie</a>";
            }
        ?>
    </header>
