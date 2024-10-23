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
    const imieGroup = document.getElementById('imie_group');
    const nazwiskoGroup = document.getElementById('nazwisko_group');
    const nazwaFirmyGroup = document.getElementById('nazwa_firmy_group');
    const nipGroup = document.getElementById('nip_group');
    
    // Funkcja do przełączania widoczności pól w zależności od typu konta
    function toggleFields() {
        if (typKontaOsobaPubliczna.checked) {
            imieGroup.style.display = 'block';
            nazwiskoGroup.style.display = 'block';
            nazwaFirmyGroup.style.display = 'none';
            nipGroup.style.display = 'none';
            document.getElementById('imie').required = true;
            document.getElementById('nazwisko').required = true;
            document.getElementById('nazwa_firmy').required = false;
            document.getElementById('nip').required = false;
        } else {
            imieGroup.style.display = 'none';
            nazwiskoGroup.style.display = 'none';
            nazwaFirmyGroup.style.display = 'block';
            nipGroup.style.display = 'block';
            document.getElementById('imie').required = false;
            document.getElementById('nazwisko').required = false;
            document.getElementById('nazwa_firmy').required = true;
            document.getElementById('nip').required = true;
        }
    }

    // Nasłuchiwanie zmiany typu konta
    typKontaFirma.addEventListener('change', toggleFields);
    typKontaOsobaPubliczna.addEventListener('change', toggleFields);

    // Początkowe ustawienie
    toggleFields();
});