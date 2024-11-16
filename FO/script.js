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
document.addEventListener('DOMContentLoaded', () => {
    const typKontaRadios = document.querySelectorAll('input[name="typ_konta"]');
    const firmaDiv = document.querySelector('.firma');
    const submitButton = document.querySelector('.button');

    typKontaRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.value === 'firma') {
                firmaDiv.style.display = 'block'; // Pokaż sekcję dla firmy
                submitButton.textContent = 'Zarejestruj firmę'; // Zmień tekst przycisku
            } else {
                firmaDiv.style.display = 'none'; // Ukryj sekcję dla firmy
                submitButton.textContent = 'Zarejestruj użytkownika'; // Przywróć tekst przycisku
            }
        });
    });

    // Inicjalnie ustaw widoczność
    if (document.querySelector('#firma').checked) {
        firmaDiv.style.display = 'block';
    } else {
        firmaDiv.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const checkbox = document.getElementById('useOtherData');
    const kierunkowyField = document.getElementById('id_numer_kierunkowy');
    const fields = ['imie', 'nazwisko', 'numer_telefonu'];

    if (checkbox) {
        checkbox.addEventListener('change', () => {
            const isChecked = checkbox.checked;

            // Numer kierunkowy zmienia się na "Polska" (zakładamy ID = 1)
            kierunkowyField.value = isChecked ? '1' : kierunkowyField.dataset.defaultValue;

            // Pozostałe pola zmieniają stan
            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (isChecked) {
                    field.removeAttribute('readonly');
                    field.value = '';
                } else {
                    field.setAttribute('readonly', 'readonly');
                    if (field.dataset.defaultValue) {
                        field.value = field.dataset.defaultValue;
                    }
                }
            });
        });
    }
});

function resetujPola() {
    document.getElementById("MyForm").reset();
    const kierunkowyField = document.getElementById('id_numer_kierunkowy');
    if (kierunkowyField.dataset.defaultValue) {
        kierunkowyField.value = kierunkowyField.dataset.defaultValue;
    }
}

