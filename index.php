<?php
// データベースと接続
require_once('./database.php');

// 検索結果を取得する（何も検索していない場合は該当ユーザーのメモ全て）
$stmt = $pdo->prepare("SELECT * FROM posts");
$res = $stmt->execute();

$posts = ($res) ? $stmt->fetchAll() : [];

if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'] ?? null;
    if (!$content) {
        $message = '投稿を入力してください';
    }

    //データ追加
    $stmt = $pdo->prepare("INSERT INTO posts (content) VALUES(:content)");
    $stmt->bindValue(":content", $content);
    $stmt->execute();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板 | XSS脆弱性あり</title>
    <link rel="stylesheet" href="./css/destyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-default bg-danger">
        <div class="container-fluid justify-content-center position-relative">
            <div class="navbar-header">
                <div class="navbar-brand text-white">XSS脆弱性体験ができる掲示板</div>
            </div>
            <a href="/register.php" id="to-register-form" class="btn btn-light position-absolute" style="right: 16px;">会員登録フォームはこちら</a>
        </div>
        </nav>
    </header>
    <div class="body-wrapper p-5">
        <div class="notes mb-5">
            <p class="note text-gray mb-2">※当サイトはXSS脆弱性を体験するためのサイトです。実際の掲示板としては運用していません。</p>
            <p class="note text-gray mb-2">※当サイトで得た知識を悪用しないでください。実際に運用されているサイトでXSS攻撃を行うことは犯罪です。</p>
        </div>

        <!-- 投稿フォーム -->
        <form method="POST" action="/">
            <div class="form-group ml-3">
                <div class="mr-2 mb-3 font-weight-bold">
                    <label for="post-textarea d-block">● 投稿フォーム</label>
                    <textarea class="form-control w-50" id="post-textarea" name="content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-danger mb-2">投稿する</button>
            </div>
        </form>
        <div class="card-wrapper mt-5">
            <h1 class="font-weight-bold">投稿一覧</h1>
            <?php foreach ($posts as $post) :  ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text"><?= $post["content"]; ?></p>
                    <a href="#" class="btn btn-danger">見る</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
