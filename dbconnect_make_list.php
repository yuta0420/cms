
<?php
//問題のリスト化用に呼び出し
	$sql_list = 'SELECT*FROM `main`';


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