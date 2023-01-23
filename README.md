### Stacked-with-Books ###
[ 主な機能 ]
- 管理画面
MAPで作成。
本のデータを扱うページ。
CRUD、タイトル入力後 □API検索にチェックを入れると楽天APIで検索を行います。
検索で目的の物を見つけたら、そのままファームに入力を出来ます。（タグのみ選択します）
 ![](https://storage.googleapis.com/zenn-user-upload/fefef46b378b-20220214.png)

- フロント
SAPで作成（こちらはフロントにVue.js使用）
主に検索を行うページ
「ジャンル」「タイトル」「お気に入り」「いいね」で検索可能
![](https://storage.googleapis.com/zenn-user-upload/f2dd11fc8a2d-20220214.png)

コメントを入力するページです。

![](https://storage.googleapis.com/zenn-user-upload/2ea39d8a2aa4-20220214.png)

[ URL ]
- https://stackedwithbooks.sakura.ne.jp/
ログイン
mail: test@mail.co.jp
password: password

[ 開発手法 ]
- Javascript 
- PHP 7.3

[ フレームワーク ]
- Laravel 6.20.26
- Vue.js 2.6.14

[ DB ]
- Mysql 5.7

[ ローカル環境 ]
- Docker  https://github.com/ueue511/laravel_docker.git

[ 本番環境 ]
- さくらサーバー

[ サービス ] 
- Cloudinary ( 画像管理)
