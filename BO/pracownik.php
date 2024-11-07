<div id="contactInfo" class="contact-container">
<?php
	include('../DB/db_pracownicy.php');
	$baza = new db_pracownicy();
	
	$baza->databaseConnect();
	$id_pracownik = $_GET['id_pracownik'];
	$data = $baza->selectPracownikById($id_pracownik);
	
	while($row = mysqli_fetch_assoc($data))
	{
		echo "<div class='pracownik_ingo'>";
        echo "<img class='photo' src='".$row['zdjecie']."'><br>";
        echo "Imię: ".$row['imie']."<br>
        Nazwisko: ".$row['nazwisko']."<br>
        Numer telefonu: Numer telefonu: " .($row['numer_kierunkowy']) . " " .($row['numer_telefonu']) . "<br>
        Adres e-mail: ".$row['adres_e_mail']."<br>
        Adres zamieszkania: ".$row['adres_zamieszkania']."<br>
        Data urodzenia: ".$row['data_urodzenia']."<br>
        Numer umowy: ".$row['numer_umowy']."<br>
        PESEL: ".$row['PESEL']."<br>
        Numer ubezpieczenia: ".$row['numer_ubezpieczenia']."<br>
        Okres zatrudnienia: ".$row['okres_zatrudnienia']."<br>
        Data rozpoczęcia pracy: ".$row['data_rozpoczecia_pracy']."<br>
        Data zakończenia pracy: ".$row['data_zakonczenia_pracy']."<br>
        Wynagrodzenie: ".$row['wynagrodzenie']."<br>
        Wysokość premii: ".$row['premia']."<br>
        Lokalizacja pracy: ".$row['id_lokalizacja_pracy']."<br>
        Stanowisko: ".$row['nazwa']."<br>
        Dział: ".$row['nazwa_dzialu']."
        </div>";
	}

	$baza->close();
?>
<a href="./index.php">Powrót</a>
</div>