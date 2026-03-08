# coachtec-flea-market
## 概要　　
ある企業が開発した独自のフリマアプリです。  
ユーザーは商品を出品したり、他ユーザーの商品を購入したりすることができます。  
  
## 目的  
商品の出品から購入までを、ECサイト上で完結できるフリマアプリを構築すること。  

## 機能一覧  
* 会員登録
* ログイン
* 商品出品
* 商品一覧表示
* 商品詳細表示
* コメント
* いいね
* 商品購入
* マイページ
* プロフィール編集

## 使用技術  
* Laravel  
* MySQL
* Docker
* Blade

## 環境構築  
git clone  
docker compose up -d  
docker compose exec php bash  
composer install  
cp .env.example .env  
php artisan key:generate  
php artisan migrate  

### URL  

## URL  
環境開発  
http://localhost  

phpMyAddmin  
http://localhost:8080  

## ER図  

  
