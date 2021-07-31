# 使用するもの

- php 7.4以上
- mysql
- サーバーはご自由に


# 環境構築

## 専用のデータベースを作成する

ご自身のmysqlで好きな名前のデータベースを作成してください。
この例では、 sql_injection_phpとします

```sql
CREATE DATABASE xss_test;
USE xss_test;
```


## テーブルを作成しデータをいれる

データベースに入って、SQL文でテーブルを作成します。


- 投稿テーブルを作成

```sql
CREATE TABLE posts (id INT(11) AUTO_INCREMENT PRIMARY KEY, content TEXT) engine=innodb default charset=utf8;
```

- メモテーブルにデータをいれる

```sql
INSERT INTO posts(content) VALUES('これは初めての投稿です');
```

## ライブラリをインストールする
データベースの情報をソースに直書きするわけにはいかないので、 機密情報をenvファイルにいれています。
そのためのライブラリをインストールします。

```bash
composer install
```

## envファイルを作成する
ルートディレクトリ（index.phpと同じ階層）に「.env」という名前のファイルを作成してください
中身はご自身のデータベース情報をいれてください。

```bash
DB_HOST=localhost
DB_NAME=xss_test
DB_USERNAME=root
DB_PASSWORD=
```

## サーバーを立ち上げてローカル環境で確認する

僕の場合はphpのビルトインサーバーを使用するので下記のコマンドでいけます。
※xamppなど自分が普段使っているものがあればそちらをご使用ください。

```bash
php -S 127.0.0.1:3000
```

これの場合は `http://127.0.0.1:3000` にアクセスして、掲示板ページが映ればOKです！
