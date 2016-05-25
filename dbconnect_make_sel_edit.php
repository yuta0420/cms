<!-- 選択問題の更新処理 -->
<!-- 編集時のIDがPOST送信されたら処理を実行 -->
<!-- ①更新された問題数の取得（実際は問題数ではなく、送信された問題番号のうち最も大きい番号を取得）-->
<!-- ②問題メインテーブルのUPDATE処理 -->
<!-- ③問題内容を問題`selection`テーブルの更新 -->
<!--  ③-1 送信された問題をUPDATE処理で実行（更新されていない場合もUPDATE処理を実行） -->
<!--  ③-2 削除されて送信されていない場合は、DELETE処理を実行（物理削除、問題のIDは取得しているのでそのIDのレコードを削除）-->
<!-- ④更新前の問題数より問題数が多い場合は、INSERT処理で問題を追加 -->


 <?php

  // echo '<br /><br /><br />';
  // var_dump($_POST);


   //データの更新処理（更新ボタンを押したとき）
    if(isset($_POST['id_que_edit']) && !empty($_POST['id_que_edit'])){
      if($_POST['sel_type']=="1"){//問題タイプの確認

        //①更新された問題数の取得
        for($i=0;$i<50;$i++){//問題数の最大数50個までPOST送信されたデータがあるかを確認する
            if(isset($_POST['question'.$i])||isset($_POST['ans'.$i])){
              $number_que_edit = $i+1;//問題が存在したとき、問題数として最新の番号に更新（問題数のため+1）
            }
          }
          $number_true=$number_que_edit;//取得した問題数を格納

          // echo '更新前の問題数：'.$_POST['num_que_edit'];
          // echo '問題数：'.$number_que_edit;

      //②問題メインテーブルのUPDATE処理 
      $sql='UPDATE `main` SET `title_que`="'.$_POST['question_title'].'",`title_que_sub`="'.$_POST['question_title_sub'].'",`num_que`='.$number_que_edit.', `subject_id`="'.$_POST['subject_id'].'", `time_edit`=now() WHERE `id_que`='.$_POST['id_que_edit'];

      // var_dump($_POST);

      //SQL文のj拮抗
      $stmt =$dbh->prepare($sql);
      $stmt->execute();

      //③問題内容を問題`selection`テーブルの更新
       for ($i=0; $i < $_POST['num_que_edit']; $i++)
       {
        if(isset($_POST['question'.$i])){
        //③-1 送信された問題をUPDATE処理で実行
        $sql = 'UPDATE `selection` SET `question`="'.$_POST['question'.$i].'",`choose1`="'.$_POST['choose'.$i.'_1'].'",`choose2`="'.$_POST['choose'.$i.'_2'].'",`choose3`="'.$_POST['choose'.$i.'_3'].'",`choose4`="'.$_POST['choose'.$i.'_4'].'",`answer`="'.$_POST['ans'.$i].'",`time_edit`=now() WHERE `id_sub`='.$_POST['id_sub_edit'.$i];
      }else {
      if(isset($_POST['id_sub_edit'.$i])){
        //③-2 削除されて送信されていない場合は、DELETE処理を実行
        $sql='DELETE FROM `selection` WHERE `id_sub`='.$_POST['id_sub_edit'.$i];
      }
        $number_true--;//問題が存在しない場合
      }

        // echo '<br /><br /><br />';
        // echo $sql;
        
        //SQL文の実行
         $stmt=$dbh->prepare($sql);
         $stmt->execute();
       }

       //④更新前の問題数より問題数が多い場合は、INSERT処理で問題を追加
       if($number_que_edit>$_POST['num_que_edit']){
         for ($i=$_POST['num_que_edit']; $i <$number_que_edit ; $i++)
         ////古い問題数から、新しい問題番号までループ処理を実行
         {
          if(isset($_POST['question'.$i])){
               $sql = sprintf('INSERT INTO `selection`(`id_que`,`question`, `choose1`, `choose2`, `choose3`, `choose4`, `answer`,  `time_made`)VALUES (\'%d\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%d\',now())',$_POST['id_que_edit'],$_POST['question'.$i],$_POST['choose'.$i.'_1'],$_POST['choose'.$i.'_2'],$_POST['choose'.$i.'_3'],$_POST['choose'.$i.'_4'],$_POST['ans'.$i]);

               //var_dump($sql);

               //SQL文の実行
             $stmt=$dbh->prepare($sql);
             $stmt->execute();
           }
           else $number_true--;//問題が存在しない場合
         }
        }

        // echo '最終取得問題数：'.$number_true;
        // 問題数を更新
      $sql=sprintf('UPDATE `main` SET `num_que`="%d" WHERE `id_que`=%d',$number_true,$_POST['id_que_edit']);
    //     echo '問題数：';
    // echo $number_true;

    //   var_dump($sql);
      //SQL文の実行
           $stmt=$dbh->prepare($sql);
           $stmt->execute();
   }  
  }

?>
