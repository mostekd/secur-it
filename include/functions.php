<?php
    if(!isset($_SESSION['sesja'])){
        session_start();
        $_SESSION['sesja'] = "test";
    }
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $id_user = $_SESSION['id_user'];
        $is_admin = $_SESSION['is_admin'];
    }
    else {
        $id_user = 0;
        $is_admin  = 0;
    }

?>