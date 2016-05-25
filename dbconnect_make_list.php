<!-- ページ左端（セルの12分割された分の4つ分）に問題のリストを表示 -->
<!-- 問題メインテーブルの呼び出し（deleteフラグの立っていないものを取得） -->

<?php
//問題メインテーブルの呼び出し（deleteフラグの立っていないものを取得）
	 if(isset($_POST['subject_search'])){
    $sql_list = 'SELECT*FROM `main` WHERE `delete_flag`=0  AND `subject_id`='.$_POST['subject_search'].' AND `id_teach`='.$_SESSION['id'].'ORDER BY `time_made` DESC';
  }
  else if(isset($_POST['subject_search'])&&$_POST['subject_search']==0){
    $sql_list = 'SELECT*FROM `main` WHERE `delete_flag`=0  AND `id_teach`='.$_SESSION['id'].' ORDER BY `time_made` DESC';
  }
  else{
    $sql_list = 'SELECT*FROM `main` WHERE `delete_flag`=0  AND `id_teach`='.$_SESSION['id'].' ORDER BY `time_made` DESC';
  }



    //SQL文の実行
    $stmt=$dbh->prepare($sql_list);
    $stmt->execute();

    //格納する変数の初期化
  $questions = array();

  while(1){
    //実行結果として得られたデータを取得
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false){
      break;
    }
    // 取得したデータを配列に格納しておく
    $questions[] = $rec;
  }

  ?>