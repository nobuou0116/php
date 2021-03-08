<?php

session_start();

// サニタイズ
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

if (isset($_POST['csrf']) && $_POST['csrf'] === $_SESSION['csrfToken'] ) {
  echo '正常';
} else {
  echo '不正なリクエスト';
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>content</title>
</head>

<body>
<div class="container mt-4">
<div class="row">
<div class="col-lg-8">
<div class="p-3 mb-2 bg-light text-black">

<form method="POST" action="complete.php">

お名前：<?php echo h($_POST['name']); ?><br>
性別：<?php echo h($_POST['gender']); ?><br>
好きなチーム：<?php echo h($_POST['team']); ?><br>
ひとこと：<?php echo h($_POST['comment']); ?>

<br>
<br>
<buttom class="btn btn-primary" type="submit" onclick="history.back()" name="btn_back">戻る</buttom>
<input class="btn btn-primary" type="submit" name="btn_submit" value="送信する">
<input type="hidden" name="name" value="<?php echo h($_POST['name']) ?>">
<input type="hidden" name="gender" value="<?php echo h($_POST['gender']) ?>">
<input type="hidden" name="team" value="<?php echo h($_POST['team']) ?>">
<input type="hidden" name="comment" value="<?php echo h($_POST['comment']) ?>">
<input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']) ?>">
  
</form>

</div>
</div>
</div>
</div>
</body>
</html>