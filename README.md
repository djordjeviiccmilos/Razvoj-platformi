# Platforma za pripremu prijemnog iz informatike

## Pregled
Ovaj repozitorijum sadrži kompletnu platformu za pripremu kandidata za prijemni ispit iz informatike na Departmanu za računarske nauke PMF-a u Nišu. Sistem kombinuje backend servis napisan u Laravel-u i frontend React aplikaciju, uz MySQL bazu podataka i integraciju sa OpenAI API-jem za automatsko ocenjivanje otvorenih pitanja. Pitanja su sa prethodnih prijemnih ispita, izvučena iz zvaničnog informatora Departmana za računarske nauke.

## Tehnologije
- **Backend:** PHP 8.x, Laravel 9.x, Breeze
- **Baza:** MySQL (preporučeno preko WAMP-a)
- **Autentikacija:** Laravel Breeze, sesije i JWT za API
- **Frontend:** React 18, Vite, Bootstrap 5
- **Ostalo:** OpenAI API za ocenjivanje otvorenih pitanja

## Glavne funkcionalnosti
- **Autentikacija:** Registracija, prijava i promena lozinke, uz kontrolu ban stanja korisnika.
- **Administratori:** Pregled i upravljanje korisnicima, dodela uloga (nastavnik/student), banovanje/odbanuvanje korisnika i pitanja, uređivanje pitanja.
- **Nastavnici:** Kreiranje i uređivanje višestrukih i otvorenih pitanja, pregled objavljenih pitanja i upravljanje sopstvenim nalozima.
- **Studenti:** Generisanje testova sa 18 pitanja (15 višestrukih + 3 otvorena), kontrola toka polaganja i pregled ostvarenih poena.
- **AI ocenjivanje:** Automatsko ocenjivanje otvorenih odgovora preko OpenAI API-ja sa konfigurabilnim parametrima.
- **Statistika:** Pregled pojedinačnih rezultata i agregiranih metrika uspešnosti po korisniku, histogrami i statistički izveštaji.

## Struktura repozitorijuma
- **app/** Laravel aplikacija (kontroleri, modeli, servisi, rute)
- **frontend/** React klijent sa komponentama za administratora, nastavnike i studente
- **database/migrations/** migracije baze podataka
- **routes/** rute aplikacije
- **.env.example** konfiguracija okruženja
- **composer.json** PHP zavisnosti
- **frontend/package.json** JavaScript zavisnosti

## Preduslovi
- PHP 8.x i Composer
- Node.js 20+ i npm
- Pokrenuta MySQL baza sa korisnikom koji ima CREATE/ALTER privilegije
- OpenAI nalog i važeći API ključ
- Git i osnovni CLI alati

## Pokretanje backend-a
1. Instalirajte zavisnosti:  
   ```bash
   composer install
2. Kopirajte .env.example u .env i podesite parametre baze i OpenAI API ključ:
   ```bash
   cp .env.example .env
   
3. Pokrenite migracije:
   ```bash
   php artisan migrate
   
4. Pokrenite lokalni server:
   ```bash
   php artisan serve
API je dostupan na http://localhost:8000

5. Instalirajte zavisnosti:
   ```bash
   npm install
6. Pokrenite razvojni server:
   ```bash
   npm run dev
