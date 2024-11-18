drop database if exists secur_it; -- Usuń bazę danych, jeśli istnieje
create database secur_it; -- Utwórz bazę danych
use secur_it; -- Użyj bazy danych

-- Tabela stanowiska pracy
create table positions (
    id_position int primary key auto_increment, -- Identyfikator stanowiska
    name varchar(50) -- Nazwa stanowiska
);

-- Tabela lokalizacje
create table locations (
    id_location int primary key auto_increment, -- Identyfikator lokalizacji
    building_number varchar(10), -- Numer budynku
    street varchar(100), -- Ulica
    city varchar(200), -- Miasto
    postal_code varchar(10), -- Kod pocztowy
    country varchar(50) -- Kraj
);

-- Tabela działy
create table departments (
    id_department int primary key auto_increment, -- Identyfikator działu
    department_name varchar(100) -- Nazwa działu
);

-- Tabela typy paliwa
create table fuel_types (
    id_fuel_type int primary key auto_increment, -- Identyfikator typu paliwa
    fuel_type varchar(50) -- Typ paliwa
);

-- Tabela samochody
create table cars (
    id_car int primary key auto_increment, -- Identyfikator samochodu
    brand varchar(50), -- Marka
    model varchar(100), -- Model
    production_year date, -- Rok produkcji
    color varchar(50), -- Kolor
    mileage varchar(15), -- Przebieg
    engine_capacity varchar(20), -- Pojemność silnika
    power varchar(10), -- Moc
    id_fuel_type int, -- Identyfikator typu paliwa
    vin_number varchar(30), -- Numer VIN
    foreign key (id_fuel_type) references fuel_types (id_fuel_type) -- Klucz obcy do tabeli typy_paliwa
);

-- Tabela rabaty
create table discounts (
    id_discount int primary key auto_increment, -- Identyfikator rabatu
    discount_value varchar(5) -- Wartość rabatu
);

-- Tabela numery kierunkowe
create table country_codes (
    id_country_code int primary key auto_increment, -- Identyfikator numeru kierunkowego
    country_code varchar(10), -- Numer kierunkowy
    country varchar(50) -- Kraj
);

-- Tabela firmy
create table companies (
    id_company int primary key auto_increment, -- Identyfikator firmy
    name varchar(50), -- Nazwa
    additional_name varchar(100), -- Dodatkowa nazwa
    tax varchar(20), -- NIP
    id_country_code int, -- Identyfikator numeru kierunkowego
    phone_number varchar(20), -- Numer telefonu
    email_address varchar(200), -- Adres e-mail
    foreign key (id_country_code) references country_codes (id_country_code) -- Klucz obcy do tabeli numery_kierunkowe
);

-- Tabela umowy
create table contracts (
    id_contract int primary key auto_increment, -- Identyfikator umowy
    contract_number varchar(50), -- Numer umowy
    PESEL varchar(11), -- PESEL
    insurance_number varchar(200), -- Numer ubezpieczenia
    employment_period varchar(25), -- Okres zatrudnienia
    start_date date, -- Data rozpoczęcia pracy
    end_date date, -- Data zakończenia pracy
    salary int(11), -- Wynagrodzenie
    bonus int(5), -- Premia
    id_position int, -- Identyfikator stanowiska
    id_work_location int, -- Identyfikator lokalizacji pracy
    id_department int, -- Identyfikator działu
    foreign key (id_position) references positions (id_position), -- Klucz obcy do tabeli stanowiska
    foreign key (id_work_location) references locations (id_location) -- Klucz obcy do tabeli lokalizacje
);

-- Tabela pracownicy
create table employees (
    id_employee int primary key auto_increment, -- Identyfikator pracownika
    home_address varchar(200), -- Adres zamieszkania
    id_contract int, -- Identyfikator umowy
    date_of_birth date, -- Data urodzenia
    photo varchar(100), -- Zdjęcie
    is_admin boolean, -- Czy administrator
    id_position int, -- Identyfikator stanowiska
    id_car int, -- Identyfikator samochodu
    foreign key (id_contract) references contracts (id_contract), -- Klucz obcy do tabeli umowy
    foreign key (id_position) references positions (id_position), -- Klucz obcy do tabeli stanowiska
    foreign key (id_car) references cars (id_car) -- Klucz obcy do tabeli samochody
);

