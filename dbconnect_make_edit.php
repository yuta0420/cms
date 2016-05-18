<!-- 文章問題の更新処理 -->
<!-- 編集時のIDがPOST送信されたら処理を実行 -->
<!-- ①更新された問題数の取得（実際は問題数ではなく、送信された問題番号のうち最も大きい番号を取得）-->
<!-- ②問題メインテーブルのUPDATE処理 -->
<!-- ③問題内容を問題`question`テーブルの更新 -->
<!--  ③-1 送信された問題をUPDATE処理で実行（更新されていない場合もUPDATE処理を実行） -->
<!--  ③-2 削除されて送信されていない場合は、DELETE処理を実行（物理削除、問題のIDは取得しているのでそのIDのレコードを削除）-->
<!-- ④更新前の問題数より問題数が多い場合は、INSERT処理で問題を追加 -->


<!--　！！【実装】DELETE処理が走ったときに問題数を-1してアップデートをする -->



<!-- ①更新された問題数の取得（実際は問題数ではなく、送信された問題番号のうち最も大きい番号を取得）-->
 <?php for($i=0;$i<50;$i++){//問題数の最大数50個までPOST送信されたデータがあるかを確認する
    if(isset($_POST['question'.$i])||isset($_POST['answer'.$i])){
      $number_que_edit = $i+1;//問題が存在したとき、問題数として最新の番号に更新（問題数のため+1）
    }
  }
  $number_true=$number_que_edit;//取得した問題数を格納
  echo '問題数：';
  echo $number_true;
?>

 <?php
   //データの更新処理（更新ボタンを押したとき）
    if(isset($_POST['id_que_edit']) && !empty($_POST['id_que_edit'])){
      if($_POST['sel_type']=="0"){//問題タイプの確認
      //②問題メインテーブルのUPDATE処理
      $sql='UPDATE `main` SET `title_que`="'.$_POST['question_title'].'",`title_que_sub`="'.$_POST['question_title_sub'].'",`num_que`='.$number_que_edit.',`time_edit`=now() WHERE `id_que`='.$_POST['id_que_edit'];

      var_dump($sql);

      $stmt =$dbh->prepare($sql);
      $stmt->execute();



      //③問題内容を問題`question`テーブルの更新
      for ($i=0; $i < $_POST['num_que_edit']; $i++)
       {
        if(isset($_POST['question'.$i])){
        //③-1 送信された問題をUPDATE処理で実行
        $sql = 'UPDATE `question` SET `question`="'.$_POST['question'.$i].'",`answer`="'.$_POST['answer'.$i].'",`time_edit`=now() WHERE `id_sub`='.$_POST['id_sub_edit'.$i];
      }else{
        if(isset($_POST['id_sub_edit'.$i])){
        //③-2 削除されて送信されていない場合は、DELETE処理を実行
        $sql='DELETE FROM `question` WHERE `id_sub`='.$_POST['id_sub_edit'.$i];
      }
        $number_true--;//問題が存在しない場合
      }

        var_dump($sql);
        
        //SQL文の実行
         $stmt=$dbh->prepare($sql);
         $stmt->execute();
       }

       //④更新前の問題数より問題数が多い場合は、INSERT処理で問題を追加
       if($_POST['num_que_edit']<$number_que_edit){
         for ($i=$_POST['num_que_edit']; $i <$number_que_edit ; $i++)
         //古い問題数から、新しい問題番号までループ処理を実行
         {
          if(isset($_POST['question'.$i])){
              //更新分のINSERT処理を実行
              $sql = sprintf('INSERT INTO `question`(`id_que`, `question`, `answer`,`time_made`) VALUES (\'%d\', \'%s\',\'%s\',now())',$_POST['id_que_edit'],$_POST['question'.$i],$_POST['answer'.$i]);

               var_dump($sql);

               //SQL文の実行
             $stmt=$dbh->prepare($sql);
             $stmt->execute();
           }
           else $number_true--;//問題が存在しない場合
         }
       }
       // 問題数を更新
      $sql=sprintf('UPDATE `main` SET `num_que`="%d" WHERE `id_que`=%d',$number_true,$_POST['id_que_edit']);
        echo '問題数：';
    echo $number_true;

      var_dump($sql);
      //SQL文の実行
           $stmt=$dbh->prepare($sql);
           $stmt->execute();
   }  
  }

?>
