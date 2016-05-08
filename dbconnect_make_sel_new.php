 <?php
  //MySQLの問題メインファイルの更新
  if(isset($_POST['question_title_new']) && !empty($_POST['question_title_new'])){
    if($_POST['sel_type']=='1'){

        $sql_sav_main = "INSERT INTO `main`(`title_que`, `title_que_sub`, `num_que`, ``sel_type`,`time_made`) VALUES ('".$_POST['question_title_new']."','".$_POST['question_title_sub']."','".$_POST['number_que_new']."',1 ,now())";

        //SQL文の実行
        $stmt=$dbh->prepare($sql_sav_main);
        $stmt->execute();

        //MySQL問題メインのID取得（問題内容questionのDBのサブID用）
        $sql_id = 'SELECT MAX(`id_que`) AS MAXID FROM `main`';

        //SQL文の実行
        $stmt=$dbh->prepare($sql_id);
        $stmt->execute();

        $id_que = $rec=$stmt->fetch(PDO::FETCH_ASSOC);

        if(isset($_POST['question1']) && !empty($_POST['question1'])){
        for ($i=0; $i < $_POST['number_que_new']; $i++)
         {
           $sql = sprintf('INSERT INTO `selection`(`id_que`,`question`, `choose1`, `choose2`, `choose3`, `choose4`, `answer`,  `time_made`)VALUES (\'%d\',\'%s\',\'%s\',\'%s\',\'%s\',\'%s\',\'%d\',now())',$id_que['MAXID'],$_POST['question'.$i],$_POST['choose'.$i.'_1'],$_POST['choose'.$i.'_2'],$_POST['choose'.$i.'_3'],$_POST['choose'.$i.'_4'],$_POST['ans'.$i]);

         //SQL文の実行
           $stmt=$dbh->prepare($sql);
           $stmt->execute();
         }

       }

    }
  }

  ?>