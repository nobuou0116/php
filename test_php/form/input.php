<?php

session_start();

require 'validation.php';

header('X-FRAME-OPTION:DENY');

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

$pageFlag = 0;
$errors = validation($_POST);

if (!empty($_POST['btn_confirm']) && empty($errors)) {
  $pageFlag = 1;
}
if (!empty($_POST['btn_submit'])) {
  $pageFlag = 2;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>test_php</title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>

</head>

<body style="padding:100px">

<div class="container">
<div class="row">
<div class="col-sm-8">

<?php if($pageFlag === 0): ?>
  <?php 
  if (!isset($_SESSION['csrfToken'])) {
    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrfToken'] = $csrfToken;
  }
  $token = $_SESSION['csrfToken'];
  ?>
  <?php if(!empty($errors) && !empty($_POST['btn_confirm'])): ?>
    <?php echo '<ul>'; ?>
      <?php foreach ($errors as $error): ?>
        <?php echo '<li>'.$error.'</li>' ?>
      <?php endforeach; ?>
    <?php echo '</ul>'; ?>
  <?php endif; ?>
  
  <form method="POST" action="input.php">

    <div class="form-group">
    <label for="your_name">氏名</label>
    <br>
    <input type="text" class="form-control" name="your_name" value="<?php if(!empty($_POST['your_name'])) echo $_POST['your_name']; ?>">
    </div>

    <br>

    <div class="form-group">
    <label for="email">メールアドレス</label>
    <br>
    <input type="email" class="form-control"  name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>">
    </div>

    <br>

    <input type="submit" class="btn btn-outline-primary" name="btn_confirm" value="確認する">
    <input type="hidden" name="csrf" value="<?php echo $token; ?>">
  </form>
<?php endif; ?>


<?php if($pageFlag === 1): ?>
  <?php if($_POST['csrf'] === $_SESSION['csrfToken']): ?>

  <form method="POST" action="input.php">
    
    <p style="font-size:20px">氏名：<?php echo $_POST['your_name']; ?></p>
    <p style="font-size:20px">メールアドレス：<?php echo $_POST['email']; ?></p>
    <br>
    <input type="submit" class="btn btn-outline-primary" name="back" value="戻る">
    <input type="submit" class="btn btn-outline-primary" name="btn_submit" value="送信する">
    <input type="hidden" name="your_name" value="<?php echo $_POST['your_name']; ?>">
    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
    <input type="hidden" name="csrf" value="<?php echo h($_POST['csrf']); ?>">
  </form>

  <?php endif; ?>
<?php endif; ?>


<?php if($pageFlag === 2): ?>
  <?php if($_POST['csrf'] === $_SESSION['csrfToken']): ?>
  送信が完了しました！
  <?php unset($_SESSION['csrfToken']); ?>
  <?php echo "<pre>"; var_dump($_POST); echo"</pre>"; ?>
<?php endif; ?>
<?php endif; ?>

</div>
</div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>