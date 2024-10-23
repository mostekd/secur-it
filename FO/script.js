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
    const firma_form = document.getElementById('firma_form');
    const osoba_publiczna_form = document.getElementById('osoba_publiczna_form');
    
    // Funkcja do przełączania widoczności pól w zależności od typu konta
    function toggleFields() {
        if (typKontaOsobaPubliczna.checked) {
            osoba_publiczna_form.style.display = 'block';
            firma_form.style.display = 'none';
            document.getElementById('osoba_publiczna_form').required = true;
            document.getElementById('firma_form').required = false;
        } else {
            osoba_publiczna_form.style.display = 'none';
            firma_form.style.display = 'block';
            document.getElementById('osoba_publiczna_form').required = false;
            document.getElementById('firma_form').required = true;
        }
    }

    // Nasłuchiwanie zmiany typu konta
    typKontaFirma.addEventListener('change', toggleFields);
    typKontaOsobaPubliczna.addEventListener('change', toggleFields);

    // Początkowe ustawienie
    toggleFields();
});