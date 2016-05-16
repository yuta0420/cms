<!-- 選択問題の新規作成処理 -->
<!-- 作成時のタイトルがPOST送信されたら処理を実行 -->
<!-- ①送信された問題数の取得（実際は問題数ではなく、送信された問題番号のうち最も大きい番号を取得）-->
<!-- ②問題メインテーブルのINSERT処理 -->
<!-- ③問題メインテーブルから最も新しい問題ID(MAX関数)を取得（selectionテーブルのサブID用） -->
<!-- ④問題文と答えを'selection'テーブルにINSERT処理 -->

<!-- ①送信された問題数の取得 -->
 <?php for($i=0;$i<50;$i++){
    if(isset($_POST['question'.$i])||isset($_POST['answer'.$i])){
      $number_que_new = $i+1;
    }
  }
?>

 <?php
  //MySQLの問題メインファイルの更新
  if(isset($_POST['question_title_new']) && !empty($_POST['question_title_new'])){
    if($_POST['sel_type']=='1'){

        //②問題メインテーブルのINSERT処理
        $sql_sav_main = "INSERT INTO `main`(`title_que`, `title_que_sub`, `num_que`, `sel_type`,`time_made`) VALUES ('".$_POST['question_title_new']."','".$_POST['question_title_sub']."','".$number_que_new."',1 ,now())";

        //var_dump($_POST);
        //var_dump($sql_sav_main);

        //SQL文の実行
        $stmt=$dbh->prepare($sql_sav_main);
        $stmt->execute();

        //③問題メインテーブルから最も新しい問題ID(MAX関数)を取得（selectionテーブルのサブID用）
        $sql_id = 'SELECT MAX(`id_que`) AS MAXID FROM `main`';

        //SQL文の実行
        $stmt=$dbh->prepare($sql_id);
        $stmt->execute();

        $id_que = $stmt->fetch(PDO::FETCH_ASSOC);


        //④問題文と答えを'selection'テーブルにINSERT処理
        for ($i=0; $i < $number_que_new; $i++)
         {
          if(isset($_POST['question'.$i])){
           $sql = sprintf('INSERT INTO `selection`(`id_que`,`question`, `choose1`, `choose2`, `choose3`, `choose4`, `answer`,  `time_made`)VALUES (\'%d\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%d\',now())',$id_que['MAXID'],$_POST['question'.$i],$_POST['choose'.$i.'_1'],$_POST['choose'.$i.'_2'],$_POST['choose'.$i.'_3'],$_POST['choose'.$i.'_4'],$_POST['ans'.$i]);

          //var_dump($sql);

         //SQL文の実行
           $stmt=$dbh->prepare($sql);
           $stmt->execute();
         }
       }
    }
  }

  ?>