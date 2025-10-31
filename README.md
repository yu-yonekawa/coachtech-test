#　 coachtech-test

##　環境構築

### 1. リポジトリの設定

- 'laravel-docker-template.git'をクローンしてリポジトリ名を**\*'coachtech-test'**に変更。
- GitHub 上で **'coachtech-test'** という新しいリポジトリを「Public」で作成。
- ローカルリポジトリのリモート先を新しいリポジトリに変更し、プッシュ。

```bash
git remote set-url origin git@github.com:yu-yonekawa/coachtech-test.git
git push origin main
```

### 2. Docker の設定

- 以下のコマンドライン実行

```bash
docker-compose up -d --build
```

coachtech-test コンテナ作成されていれば成功。

### 3. laravel のパッケージのインストール

- docker-compose コマンドで PHP コンテナ内にログイン。
- ログインできたら composer コマンドを使って必要なパッケージをインストール。

### 4. .env ファイルの作成

- データベースに接続するために.env ファイル作成。
- .env ファイルは、.env.example ファイルをコピーして作成。
- `.env` の 11 行目以降の **データベース接続情報（MySQL）** を修正
- `docker-compose.yml` の設定内容に合わせて、以下を変更：

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

- `php artisan key:generate` コマンドで APP_KEY を自動生成（※キー値は非公開）

### 5. データベース構築（マイグレーション）

#### マイグレーションファイル作成。

- テーブル仕様書に基づき、以下のテーブルを作成するマイグレーションを作成。

```bash
php artisan make:migration create_contacts_table
php artisan make:migration create_categories_table
php artisan make:migration create_users_table
```

- 実行コマンド

```bash
php artisan migrate
```

#### 結果

- contacts / categories / users の 3 テーブルを作成
- 外部キー設定（contacts.category_id → categories.id）を適用
- 実行ログで Migrated: と表示されることを確認

#### トラブル対応メモ

- 権限エラー発生時

```bash
sudo chown -R $USER:$USER database/migrations
```

### ダミーデータの作成（Seeder）

動作確認用に初期データを登録するため、Seeder を作成・実行しています。

#### 作成した Seeder

- `CategoriesTableSeeder`（お問い合わせ種別データ）
- `ContactsTableSeeder`（お問い合わせ初期データ）

#### 実行コマンド

```bash
php artisan db:seed
```

## 使用技術

- PHP 8.x
- Laravel 10.x
- MySQL 8.x
- Docker / docker-compose
- VSCode

## ER 図

- contacts（お問い合わせ）
- categories（カテゴリ）
- users（ユーザー）
  ※テーブル仕様書に基づき作成

## 備考

画面設計書の一部が閲覧できない不具合があったため、
本リポジトリでは環境構築と DB 設計、Seeder 作成までを実施。
次回以降、ルーティング・画面実装を追加予定。
