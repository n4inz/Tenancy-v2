GUIDE

1. Gunakan laravel valet domain
2. ubah .envexample ke .env dan sesuaikan :<br>
    a. APP_URL : http://Domain-anda<br>
    b. SESSION_DOMAIN: .domain anda<br>
    c. DOMAIN:domain-anda
3. Jalankan Composer update && install
4  Jalankan php artisan key:generate
5. Jalankan php artisan:migrate
