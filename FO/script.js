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

// Funkcja do zarządzania widocznością i tekstami w formularzu
function ustawTypKonta(typ) {
    // Pobranie elementów pól firmowych
    const nazwaFirmyGroup = document.getElementById("nazwa_firmy_group");
    const nazwaFirmyCdGroup = document.getElementById("nazwa_firmy_cd_group");
    const nipGroup = document.getElementById("nip_group");
    const numerTelefonuFirma = document.getElementById("numer_telefonu_firma");
    const numerTelefonuFirmaLabel = document.getElementById("numer_telefonu_firma_txt");
    const numerTelefonu = document.getElementById("numer_telefonu");
    const emailLabel = document.getElementById("adres_e_mail").previousElementSibling;
    const submitButton = document.querySelector(".button");

    if (typ === "osoba_publiczna") {
        // Ukryj pola firmowe
        nazwaFirmyGroup.style.display = "none";
        nazwaFirmyCdGroup.style.display = "none";
        nipGroup.style.display = "none";
        numerTelefonuFirma.style.display = "none";

        // Pokaż pole numer telefonu osoby
        numerTelefonu.style.display = "block";

        // Zmień teksty na odpowiednie dla osoby publicznej
        numerTelefonuFirmaLabel.innerText = "Numer telefonu:";
        emailLabel.innerText = "Email:";
        submitButton.innerText = "Zarejestruj użytkownika";
    } else {
        // Pokaż pola firmowe
        nazwaFirmyGroup.style.display = "block";
        nazwaFirmyCdGroup.style.display = "block";
        nipGroup.style.display = "block";
        numerTelefonuFirma.style.display = "block";

        // Ukryj pole numer telefonu osoby
        numerTelefonu.style.display = "none";

        // Zmień teksty na odpowiednie dla firmy
        numerTelefonuFirmaLabel.innerText = "Numer telefonu firmy:";
        emailLabel.innerText = "Email firmy:";
        submitButton.innerText = "Zarejestruj firmę";
    }
}

// Obsługa zdarzeń na przyciskach wyboru typu konta
document.getElementById("osoba_publiczna").addEventListener("click", () => ustawTypKonta("osoba_publiczna"));
document.getElementById("firma").addEventListener("click", () => ustawTypKonta("firma"));

// Wywołanie początkowe, aby formularz był poprawnie ustawiony
ustawTypKonta(document.querySelector('input[name="typ_konta"]:checked').value);
