<?php

//削除ボタンが押されたとき
  if (isset($_GET['action'])&&($_GET['action']=='delete')){
    $deletesql = 'UPDATE `main` SET `delete_flag` = 1 WHERE `id_que`='.$_GET['id_del'];

    //SQL文の実行
    $stmt=$dbh->prepare($deletesql);
    $stmt->execute();

  }

 ?>