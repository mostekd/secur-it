<?php
    include("db_connection.php");
    class db_numery_kierunkowe extends db_connection{
        function selectNrKierunkowe(){
            $query = 'SELECT * FROM numery_kierunkowe WHERE 1';
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0){
            return $data;
            }
        }
    }
?>
