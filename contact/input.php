<?php

require_once('validation.php');

session_start();

if(!isset($_SESSION['csrfToken'])) {
  $csrfToken = bin2hex(random_bytes(32));
  $_SESSION['csrfToken'] = $csrfToken;
}

$token = $_SESSION['csrfToken'];

// サニタイズ
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

header('X-FRAME-OPTIONS:DENY');


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>contact</title>
</head>
<body>

<div class="container mt-4">
<div class="row">
<div class="col-lg-8">

<div class="p-3 mb-2 bg-light text-black">

<h1 class="mt-3 my-5">NBAインタビュー</h1>

<form method="POST" action="confirm.php">

<div class="form-group">
<span class="border-start border-primary border-3">
<label class="mx-2" for="name">氏名</label>
<br>
<input class="form-control my-2" id="name" type="text" name="name" value="<?php echo h($_POST['name']) ?>" required minlength="5">
<br>

<span class="border-start border-primary border-3">
<label class="gender mx-2">性別</label>
<br>

<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="gender" id="inlineradio" value="男性" required>男性
</div>

<div class="form-check form-check-inline my-2">
<input class="form-check-input" type="radio" name="gender" id="inlineradio" value="女性" required>女性
</div>
<br><br>

<span class="border-start border-primary border-3">
<label for="team" class="mx-2">好きなチーム</label>
<br>
<div class="form-check form-check-inline my-2">
<input class="form-check-input" type="radio" name="team" value="レイカーズ" required>レイカーズ
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="team" value="ニックス" required>ニックス
</div>

<div class="form-check form-check-inline">
<input class="form-check-input" type="radio" name="team" value="セルティックス" required>セルティックス
</div>
<br><br>

<span class="border-start border-primary border-3">
<label for="momment" class="mx-2">ひとこと</label>
<br>
<textarea class="form-control my-2" type="text" name="comment" value="<?php echo h($_POST['comment']) ?>"></textarea>
<br>

<button type="submit" class="btn btn-primary" name="btn_submit">確認する</button>
<input type="hidden" name="csrf" value="<?php echo h($token) ?>">


</div>
</div>
</div>
</div>
</div>

</form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>