-- Tabela użytkownicy
create table users (
    id_user int primary key auto_increment, -- Identyfikator użytkownika
    id_employee int, -- Identyfikator pracownika
    id_company int, -- Identyfikator firmy
    first_name varchar(50), -- Imię
    last_name varchar(100), -- Nazwisko
    id_country_code int, -- Identyfikator numeru kierunkowego
    phone_number varchar(20), -- Numer telefonu
    email_address varchar(200), -- Adres e-mail
    username varchar(50), -- Login
    password varchar(250), -- Hasło
    is_company_admin boolean, -- Czy administrator firmy
    id_discount int, -- Identyfikator rabatu
    foreign key (id_employee) references employees (id_employee), -- Klucz obcy do tabeli pracownicy
    foreign key (id_country_code) references country_codes (id_country_code), -- Klucz obcy do tabeli numery_kierunkowe
    foreign key (id_discount) references discounts (id_discount) -- Klucz obcy do tabeli rabaty
);

-- Tabela typy usług
create table service_types (
    id_service_type int primary key auto_increment, -- Identyfikator typu usługi
    service_type varchar(100) -- Typ usługi
);

-- Tabela usługi
create table services (
    id_service int primary key auto_increment, -- Identyfikator usługi
    id_service_type int, -- Identyfikator typu usługi
    name varchar(100), -- Nazwa
    description longtext, -- Opis
    price decimal(10,2), -- Cena
    foreign key (id_service_type) references service_types (id_service_type) -- Klucz obcy do tabeli typy_uslug
);

-- Tabela wpisy
create table posts (
    id_post int primary key auto_increment, -- Identyfikator wpisu
    id_user int, -- Identyfikator użytkownika
    title varchar(200), -- Tytuł
    content longtext, -- Treść
    date_added datetime, -- Data dodania
    id_approving_employee int, -- Identyfikator zatwierdzającego pracownika
    approval_date datetime, -- Data zatwierdzenia
    foreign key (id_user) references users (id_user), -- Klucz obcy do tabeli użytkownicy
    foreign key (id_approving_employee) references employees (id_employee) -- Klucz obcy do tabeli pracownicy
);

-- Tabela opinie
create table reviews (
    id_review int primary key auto_increment, -- Identyfikator opinii
    id_user int, -- Identyfikator użytkownika
    review_date date, -- Data opinii
    review_content longtext, -- Treść opinii
    foreign key (id_user) references users (id_user) -- Klucz obcy do tabeli użytkownicy
);

-- Tabela o firmie
create table about_company (
    id_about_company int primary key auto_increment, -- Identyfikator informacji o firmie
    title varchar(255), -- Tytuł
    description longtext -- Opis
);

-- Tabela formularz kontaktowy
create table contact_form (
    id_contact_form int primary key auto_increment, -- Identyfikator formularza kontaktowego
    first_name varchar(50), -- Imię
    last_name varchar(100), -- Nazwisko
    email varchar(200), -- Adres e-mail
    id_country_code int, -- Identyfikator numeru kierunkowego
    phone_number varchar(30), -- Numer telefonu
    title varchar(150), -- Tytuł
    message longtext, -- Wiadomość
    consent boolean, -- Zgoda na przetwarzanie danych
    id_employee int, -- Identyfikator pracownika
    foreign key (id_employee) references employees (id_employee), -- Klucz obcy do tabeli pracownicy
    foreign key (id_country_code) references country_codes (id_country_code) -- Klucz obcy do tabeli numery_kierunkowe
);




