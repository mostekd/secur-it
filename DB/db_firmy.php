<?php
include("db_connection.php");

class db_firmy extends db_connection
    {
        function selectFirmy()
        {
            $query = "SELECT * FROM `firmy` WHERE 1";
            $data = mysqli_query($this->connect, $query);
            if (mysqli_num_rows($data) > 0)
            {
                return $data;
            }
        }

        function selectFirmaById($id_firma)
        {
            $query = "SELECT * FROM `firmy` WHERE id_firma = ".$id_firma.";";
        }
    }
?>