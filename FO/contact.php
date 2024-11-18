<?php
    include_once ('../include/functions.php');
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
        <title>Secur IT | Kontakt</title>
    </head>
    <body>
        <?php
            include("../DB/db_connection.php");
            include('../DB/db_country_codes.php');
            include('../DB/db_contact.php');
            $baza = new db_contact();

            if(!empty($_GET)){
                $baza->databaseConnect();
                if(isset($_GET['opcja'])){
                    if($_GET['opcja'] == 'dodaj'){
                        $first_name = $_GET['first_name'];
                        $last_name = $_GET['last_name'];
                        $email = $_GET['email'];
                        $id_country_code = $_GET['id_country_code'];
                        $phone_number = $_GET['phone_number'];
                        $title = $_GET['title'];
                        $message = $_GET['message'];
                        $consent = 0;
                        if(isset($_GET['consent'])){
                            $consent = 1;
                        }
                        $baza->insertContact ($first_name, $last_name, $email, $id_country_code, $phone_number, $title, $message, $consent);
                        if(isset($baza)){
                            switch($baza){
                                case 1:
                                    echo "<script>alert('Wiadomość została wysłana')</script>";
                                    header('location: ./contact.php');
                                    break;
                                default:
                                    header("Location: ./contact.php?echo=".$baza."");
                                    break;
                            }
                        }
                    }
                }
                else{
                    echo "<p>Wiadomość nie została wysłana</p>";
                }
            }    
        ?>
        <div class="tlo"></div>
        <main class="main">
            <?php
                include("header.php");
                include("nav.php");
            ?>
            <div class="spinaczcenter"> 
                <div class="formularz">
                    <form id="MyForm" method="get">
                        <?php
                            $isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
                            $userData = [];

                            if ($isLoggedIn) {
                                $id_user = $_SESSION['id_user'];
                                $konto = new db_accounts();
                                $konto->databaseConnect();
                                $result = $konto->selectCustomerById($id_user, null);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $userData = mysqli_fetch_assoc($result);
                                }
                                $konto->close();
                        ?>
                        <label>
                            <input type="checkbox" id="useOtherData" onclick="toggleUserData(this)">
                            Użyj innych danych
                        </label>
                        <?php
                            }
                        ?>
                        <br><br>

                        Imię:
                        <br>
                        <input type="text" placeholder="Imię" name="first_name" id="first_name" alt="pole imię" 
                               value="<?php echo $isLoggedIn ? ($userData['first_name']) : ''; ?>" 
                               <?php echo $isLoggedIn ? 'readonly data-default-value="'.($userData['first_name']).'"' : ''; ?>>
                        <br>
                        Nazwisko:
                        <br>
                        <input type="text" placeholder="Nazwisko" name="last_name" id="last_name" alt="pole nazwisko"
                               value="<?php echo $isLoggedIn ? ($userData['last_name']) : ''; ?>" 
                               <?php echo $isLoggedIn ? 'readonly data-default-value="'.($userData['last_name']).'"' : ''; ?>>
                        <br>
                        Adres e-mail:
                        <br>
                        <input type="email" placeholder="Adres e-mail" name="email" id="email" alt="pole e-mail" 
                               value="<?php echo $isLoggedIn ? ($userData['uea']) : ''; ?>" 
                               <?php echo $isLoggedIn ? 'readonly data-default-value="'.($userData['uea']).'"' : ''; ?>>
                        <br>
                        Numer Telefonu:
                        <br>
                        <div class="phonenumber">
                            <?php
                                $baza = new db_country_codes();
                                $baza->databaseConnect();
                
                                $dataPolska = $baza->selectCountryCodesPolska();
                                if ($dataPolska){
                                    while ($row = mysqli_fetch_assoc($dataPolska)){
                                        $selectedId = $row["id_country_code"];
                                    } 
                                }
                                
                                $data = $baza->selectNrKierunkowe();
                                if ($data){
                                    
                                echo '<div class="phone_number">';
                                echo '<select class="kierunkowy" name="id_country_code" default="">';
                                while ($row = mysqli_fetch_assoc($data)){
                                    $text = '<option id="pole" class="kierunkowy"';
                                    if($row["id_country_code"] == $selectedId)
                                    {
                                    $text .= 'selected = "selected"';
                                    } 
                                    $text .= ' value=' .$row["id_country_code"] .'> ' .$row["country_code"]. " " .$row["country"] .'</option>';

                                    echo $text;
                                }
                                    echo '</select>';

                                    mysqli_free_result($data);
                                } else {
                                    echo "Błąd zapytania: " .mysqli_error($connection);
                                }
                                
                                $baza->close();
                            ?>
                            <input type="tel" placeholder="Numer Telefonu" name="numer_telefonu" id="numer_telefonu" alt="pole numer telefonu" 
                               value="<?php echo $isLoggedIn ? ($userData['upn']) : ''; ?>" 
                               <?php echo $isLoggedIn ? 'readonly data-default-value="'.($userData['upn']).'"' : ''; ?>>
                            </div>
                        </div>
                        <br>
                        Tytuł:
                        <br>
                        <input type="text" placeholder="Tytuł" name="title" id="title" alt="pole tytuł">
                        <br>
                        Wiadomość:
                        <br>
                        <textarea name="message" placeholder="Treść Wiadomości" id="message"></textarea>
                        <br><br>
                        Zgoda na przetwarzanie danych:
                        <br><br>
                        <input type="checkbox" name="consent" required>
                        <span> Wyrażam zgodę na przetwarzanie moich danych osobowych przez firmę Secur IT Sp. z o.o.w celu odpowiedzi na wiadomość skierowaną z wykorzystaniem funkcjonalności strony internetowej secur-it.pl i dalszej wymiany korespondencji oraz oświadczam, 
                        że zapoznałem się z treścią informacji o przetwarzaniu danych osobowych dostępnej w <a href="./polityka_prywatności.html">polityce prywatności</a></span>
                        <br><br>
                        <input type="hidden" name="opcja" id="opcja" value="dodaj">
                        <button type="submit" name="submit" class="przycisk">Wyślij</button>
                        <input type="button" value="Resetuj" onclick="resetujPola()" class="przycisk">
                    </form><br>
                </div>
                <i class="fa-solid fa-phone"></i>+48123456789
                <i class="fa-solid fa-at"></i>contact@secut-it.pl
            </div>
        </main>
    </body>
</html>