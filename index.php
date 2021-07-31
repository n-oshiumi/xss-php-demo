<?php
session_start();
try {
    // ログイン状態かどうか確認
    if (!isset($_SESSION["login"])) {
        session_regenerate_id(TRUE);
        header("Location: login.php");
        exit();
    }

    // データベースと接続
    require_once('./database.php');

    // 認証ユーザーを取得する
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email');
    $stmt->bindValue(":email", $_SESSION["login"], PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $userId = $result["id"];

    // 検索結果を取得する（何も検索していない場合は該当ユーザーのメモ全て）
    $searchText = isset($_GET["search"]) ? $_GET['search'] : null;
    $sql = " SELECT * FROM memos JOIN users ON users.id=memos.user_id WHERE user_id = $userId AND title LIKE '%" . $searchText . "%'"; //後で表示するようのSQL
    $stmt = $pdo->prepare(" SELECT * FROM memos JOIN users ON users.id=memos.user_id WHERE user_id = $userId AND title LIKE :search");
    $stmt->bindValue(":search", '%' . $searchText . '%', PDO::PARAM_STR);

    //実行する
    $res = $stmt->execute();

    $memos = ($res) ? $stmt->fetchAll() : [];

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> マイメモ帳 | SQLインジェクション脆弱性あり</title>
    <link rel="stylesheet" href="./css/destyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-default bg-info">
        <div class="container-fluid justify-content-center">
            <div class="navbar-header">
                <div class="navbar-brand text-white">SQLインジェクション体験ができるマイメモ帳</div>
            </div>
        </div>
        </nav>
    </header>
    <div class="body-wrapper p-5">
        <div class="notes mb-5">
            <p class="note text-gray mb-2">※当サイトはSQLインジェクションを体験するためのサイトです。実際の掲示板としては運用していません。</p>
            <p class="note text-gray mb-2">※当サイトで得た知識を悪用しないでください。実際に運用されているサイトでSQLインジェクション攻撃を行うことは犯罪です。</p>
        </div>

        <!-- 検索フォーム -->
        <form method="get" action="/?search">
            <div class="form-group row">
                <div class="ml-3 mr-2">
                    <input type="text" class="form-control" placeholder="検索する" name="search">
                </div>
                <button type="submit" class="btn btn-primary mb-2">検索する</button>
            </div>
        </form>
        <div class="card-wrapper">
            <?php foreach ($memos as $memo) :  ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $memo["title"]; ?></h5>
                    <p class="card-text"><?= $memo["content"]; ?></p>
                    <p class="card-text">作成者： <?= $memo["email"]; ?></p>
                    <a href="#" class="btn btn-primary">見る</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div>生成されるSQL: <?= $sql; ?></div>
    </div>
</body>
</html>
