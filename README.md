# coachtec-flea-market
## 概要　　
ある企業が開発した独自のフリマアプリです。  
ユーザーは商品を出品したり、他ユーザーの商品を購入したりすることができます。  
  
## 目的  
商品の出品から購入までを、ECサイト上で完結できるフリマアプリを構築すること。  

## 機能一覧  
* 会員登録
* ログイン/ログアウト
* 商品出品
* 商品一覧表示
* 商品詳細表示
* コメント
* いいね
* 商品購入
* Stripeによる決済機能
* ハイ移送先変更機能
* マイページ
* プロフィール編集

## 使用技術  
* Laravel  
* MySQL
* Docker
* Blade

## 環境構築 

### Dockerビルド

git clone (https://github.com/ma-in-ko/coachtec-flea-market.git)
cd coachtec-flea-marcket
docker compose up -d --build

### Laravelセットアップ
docker compose exec php bash  
composer install  
cp .env.example .env  
php artisan key:generate  

### データベース

php artisan migrate  

## Stripe設定
.envファイルに以下を設定してください。

STRIPE_KEY=公開鍵
STRIPE_SECRET=シークレットキー

Stripeのテストモードを使用しています。

テストカード番号
4242　4242　4242　4242


有効期限：任意の未来日
ＣＶＣ：任意の3桁

## URL  
*環境開発  
 http://localhost  
*phpMyAddmin  
 http://localhost:8080  

## ER図  
![ER図](docs/er.png)

##作成者

