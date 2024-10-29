function resetujPola() {
    var formularz = document.getElementById("MyForm");
    formularz.reset();
}

// Dropdown button code
const dropdown = document.querySelectorAll('.dropdown');

dropdown.forEach(e => {
    const dropdowntop = e.querySelectorAll('.dropdown-top');
    const dropdownitems = e.querySelectorAll('.dropdown-item');
    const link = e.querySelectorAll('a');
    const icon = e.querySelectorAll('i');

    dropdowntop.forEach(btn => {
        btn.addEventListener('click', e => {
            btn.classList.toggle('active');
            icon.forEach(e => {
                e.className = e.className === 'fa-solid fa-caret-down' ? 'fa-solid fa-bars' : 'fa-solid fa-caret-down'; 
            });
            link.forEach(e => {
                e.classList.toggle('active');
            });
            e.preventDefault();
            for (let i = 0; i < dropdownitems.length; i++) {
                dropdownitems[i].classList.toggle('active');
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const typKontaFirma = document.getElementById('firma');
    const typKontaOsobaPubliczna = document.getElementById('osoba_publiczna');
    const nazwaFirmyGroup = document.getElementById('nazwa_firmy_group');
    const nazwaFirmyCdGroup = document.getElementById('nazwa_firmy_cd_group');
    const nipGroup = document.getElementById('nip_group');
    const numer_telefonu_firma = document.getElementById('numer_telefonu_firma');
    const numer_telefonu = document.getElementById('numer_telefonu');
    const numer_telefonu_firma_txt = document.getElementById('numer_telefonu_firma_txt');
    const numer_telefonu_txt = document.getElementById('numer_telefonu_txt');
    const submitButton = document.querySelector('.button');

    const imie = document.getElementById('imie');
    const nazwisko = document.getElementById('nazwisko');
    const nazwa_firmy = document.getElementById('nazwa_firmy');
    const nazwa_firmy_cd = document.getElementById('nazwa_firmy_cd');
    const nip = document.getElementById('nip');

    // Funkcja do przełączania widoczności pól w zależności od typu konta
    function toggleFields() {
        if (typKontaOsobaPubliczna.checked) {
            numer_telefonu_firma.style.display = 'none';
            numer_telefonu.style.display = 'block';
            numer_telefonu_firma_txt.style.display = 'none';
            numer_telefonu_txt.style.display = 'block';
            nazwaFirmyGroup.style.display = 'none';
            nazwaFirmyCdGroup.style.display = 'none';
            nipGroup.style.display = 'none';

            numer_telefonu_firma.required = false;
            numer_telefonu.required = true;
            imie.required = true;
            nazwisko.required = true;
            nazwa_firmy.required = false;
            nazwa_firmy_cd.required = false;
            nip.required = false;

            submitButton.textContent = 'Zarejestruj użytkownika';
        } else {
            numer_telefonu_firma.style.display = 'block';
            numer_telefonu.style.display = 'none';
            numer_telefonu_firma_txt.style.display = 'block';
            numer_telefonu_txt.style.display = 'none';
            nazwaFirmyGroup.style.display = 'block';
            nazwaFirmyCdGroup.style.display = 'block';
            nipGroup.style.display = 'block';

            numer_telefonu_firma.required = true;
            numer_telefonu.required = false;
            nazwa_firmy.required = true;
            nazwa_firmy_cd.required = true;
            nip.required = true;

            submitButton.textContent = 'Zarejestruj firmę';
        }
    }

    // Nasłuchiwanie zmiany typu konta
    typKontaFirma.addEventListener('change', toggleFields);
    typKontaOsobaPubliczna.addEventListener('change', toggleFields);

    // Początkowe ustawienie pól na podstawie domyślnego wyboru
    toggleFields();
});
