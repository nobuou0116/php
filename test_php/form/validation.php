<?php

function validation($request) {
  $errors = [];

  if (empty($request['your_name']) || mb_strlen($request['your_name']) > 10) {
    $errors[] = '名前は必須です。10文字以内で入力してください';
  }

  if (empty($request['email'] || filter_var($request['email'], FILTER_VALIDATION_EMAIL))) {
    $errors[] = 'メールアドレスは必須です。正しい形式で入力してください';
   }
  return $errors;
}

?>