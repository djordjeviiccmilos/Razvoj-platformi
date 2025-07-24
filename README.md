# Web aplikacija za pripremu prijemnog ispita sa ChatGPT integracijom

Ova web aplikacija omogućava učenicima da vežbaju zadatke za prijemni ispit iz informatike. Koristi OpenAI ChatGPT API za automatsko ocenjivanje otvorenih odgovora i pruža interaktivno iskustvo.

## Glavne funkcionalnosti

- Registracija i prijava korisnika (studenti, nastavnici, admini)
- Generisanje i rešavanje testova sa pitanjima višestrukog izbora i otvorenim odgovorima
- Automatsko ocenjivanje otvorenih pitanja pomoću ChatGPT modela
- Prikaz statistike i rezultata testova
- Administrativna kontrola pitanja i korisnika

## Tehnologije i alati

- Laravel (PHP) backend
- MySQL baza podataka
- OpenAI API za ocenjivanje
- Breeze za autentifikaciju
- Bootstrap za stilizaciju

## Kako pokrenuti lokalno

1. Klonirajte repozitorijum:
   ```bash
   git clone https://github.com/tvojusername/ime-projekta.git
   cd ime-projekta 
2. Instalirajte composer.
   ```bash
   composer install
3. Postavite .env fajl sa podacima za bazu i OpenAI ključem.
4. Pokrenite migracije i seeding baze:
   ```bash
   php artisan migrate --seed
5. Pokrenite backend server:
   ```bash
   php artisan serve
6. Proverite frontend:
   ```bash
   npm install
   npm start
7. Aplikacija će biti dostupna na http://localhost:3000
