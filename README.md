# Contact Form（Laravel）

Laravelで作成したお問合せフォームアプリです。

---

## 環境構築

### 1. リポジトリをクローン
```bash
git clone https://github.com/nae6/laravel-contact-form.git
cd laravel-contact-form
```

### 2. Dockerビルド
```bash
docker-compose up -d --build
```

### 3. Laravel環境構築

#### 1. PHPコンテナに入る
```bash
docker-compose exec php bash
```

#### 2. Laravelパッケージのインストール
```bash
composer install
```

#### 3. .env作成
```bash
cp .env.example .env
php artisan key:generate
```

#### 4. DB作成・初期データセット
```bash
php artisan migrate
php artisan db:seed
```

---

## 開発環境
- お問合せ画面: http://localhost:8081
- ユーザー登録: http://localhost:8081/register
- phpMyAdmin: http://localhost:8080

---

## 使用技術
- PHP: 8.4.16
- Laravel: 8.83.29
- MySQL: 8.4.7
- nginx: 1.28.1
- DB: MySQL
- View: Blade
- Docker / docker-compose

---

## ER図

### テーブル構成
- users
- contacts
- categories

### リレーション
- categories (1) ─── (N) contacts

< - - - ER図を挿入する - - - >