insert into `country_codes`(`country`, `country_code`) values
('Afganistan', '+93'),
('Alaska', '+1907'),
('Albania', '+355'),
('Algieria', '+213'),
('Andora', '+376'),
('Angola', '+244'),
('Antyle Holenderskie', '+599'),
('Arabia Saudyjska', '+966'),
('Argentyna', '+54'),
('Armenia', '+374'),
('Australia', '+61'),
('Austria', '+43'),
('Azerbejdżan', '+994'),
('Bahamy', '+1242'),
('Bahrajn', '+973'),
('Bangladesz', '+880'),
('Belgia', '+32'),
('Benin', '+229'),
('Białoruś', '+375'),
('Boliwia', '+591'),
('Bośnia i Hercegowina', '+387'),
('Botswana', '+267'),
('Brazylia', '+55'),
('Brunei', '+673'),
('Bułgaria', '+359'),
('Burkina Faso', '+226'),
('Burundi', '+257'),
('Chile', '+56'),
('Chiny', '+86'),
('Chorwacja', '+385'),
('Cook’a Wyspy', '+682'),
('Cypr', '+357'),
('Czad', '+235'),
('Czechy', '+420'),
('Dania', '+45'),
('Diego Garcia', '+246'),
('Dominikana', '+1809'),
('Dżibuti', '+253'),
('Egipt', '+20'),
('Ekwador', '+593'),
('Erytrea', '+291'),
('Estonia', '+372'),
('Etiopia', '+251'),
('Falklandy', '+500'),
('Fidżi', '+679'),
('Filipiny', '+63'),
('Finlandia', '+358'),
('Francja', '+33'),
('Gabon', '+241'),
('Gambia', '+220'),
('Ghana', '+233'),
('Gibraltar', '+350'),
('Grecja', '+30'),
('Grenlandia', '+299'),
('Gruzja', '+995'),
('Gujana Francuska', '+594'),
('Gujana', '+592'),
('Gwadelupa', '+590'),
('Gwinea – Bissau', '+245'),
('Gwinea Równikowa', '+240'),
('Gwinea', '+224'),
('Hawaje', '+1808'),
('Hiszpania', '+34'),
('Holandia', '+31'),
('Hong Kong', '+852'),
('Indie', '+91'),
('Indonezja', '+62'),
('Irak', '+964'),
('Iran', '+98'),
('Irlandia', '+353'),
('Islandia', '+354'),
('Izrael', '+972'),
('Japonia', '+81'),
('Jemen', '+967'),
('Jordania', '+962'),
('Jugosławia', '+381'),
('Kambodża', '+588'),
('Kamerun', '+237'),
('Kanada', '+1'),
('Kanaryjskie Wyspy', '+34'),
('Katar', '+974'),
('Kazachstan', '+7'),
('Kenia', '+254'),
('Kirgistan', '+996'),
('Kiribati', '+686'),
('Kolumbia', '+57'),
('Komory', '+269'),
('Kongo Republika Demokrat.', '+234'),
('Kongo', '+242'),
('Korea Południowa', '+82'),
('Koreańska RL-D', '+850'),
('Kostaryka', '+506'),
('Kuba', '+53'),
('Kuwejt', '+965'),
('Laos', '+856'),
('Lesotho', '+266'),
('Liban', '+961'),
('Liberia', '+231'),
('Libia', '+218'),
('Liechtenstein', '+423'),
('Litwa', '+370'),
('Luksemburg', '+352'),
('Łotwa', '+371'),
('Macedonia', '+389'),
('Madagaskar', '+261'),
('Makau', '+853'),
('Malawi', '+265'),
('Malediwy', '+960'),
('Malezja', '+60'),
('Mali', '+223'),
('Malta', '+356'),
('Maroko', '+212'),
('Marshalla Wyspy', '+692'),
('Martynika', '+596'),
('Mauretania', '+222'),
('Mauritius', '+230'),
('Meksyk', '+52'),
('Mołdawia', '+373'),
('Monako', '+377'),
('Mongolia', '+976'),
('Mozambik', '+258'),
('Myanmar (Birma)', '+95'),
('Namibia', '+264'),
('Nauru', '+674'),
('Nepal', '+977'),
('Niemcy', '+49'),
('Niger', '+227'),
('Nigeria', '+234'),
('Nikaragua', '+505'),
('Niue', '+683'),
('Norfolk Wyspa', '+672'),
('Norwegia', '+47'),
('Nowa Kaledonia', '+687'),
('Nowa Zelandia', '+64'),
('Oman', '+968'),
('Owcze Wyspy', '+298'),
('Pakistan', '+92'),
('Palau', '+680'),
('Palestyna', '+970'),
('Panama', '+507'),
('Papua Nowa Gwinea', '+675'),
('Paragwaj', '+595'),
('Peru', '+51'),
('Polinezja Francuska', '+689'),
('Polska', '+48'),
('Portoryko', '+1787'),
('Portugalia', '+351'),
('Republika Południowej Afryki', '+27'),
('Republika Środkowoafrykańska', '+236'),
('Reunion', '+262'),
('Rosja', '+7'),
('Rumunia', '+40'),
('Rwanda', '+250'),
('Sain Christopher i Nevis', '+1869'),
('Saint Lucia', '+1758'),
('Saint Vincent', '+1809'),
('Salomona Wyspy', '+677'),
('Salwador', '+503'),
('Samoa Zachodnie', '+685'),
('Samoa', '+684'),
('San Marino', '+378'),
('Senegal', '+221'),
('Seszele', '+248'),
('Sierra Leone', '+232'),
('Singapur', '+65'),
('Słowacja', '+421'),
('Słowenia', '+386'),
('Somalia', '+252'),
('Sri Lanka', '+94'),
('Stany Zjednoczone Ameryki', '+1'),
('Suazi', '+268'),
('Sudan', '+249'),
('Surinam', '+597'),
('Syria', '+963'),
('Szwajcaria', '+41'),
('Szwecja', '+46'),
('Św. Heleny Wyspa', '+290'),
('Św. Piotra i Mikeleona Wyspy', '+508'),
('Św. Tomasza Wyspy', '+239'),
('Tadżykistan', '+992'),
('Tajlandia', '+66'),
('Tajwan', '+886'),
('Tanzania', '+255'),
('Togo', '+228'),
('Tokelau', '+690'),
('Tonga', '+676'),
('Tunezja', '+216'),
('Turcja', '+90'),
('Turkmenistan', '+993'),
('Turks i Caicos', '+1649'),
('Tuvalu', '+688'),
('Uganda', '+256'),
('Ukraina', '+380'),
('Urugwaj', '+598'),
('Uzbekistan', '+998'),
('Vanuatu', '+678'),
('Wallis i Futuna', '+681'),
('Watykan', '+39'),
('Wenezuela', '+58'),
('Węgry', '+36'),
('Wielka Brytania', '+44'),
('Wietnam', '+84'),
('Włochy', '+39'),
('Wniebowstąpienia Wyspa', '+247'),
('Wybrzeże Kości Słoniowej', '+225'),
('Zambia', '+260'),
('Zanzibar', '+259'),
('Zielonego Przylądka Wyspy', '+238'),
('Zimbabwe', '+263');

