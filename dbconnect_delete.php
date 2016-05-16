<?php

//削除ボタンが押されたときに削除処理を実行（論理削除・メインDBにのみデリートフラグを立てる）
//GET送信で問題パラメータと'action'に'delete'パラメータが送られたときUPDATE処理を実行
  if (isset($_GET['action'])&&($_GET['action']=='delete')){
    $deletesql = 'UPDATE `main` SET `delete_flag` = 1 WHERE `id_que`='.$_GET['id_del'];

    //SQL文の実行
    $stmt=$dbh->prepare($deletesql);
    $stmt->execute();

  }

 ?>