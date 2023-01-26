Praca Inżynierska
=================

Temat: Projekt i implementacja aplikacji internetowej umożliwiającej znalezienie psiego opiekuna
------------------------------------------------------------------------------------------------

### Autor: Rafał Antochowski

Aplikacja została zbudowana z wykorzystaniem technologii Laravel, MySQL i Alpine.js.

Uruchomienie aplikacji
----------------------

Przed uruchomieniem aplikacji, należy skonfigurować plik `.env`:

*   ustawić połączenie z bazą danych,
*   ustawić adres serwera SMTP do wysyłki maili.

Następnie uruchomić migracje tabel bazy danych:

`php artisan migrate`

Potem wypełnić danymi testowymi:

`php artisan db:seed`

Aby uruchomić Vite, wykonaj:

`npm run vite`

Aby uruchomić aplikację, wykonaj:

`php artisan serve`

Aplikacja powinna być dostępna pod adresem `http://localhost:8000`.

Uwaga:

*   W przypadku problemów z migracją bazy danych, należy uruchomić komendę `php artisan migrate:fresh --seed`,
*   Upewnij się, że masz zainstalowane wszystkie wymagane zależności, takie jak PHP, MySQL, Node.js i npm.
