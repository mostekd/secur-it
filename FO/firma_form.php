<div class="form-group" id="imie_group">
    <label for="imie">Imię:</label>
    <input type="text" id="imie" name="imie" placeholder="Wpisz imię">
</div>

<!-- Pole Nazwisko dla osoby publicznej -->
<div class="form-group" id="nazwisko_group">
    <label for="nazwisko">Nazwisko:</label>
    <input type="text" id="nazwisko" name="nazwisko" placeholder="Wpisz nazwisko">
</div>

<!-- Pole Nazwa firmy dla firm -->
<div class="form-group" id="nazwa_firmy_group">
    <label for="nazwa_firmy">Nazwa firmy:</label>
    <input type="text" id="nazwa_firmy" name="nazwa_firmy" placeholder="Wpisz nazwę firmy">
</div>

<!-- Pole NIP dla firm -->
<div class="form-group" id="nip_group">
    <label for="nip">NIP:</label>
    <input type="text" id="nip" name="nip" placeholder="Wpisz NIP firmy">
</div>

<!-- Zawsze wypełniane -->
<div class="form-group">
    <label for="nick">Nazwa użytkownika (Nick):</label>
    <input type="text" id="nick" name="nick" placeholder="Wpisz nazwę użytkownika" required>
</div>

<div class="form-group">
    <label for="adres_e_mail">Email:</label>
    <input type="email" id="adres_e_mail" name="adres_e_mail" placeholder="Wpisz email" required>
</div>

<div class="form-group">
    <label for="numer_telefonu">Numer telefonu:</label>
    <?php
        include('../DB/db_numery_kierunkowe.php');
        $baza = new db_numery_kierunkowe();
        $baza->databaseConnect();
        
        $dataPolska = $baza->selectNrKierunkowePolska();
        if ($dataPolska){
            while ($row = mysqli_fetch_assoc($dataPolska)){
                $selectedId = $row["id_numer_kierunkowy"];
            } 
        }
        
        $data = $baza->selectNrKierunkowe();
        if ($data){
            
        echo '<div class="phone_number">';
        echo '<select class="kierunkowy" name="id_numer_kierunkowy" default="">';
        while ($row = mysqli_fetch_assoc($data)){
            $text = '<option id="pole" class="kierunkowy"';
            if($row["id_numer_kierunkowy"] == $selectedId)
            {
            $text .= 'selected = "selected"';
            } 
            $text .= ' value=' .$row["id_numer_kierunkowy"] .'> ' .$row["numer_kierunkowy"]. " " .$row["kraj"] .'</option>';

            echo $text;
        }
            echo '</select>';

            mysqli_free_result($data);
        } else {
            echo "Błąd zapytania: " .mysqli_error($connect);
        }

        
        $baza->close();
    ?>
    <input type="text" id="numer_telefonu" name="numer_telefonu" placeholder="Wpisz numer telefonu" required>
</div>

<div class="form-group">
    <label for="haslo">Hasło:</label>
    <input type="password" id="haslo" name="haslo" placeholder="Wpisz hasło" required>
</div>