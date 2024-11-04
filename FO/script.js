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

document.addEventListener("DOMContentLoaded", function () {
    // Pobieranie elementów
    const radioFirma = document.getElementById("firma");
    const radioOsobaPubliczna = document.getElementById("osoba_publiczna");
    const nazwaFirmy = document.getElementById("nazwa_firmy");
    const nazwaFirmyCd = document.getElementById("nazwa_firmy_cd");
    const nip = document.getElementById("nip");
    const numerTelefonuFirmaLabel = document.getElementById("numer_telefonu_firma_txt");
    const numerTelefonuFirma = document.getElementById("numer_telefonu_firma");
    const numerTelefonu = document.getElementById("numer_telefonu");
    const email = document.getElementById("adres_e_mail");
    const emailFirma = document.getElementById("adres_e_mail_firma");
    const buttonText = document.querySelector(".button");

    // Funkcja zmieniająca widoczność i teksty
    function toggleFields() {
        if (radioFirma.checked) {
            // Ustawienia dla firmy
            nazwaFirmy.style.display = "block";
            nazwaFirmyCd.style.display = "block";
            nip.style.display = "block";
            email.textContent = "Email firmy:";
            email.style.display = "none";
            emailFirma.style.display = "block";
            numerTelefonuFirmaLabel.textContent = "Numer telefonu firmy:";
            numerTelefonuFirma.style.display = "block";
            numerTelefonu.style.display = "none";
            buttonText.textContent = "Zarejestruj firmę";
        } else if (radioOsobaPubliczna.checked) {
            // Ustawienia dla osoby publicznej
            nazwaFirmy.style.display = "none";
            nazwaFirmyCd.style.display = "none";
            nip.style.display = "none";
            numerTelefonuFirmaLabel.textContent = "Numer telefonu:";
            email.textContent = "Email:";
            email.style.display = "block";
            emailFirma.style.display = "none";
            numerTelefonuFirma.style.display = "none";
            numerTelefonu.style.display = "block";
            buttonText.textContent = "Zarejestruj użytkownika";
        }
    }

    // Nasłuchiwanie zmian w przyciskach radiowych
    radioFirma.addEventListener("change", toggleFields);
    radioOsobaPubliczna.addEventListener("change", toggleFields);

    // Wywołanie funkcji przy ładowaniu strony, aby ustawić początkowe wartości
    toggleFields();
});
