<?php
    class db_numery_kierunkowe extends db_connection {
        function selectNrKierunkowe() {
            $query = 'SELECT * FROM numery_kierunkowe WHERE 1';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }
        
        function selectNrKierunkowePolska() {
            $query = 'SELECT * FROM numery_kierunkowe WHERE kraj = "Polska"';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }

        function selectNrKierunkoweById($id_numer_kierunkowy) {
            $query = "SELECT * FROM numery_kierunkowe WHERE id_numer_kierunkowy = " . intval($id_numer_kierunkowy);
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0) {
                return $data;
            }
        }
    }
?>
