function resetujPola() {
    var formularz = document.getElementById("MyForm");
    formularz.reset();
}
// Dropdown button code untill ---------
const dropdown = document.querySelectorAll('.dropdown')

dropdown.forEach(e => {
    const dropdowntop = e.querySelectorAll('.dropdown-top');
    const dropdownitems = e.querySelectorAll('.dropdown-item');
    const link = e.querySelectorAll('a')
    const icon = e.querySelectorAll('i')

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
                dropdownitems[i].classList.toggle('active')
            }
        })
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const typKontaFirma = document.getElementById('firma');
    const typKontaOsobaPubliczna = document.getElementById('osoba_publiczna');
    const nazwaFirmyGroup = document.getElementById('nazwa_firmy_group');
    const nipGroup = document.getElementById('nip_group');
    const submitButton = document.querySelector('.button');  // Dodajemy selektor dla przycisku
    const numer_telefonu_firma = document.getElementById('numer_telefonu_firma');
    const numer_telefonu = document.getElementById('numer_telefonu');
    const numer_telefonu_firma_txt = document.getElementById('numer_telefonu_firma_txt');
    const numer_telefonu_txt = document.getElementById('numer_telefonu_txt');

    // Funkcja do przełączania widoczności pól w zależności od typu konta
    function toggleFields() {
        if (typKontaOsobaPubliczna.checked) {
            numer_telefonu_firma.style.display = 'none';
            numer_telefonu.style.display = 'block';
            numer_telefonu_firma_txt.style.display = 'none';
            numer_telefonu_txt.style.display = 'block';
            nazwaFirmyGroup.style.display = 'none';
            nazwa_firmy_cd_group.style.display = "none";
            nipGroup.style.display = 'none';
            document.getElementById('numer_telefonu_firma').required = false;
            document.getElementById('numer_telefonu').required = true;
            document.getElementById('imie').required = true;
            document.getElementById('nazwisko').required = true;
            document.getElementById('nazwa_firmy').required = false;
            document.getElementById('nazwa_firmy_cd').required = false;
            document.getElementById('nip').required = false;
            submitButton.textContent = 'Zarejestruj użytkownika';  // Zmiana tekstu przycisku
        } else {
            numer_telefonu_firma.style.display = 'block';
            numer_telefonu.style.display = 'none';
            numer_telefonu_firma_txt.style.display = 'block';
            numer_telefonu_txt.style.display = 'none';
            nazwa_firmy_cd_group.style.display = "block";
            nazwaFirmyGroup.style.display = 'block';
            nipGroup.style.display = 'block';
            document.getElementById('numer_telefonu_firma').required = true;
            document.getElementById('numer_telefonu').required = false;
            document.getElementById('nazwa_firmy').required = true;
            document.getElementById('nazwa_firmy_cd').required = true;
            document.getElementById('nip').required = true;
            submitButton.textContent = 'Zarejestruj firmę';  // Zmiana tekstu przycisku
        }
    }

    // Nasłuchiwanie zmiany typu konta
    typKontaFirma.addEventListener('change', toggleFields);
    typKontaOsobaPubliczna.addEventListener('change', toggleFields);

    // Początkowe ustawienie
    toggleFields();
});
