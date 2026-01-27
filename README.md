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
php artisan migrate --seed

public/storageにシンボリックリンクを作成。
php artisan storage:link

stripeの設定
Stripe管理画面はテストモードで作業して
STRIPE_KEY=Stripeダッシュボードで取得
STRIPE_SECRET=Stripeダッシュボードで取得

カード情報：https://docs.stripe.com/testing#test-code
メールアドレス：email@example.com
テスト用のクレジットカード番号：4242 4242 4242 4242
有効期限：任意の将来の日付(例：0130)
名前
CVC：任意の3桁　例：123

コンビニ
メールアドレス：email@example.com
名前
電話番号：例：09012341234

php -m | grep intl


mailtrapの設定
mailtrapにログインする。
サンドボックスを開き、SMTP情報を取得。
以下をenv.に記述。MAIL_USERNAMEとMAIL_PASSWORDには各々の設定値を入力する。
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=xxxxxxxx
MAIL_PASSWORD=xxxxxxxx
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=test@example.com
MAIL_FROM_NAME="${APP_NAME}"

PHPunitを用いたテスト

MySQLコンテナからMySQLに、rootユーザでログインして、demo_testというデータベースを作成
docker compose exec mysql bash
mysql -u root -p
CREATE DATABASE demo_test;

'connections' => []内に以下を記述
        'mysql_test' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ], 

cp .env .env.testing
    APP_ENV=test
    APP_KEY=
    DB_DATABASE=demo_test
    DB_USERNAME=root
    DB_PASSWORD=root

APP_KEYを加えるため以下を実行。
    docker compose exec php bash
    php artisan key:generate --env=testing
    php artisan config:clear
マイグレーションを実施し、テスト用のテーブルを作成。
    php artisan migrate --env=testing


phpunit.xmlを編集
-        <!-- <server name="DB_CONNECTION" value="sqlite"/> -->
-        <!-- <server name="DB_DATABASE" value=":memory:"/> -->
+       <server name="DB_CONNECTION" value="mysql_test"/>
+       <server name="DB_DATABASE" value="demo_test"/>

テストを実施
vendor/bin/phpunit

