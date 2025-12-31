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

