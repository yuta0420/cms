 <?php
  //MySQLの問題メインファイルの更新
  if(isset($_POST['question_title_new']) && !empty($_POST['question_title_new'])){
    if($_POST['sel_type']=='selection'){

        $sql_sav_main = "INSERT INTO `main`(`title_que`, `title_que_sub`, `num_que`, `time_made`) VALUES ('".$_POST['question_title_new']."','".$_POST['question_title_sub']."','".$_POST['number_que_new']."',now())";

        //SQL文の実行
        $stmt=$dbh->prepare($sql_sav_main);
        $stmt->execute();

        //MySQL問題メインのID取得（問題内容questionのDBのサブID用）
        $sql_id = 'SELECT MAX(`id_que`) AS MAXID FROM `main`';

        //SQL文の実行
        $stmt=$dbh->prepare($sql_id);
        $stmt->execute();

        $id_que = $rec=$stmt->fetch(PDO::FETCH_ASSOC);

        if(isset($_POST['question1_1']) && !empty($_POST['question1_1'])){
        for ($i=0; $i < $_POST['number_que_new']; $i++)
         {
           $sql = sprintf('INSERT INTO `selection`(`id_que`, `id_sub`, `question`, `choose1`, `choose2`, `choose3`, `choose4`, `answer`,  `time_made`)VALUES (\'%d\', \'%s\',\'%s\',now())',$id_que['MAXID'],$_POST['question'.$i],$_POST['answer'.$i]);

           INSERT INTO `selection`(`id_sub`, `question`, `choose1`, `choose2`, `choose3`, `choose4`, `answer`,  `time_made`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])

           $id_que['MAXID']
           $_POST['choose'.$i.'_1']
           $_POST['choose'.$i.'_2']
           $_POST['choose'.$i.'_3']
           $_POST['choose'.$i.'_4']
           $_POST['ans'.$i]


         //SQL文の実行
           $stmt=$dbh->prepare($sql);
           $stmt->execute();
         }

       }

    }
  }

  ?>