INSERT INTO `service_types` (`id_service_type`, `service_type`) VALUES ('1', 'Sieci Komputerowe'), ('2', 'Systemy Operacyjne'), ('3', 'Bazy Danych'), ('4', 'Strony Internetowe'), ('5', 'Serwis Komputerowy');

INSERT INTO `positions` (`name`) VALUES
('Prezes'),
('Współzałożyciel'),
('Administrator Baz Danych'),
('Administrator IT'),
('Administrator Linux'),
('Administrator Serwerów'),
('Administrator Sieci'),
('Administrator Systemu'),
('Analityk Biznesowy'),
('Analityk Danych'),
('Architekt Sieci'),
('Informatyk'),
('Kierownik Help Desk'),
('Konsultant ds. IT'),
('Konsultant ds. Wsparcia Technicznego'),
('Pracownik help desk'),
('Specjalista ds. Cyberzagrożeń'),
('Specjalista ds. Informatyki'),
('Specjalista ds. IT'),
('Specjalista ds. licencji'),
('Specjalista ds. ochrony danych'),
('Specjalista ds. Oprogramowania'),
('Wdrożeniowiec'),
('Front-end Developer'),
('Back-end Developer'),
('Full Stack Developer'),
('Inżynier DevOps'),
('Młodszy Programista'),
('Starszy Programista'),
('Programista'),
('Pracownik Tester'),
('Programista Aplikacji Mobilnych'),
('Programista baz danych'),
('Webdeveloper'),
('Webmaster'),
('Dyrektor ds personalnych'),
('Analityk HR'),
('HR manager'),
('Specjalista ds. rekrutacji'),
('Kierownik działu kadr'),
('Specjalista ds. płac'),
('Specjalista ds. szkoleń'),
('Inspektor ds. BHP');

