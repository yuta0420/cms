<?php

//公開フラグが押されたとき
  if (isset($_POST['open_flag'])&&($_POST['open_flag']==1)){
    $sql = sprintf('UPDATE `main` SET `open_flag` = 1 WHERE `id_que`=%d',$_POST['id_que_edit']);

    //SQL文の実行
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
  }

 ?>