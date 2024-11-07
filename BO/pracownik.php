<div id="contactInfo" class="contact-container">
<?php
	include('../DB/db_pracownicy.php');
	$baza = new db_pracownicy();
	
	$baza->databaseConnect();
	$id_pracownik = $_GET['id_pracownik'];
	$data = $baza->selectPracownikById($id_pracownik);
	
	while($row = mysqli_fetch_assoc($data))
	{
		echo "<div class='artykul_full'>Tytuł: ".$row['title']."<br>Data: ".$row['data']."<article><p>Treść:</p>".$row['text']."</article><br>Autor: ".$row['author']."</div>";
	}

	$baza->close();
?>
<a href="./index.php">Powrót</a>
</div>