INSERT INTO `fuel_types` (`id_fuel_type`, `fuel_type`) VALUES (NULL, 'P - benzyna'), (NULL, 'D - olej napędowy'), (NULL, 'M - mieszanka paliwo-olej'), (NULL, 'LPG - gaz płynny propan-butan'), (NULL, 'CNG - gaz ziemny skroplony (metan)'), (NULL, 'H - wodór'), (NULL, 'BD - biodiesel'), (NULL, 'E85 - etanol'), (NULL, 'EE - energia elektryczna'), (NULL, '999 - inne');

INSERT INTO `services` (`id_service`, `id_service_type`, `name`, `description`, `price`) VALUES ('1', '1', 'Test Sieci Komputerowe', 'Test', '200'), ('2', '2', 'Test Systemy Operacyjne', 'Test', '100'), ('3', '3', 'Test Bazy Danych', 'Test', '250'), ('4', '4', 'Test Strony Internetowe', 'Test', '500'), ('5', '5', 'Test Serwis Komputerowy', 'Test', '200');

INSERT INTO `discounts`(`id_discount`, `discount_value`) VALUES 
('1','0,01'),
('2','0,02'),
('3','0,03'),
('4','0,04'),
('5','0,05'),
('6','0,06'),
('7','0,07'),
('8','0,08'),
('9','0,09'),
('10','0,1'),
('11','0,11'),
('12','0,12'),
('13','0,13'),
('14','0,14'),
('15','0,15'),
('16','0,16'),
('17','0,17'),
('18','0,18'),
('19','0,19'),
('20','0,2'),
('21','0,21'),
('22','0,22'),
('23','0,23'),
('24','0,24'),
('25','0,25'),
('26','0,26'),
('27','0,27'),
('28','0,28'),
('29','0,29'),
('30','0,3'),
('31','0,31'),
('32','0,32'),
('33','0,33'),
('34','0,34'),
('35','0,35'),
('36','0,36'),
('37','0,37'),
('38','0,38'),
('39','0,39'),
('40','0,4'),
('41','0,41'),
('42','0,42'),
('43','0,43'),
('44','0,44'),
('45','0,45'),
('46','0,46'),
('47','0,47'),
('48','0,48'),
('49','0,49'),
('50','0,5'),
('51','0,51'),
('52','0,52'),
('53','0,53'),
('54','0,54'),
('55','0,55'),
('56','0,56'),
('57','0,57'),
('58','0,58'),
('59','0,59'),
('60','0,6'),
('61','0,61'),
('62','0,62'),
('63','0,63'),
('64','0,64'),
('65','0,65'),
('66','0,66'),
('67','0,67'),
('68','0,68'),
('69','0,69'),
('70','0,7'),
('71','0,71'),
('72','0,72'),
('73','0,73'),
('74','0,74'),
('75','0,75'),
('76','0,76'),
('77','0,77'),
('78','0,78'),
('79','0,79'),
('80','0,8'),
('81','0,81'),
('82','0,82'),
('83','0,83'),
('84','0,84'),
('85','0,85'),
('86','0,86'),
('87','0,87'),
('88','0,88'),
('89','0,89'),
('90','0,9'),
('91','0,91'),
('92','0,92'),
('93','0,93'),
('94','0,94'),
('95','0,95'),
('96','0,96'),
('97','0,97'),
('98','0,98'),
('99','0,99'),
('100','1');

INSERT INTO `companies`(`id_company`, `name`, `additional_name`, `tax_id`, `id_country_code`, `phone_number`, `email_address`) 
VALUES ('2', 'testcompany', 'testcompanycd', 'testNIP', '144', '121212121', 'testf@test.pl');

INSERT INTO `users`(`id_user`, `id_employee`, `id_company`, `first_name`, `last_name`, `id_country_code`, `phone_number`, `email_address`, `username`, `password`, `is_company_admin`, `id_discount`) 
VALUES ('2', NULL, '2', 'Test', 'Test', '145', '111111111', 'test@test.pl', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '1', NULL);

INSERT INTO `users`(`id_user`, `id_employee`, `id_company`, `first_name`, `last_name`, `id_country_code`, `phone_number`, `email_address`, `username`, `password`, `is_company_admin`, `id_discount`) 
VALUES ('3', NULL, '2', 'Test2', 'Test2', '145', '222222222', 'test2@test.pl', 'test2', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', NULL, NULL);