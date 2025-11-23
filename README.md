#coachtech フリマアプリ
git clone https://github.com/yminamo5-code/mogi1_furima.git
docker-compose up -d --build
docker-compose exec php bash
composer install
cp .env.example .env
    DB_HOST=mysql
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass
php artisan key:generate