<?php
if(!isset($_SESSION['sesja'])){
    session_start();
    $_SESSION['sesja'] = "test";
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $id_uzytkownik = $_SESSION['id_uzytkownik'];
    $czy_admin = $_SESSION['czy_admin'];
}
else {
    $id_uzytkownik = 0;
    $czy_admin  = 0;
}
?>
<nav class="top-nav">
                <a class="logo" href="./index.php"><img src="../images/logo.png" alt="logo"></a>                    
                <div class="top-nav-buttons">
                    <div class="dropdown">
                        <div class="dropdown-top">
                            <div class="dropdown-logo">Firma</div>
                        <div class="dropdown-toggle">
                            <i class="fa-solid fa-bars"></i>
                            </div>
                        </div>
                        <ol class="dropdown-list">
                            <li class="dropdown-item" style="--i:1;--j:2"><a href="./admin_o_firmie.php"></a>O Firmie</li>
                            <li class="dropdown-item" style="--i:2;--j:2"><a href="./admin_pracownicy.php"></a>Pracownicy</li>
                            <li class="dropdown-item" style="--i:3;--j:1"><a href="./admin_wpisy.php"></a>Wpisy</li>
                        </ol>
                    </div>
                    <div class="dropdown">
                        <div class="dropdown-top">
                            <div class="dropdown-logo">Usługi</div>
                            <div class="dropdown-toggle">
                                <i class="fa-solid fa-bars"></i>
                            </div>
                        </div>
                        <ol class="dropdown-list">
                            <li class="dropdown-item" style="--i:1;--j:5"><a href="./admin_sieci_komputerowe.php"></a>Sieci komputerowe</li>
                            <li class="dropdown-item" style="--i:2;--j:4"><a href="./admin_systemy_operacyjne.php"></a>Systemy Operacyjne</li>
                            <li class="dropdown-item" style="--i:3;--j:3"><a href="./admin_bazy_danych.php"></a>Bazy Danych</li>
                            <li class="dropdown-item" style="--i:4;--j:2"><a href="./admin_strony_internetowe.php"></a>Strony Internetowe</li>
                            <li class="dropdown-item" style="--i:5;--j:1"><a href="./admin_serwis_komputerowy.php"></a>Serwis Komputerowy</li>
                        </ol>
                    </div>
                    <div class="dropdown-kontakt">
                        <div class="dropdown-top-kontakt">
                            <a href="./admin_kontakt.php">Kontakt</a>
                        </div>
                    </div>
                    <div class="dropdown-kontakt">
                        <div class="dropdown-top-kontakt">
                            <a href="../FO/index.php">Strona Główna</a>
                        </div>
                    </div>
                </div>
                <div class="phone">
                    <div class="dropdown">
                        <div class="dropdown-top">
                            <div class="dropdown-toggle-phone">
                                <i class="fa-solid fa-bars"></i>
                            </div>
                        </div>
                        <ol class="dropdown-list">
                            <li class="dropdown-item" style="--i:1;--j:10"><a href="./admin_o-firmie.php"></a>O Firmie</li>
                            <li class="dropdown-item" style="--i:2;--j:9"><a href="./admin_pracownicy.php"></a>Pracownicy</li>
                            <li class="dropdown-item" style="--i:3;--j:8"><a href="./admin_wpisy.php"></a>Wpisy</li>
                            <li class="dropdown-item" style="--i:4;--j:7"><a href="./admin_sieci_komputerowe.php"></a>Sieci komputerowe</li>
                            <li class="dropdown-item" style="--i:5;--j:6"><a href="./admin_systemy_operacyjne.php"></a>Systemy Operacyjne</li>
                            <li class="dropdown-item" style="--i:6;--j:5"><a href="./admin_bazy_danych.php"></a>Bazy Danych</li>
                            <li class="dropdown-item" style="--i:7;--j:4"><a href="./admin_strony_internetowe.php"></a>Strony Internetowe</li>
                            <li class="dropdown-item" style="--i:8;--j:3"><a href="./admin_serwis_komputerowy.php"></a>Serwis Komputerowy</li>
                            <li class="dropdown-item" style="--i:9;--j:2"><a href="./admin_kontakt.php"></a>Kontakt</li>
                            <li class="dropdown-item" style="--i:10;--j:1"><a href="../FO/index.php"></a>Strona Główna</li>
                        </ol>
                    </div>
                </div>
            </nav>