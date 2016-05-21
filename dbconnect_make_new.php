<!-- 文章問題の新規作成処理 -->
<!-- 編集時のIDがPOST送信されたら処理を実行 -->
<!-- ①送信された問題数の取得（実際は問題数ではなく、送信された問題番号のうち最も大きい番号を取得）-->
<!-- ②問題メインテーブルのINSERT処理 -->
<!-- ③問題メインテーブルから最も新しい問題ID(MAX関数)を取得（questionテーブルのサブID用） -->
<!-- ④問題文と答えを'question'テーブルにINSERT処理 -->
 

 <?php
  //②問題メインテーブルのINSERT処理
  if(isset($_POST['question_title_new']) && !empty($_POST['question_title_new'])){
    if($_POST['sel_type']=='0'){

      //①送信された問題数の取得
      for($i=0;$i<50;$i++){
          if(isset($_POST['question'.$i])||isset($_POST['answer'.$i])){
            $number_que_new = $i+1;
          }
        }
        $number_true=$number_que_new;

        $sql_sav_main = "INSERT INTO `main`(`title_que`, `title_que_sub`, `num_que`, `sel_type`, `subject_id`,`time_made`) VALUES ('".$_POST['question_title_new']."','".$_POST['question_title_sub']."','".$number_que_new."', 0 , '".$_POST['subject_id']."',now())";

                
        //SQL文の実行
        $stmt=$dbh->prepare($sql_sav_main);
        $stmt->execute();

        //③問題メインテーブルから最も新しい問題ID(MAX関数)を取得（questionテーブルのサブID用）
        $sql_id = 'SELECT MAX(`id_que`) AS MAXID FROM `main`';

        //SQL文の実行
        $stmt=$dbh->prepare($sql_id);
        $stmt->execute();

        $id_que =$stmt->fetch(PDO::FETCH_ASSOC);

        //④問題文と答えを'question'テーブルにINSERT処理
        for ($i=0; $i < $number_que_new; $i++)
         {
          if(isset($_POST['question'.$i])){
                     $sql = sprintf('INSERT INTO `question`(`id_que`, `question`, `answer`,`time_made`) VALUES (\'%d\', \'%s\',\'%s\',now())',$id_que['MAXID'],$_POST['question'.$i],$_POST['answer'.$i]);

          // var_dump($sql);

         //SQL文の実行
           $stmt=$dbh->prepare($sql);
           $stmt->execute();
         }
         else $number_true--;//問題が存在しない場合
      }

      // echo '問題数：';
      // echo $number_true;

      // 問題数を更新
      $sql=sprintf('UPDATE `main` SET `num_que`="%d" WHERE `id_que`=%d',$number_true,$id_que['MAXID']);

      // var_dump($sql);
      //SQL文の実行
           $stmt=$dbh->prepare($sql);
           $stmt->execute();
    }
  }

  ?>