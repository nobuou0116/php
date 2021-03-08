<?php

function validation($request) {
  $errors = [];

  if(empty($request['name'])) {
    $errors[] = '氏名は必須です';
  }
  if(!checked($request['gender'])) {
    $errors[] = '性別を選択して下さい';
  }
  if(!checked($request['team'])) {
    $errors[] = 'チームを選択してください';
  }

  return $errors;
}





?>