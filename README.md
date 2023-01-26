# PRACA INŻYNIERSKA

Temat: Projekt i implementacja aplikacji internetowej umożliwiającej znalezienie psiego opiekuna

Autor: Rafał Antochowski

Aplikacja zbudowana w oparciu o technologie Laravel, MySQL i Alpine.js

# URUCHOMIENIE APLIKACJI

Przed uruchomieniem aplikacji należy skonfigurować plik .env 
- ustawić połączenie z bazą danych
- ustawić adres serwera SMTP do wysiłki maili

Następnie uruchomić migracje tabeli bazy danych

php artisan serve

Potem wypełnić danymi

php artisan migrate:fresh --seed

Uruchomienie Vite

npm run vite

Uruchomienie aplikacji

php artisan serve
