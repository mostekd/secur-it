<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    
<?php
include('./head_admin.php');
?>
    <div class="panel_lewy">
    <a class="przycisk" href="./admin_panel.php"><i class="fa-solid fa-house" style="color: #fff;"></i>Strona główna</a>
    <a class="przycisk" href="./student_add.php"><i class="fa-solid fa-user-plus" style="color: #fff;"></i>Dodaj ucznia</a>
    </div>

    <?php
    include('../DB/db_student.php');
    $baza = new db_student();

    if(!empty($_GET)){
        $baza->databaseConnect();
        if(isset($_GET['del']))
        {
            $id_ucznia=$_GET['id'];
            $baza->deleteUczen($id_ucznia);
        }
        if(isset($_GET['opcja'])){
            if($_GET['opcja'] == 'dodaj'){
                $imie = $_GET['imie'];
                $nazwisko = $_GET['nazwisko'];
                $PESEL = $_GET['PESEL'];
                $email = $_GET['email'];
                $uwagi = $_GET['uwagi'];
                $baza->insertUczen($imie, $nazwisko, $PESEL, $email, $uwagi);
            }
            elseif($_GET['opcja'] == 'edytuj'){
                $imie = $_GET['imie'];
                $nazwisko = $_GET['nazwisko'];
                $PESEL = $_GET['PESEL'];
                $email = $_GET['email'];
                $uwagi = $_GET['uwagi'];
                $id_ucznia = $_GET['id_ucznia'];
                $baza->updateUczen($id_ucznia, $imie, $nazwisko, $PESEL, $email, $uwagi);
            }
        }
        else{
            echo "<p>Ucznia nie ma w naszej bazie</p>";
        }
    }
    
    $baza->databaseConnect();
    $data = $baza->selectUczen();
    if (!empty($data)){
    
    ?>
    <div class="wpisy">
        <?php
            while($row = mysqli_fetch_assoc($data))
            {
                echo "<div id='wpis' class='artykul'>Imię: ".$row['imie']." Nazwisko: ".$row['nazwisko']." PESEL: ".$row['PESEL']." e-mail: ".$row['email']." Uwagi: ".$row['comments']."
                <button class='delete'><a href=student_list.php?del=True&id=".$row['id_ucznia'].">
                Usuń ucznia
                </a></button>
                <button class='delete'><a href=student_edit.php?id=".$row['id_ucznia'].">
                Edytuj ucznia
                </a></button>
                </div>";
            }
            } else {
                echo "Brak uczniów";
            }
            $baza->close();
        ?>
    </div>
</body>
</html>
<!-- Formularz dodający ucznia do bazy danych, pole wyszukiwania uczniów, raport (tabela) po kliknięciu na przycisk będzie pokazywała wszystkich uczniów lub uczniów zaczynających się na określoną literę nazwiska lub imienia (wyszukiwanie ucznia) wraz z informacją jakie książki wypożyczył do tej pory i jakie książki ma wypożyczone, -->

</body>
</html>