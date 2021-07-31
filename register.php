<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板登録フォーム | XSS脆弱性あり</title>
    <link rel="stylesheet" href="./css/destyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-default bg-danger">
        <div class="container-fluid justify-content-center position-relative">
            <div class="navbar-header">
                <div class="navbar-brand text-white">XSS脆弱性体験ができる掲示板 - 本物登録フォーム - </div>
            </div>
            <a href="/" class="btn btn-light position-absolute" style="right: 16px;">戻る</a>
        </div>
        </nav>
    </header>
    <div class="body-wrapper w-50 mx-auto mt-5">
        <h1 class="mb-3">会員登録フォーム</h1>
        <form class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="familyName">姓</label>
              <input type="text" class="form-control" id="familyName" placeholder="" value="" required>
              <div class="invalid-feedback">
                名字を入力してください
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="givenName">名</label>
              <input type="text" class="form-control" id="givenName" placeholder="" value="" required>
              <div class="invalid-feedback">
                名前を入力してください
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="username">ユーザー名</label>
            <div class="input-group has-validation w-25">
              <div class="input-group-prepend">
                <span class="input-group-text">@</span>
              </div>
              <input type="text" class="form-control" id="username" placeholder="ユーザー名" required>
              <div class="invalid-feedback" style="width: 100%;">
                ユーザー名が必要です
              </div>
            </div>
          </div>

          <hr class="mb-4">

          <h4 class="mb-3">お支払い方法</h4>

          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
              <label class="custom-control-label" for="credit">クレジットカード</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
              <label class="custom-control-label" for="debit">デビットカード</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
              <label class="custom-control-label" for="paypal">PayPal</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="cc-name">カードの名義</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-muted">カード上に表示されているフルネーム</small>
              <div class="invalid-feedback">
                カードの名義を入力してください
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cc-number">クレジットカード番号</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                クレジットカード番号を入力してください
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">有効期限</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                有効期限を入力してください
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="cc-cvv">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                セキュリティコードを入力してください
              </div>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">登録する</button>
        </form>
    </div>
</body>
</html>
