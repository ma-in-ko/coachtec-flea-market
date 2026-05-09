# coachtec-flea-market
## 概要　　
ある企業が開発した独自のフリマアプリです。  
ユーザーは商品を出品したり、他ユーザーの商品を購入したりすることができます。  

  
## 目的  
商品の出品から購入までを、ECサイト上で完結できるフリマアプリを構築すること。  


## 機能一覧  
* 会員登録
* ログイン　/　ログアウト
* 商品出品
* 商品一覧表示
* 商品詳細表示
* コメント機能（商品へのコメント投稿）
* いいね機能（お気に入り登録）
* 商品購入（Stripeによる決済機能　/　コンビニ支払い）
* 配送先変更機能
* マイページ
* プロフィール編集
* メール認証
  

## 画面一覧
* 商品一覧画面（おすすめ　/　マイリスト）
* 商品詳細画面
* 購入画面
* 出品画面
* ログイン　/　会員登録画面
* マイページ（出品一覧　/　購入一覧）
* プロフィール編集画面

  
## 使用技術 
* PHP 8.1.34
* Laravel 8.83.29
* MySQL
* Docker
* Blade
* Laravel Fortify(認証機能)
* Stripe(決済)

## 環境構築 

### Dockerビルド
```
git clone https://github.com/ma-in-ko/coachtec-flea-market.git
cd coachtec-flea-market
docker compose up -d --build
```

### Laravelセットアップ
```
docker compose exec php bash  
composer install  
cp .env.example .env  
php artisan key:generate
php artisan storage:link
# 画像表示用のシンボリックリンクを作成
```

### データベース
```
php artisan migrate --seed  
```

## テストアカウント

### 一般ユーザー

email:test@example.com
password: password

## 認証機能

本アプリではユーザー認証機能としてLaravel Fortifyを使用しています。

### 実装内容
  * 会員登録
  * ログイン
  * ログアウト

### バリデーション
会員登録時のバリデーションはFormRequestを使用して実装しています。

### 初回ログイン
会員登録後はプロフィール設定画面へ遷移し、ユーザー情報を登録できるようにしています。

### メール認証
Mailhogを使用しています。
認証メールは以下で確認できます。
http://localhost:8025

## Stripe設定

.envファイルに以下を設定してください。

STRIPE_KEY=公開鍵
STRIPE_SECRET=シークレットキー

Stripeのテストモードを使用しています。

テストカード番号
4242　4242　4242　4242

有効期限：任意の未来日
cvc：任意の3桁

## 環境開発URL  
 http://localhost  
*phpMyAdmin  
 http://localhost:8080  

## ER図  
![ER図](docs/er.png)

## 工夫した点
* 画像表示をURL / storage　両対応に実装
* 未ログインユーザーは閲覧のみ可能、操作は制限する設計
* マイページのタブ切替をURLパラメータっで管理し、リロード時も状態を保持
* 商品一覧ではルートごとに表示を分け、シンプルな構成に
* UI統一感を意識し、商品画像サイズを調整

## 作成者

