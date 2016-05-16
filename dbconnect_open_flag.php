<!-- 問題更新時に公開フラグが押されたときのUPDATE処理を実行 -->

<?php

//公開フラグが押されたとき
  if (isset($_POST['open_flag'])&&($_POST['open_flag']==1)){
  	//公開フラグが押されたときUPDATE処理を実行
    $sql = sprintf('UPDATE `main` SET `open_flag` = 1 WHERE `id_que`=%d',$_POST['id_que_edit']);

    //SQL文の実行
    $stmt=$dbh->prepare($sql);
    $stmt->execute();
  }

 ?>