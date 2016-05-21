<!-- 生徒用ページのメイン画面 -->
<!-- ①MYSQLへの接続DB呼び出し -->
<!-- ②画面左側に問題リストの呼び出し -->
<!-- ③選択された問題と回答欄を呼び出す（答えの出力含む） -->



<!-- ①MYSQLへの接続DB呼び出し -->
<?php

  //DBへの接続
	require('dbconnect.php');

  // セレクトボックス用のSQLを作成
    $sql='SELECT * FROM `subject`';

    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    //取得データの活用
    $subjects = array();

    //データを取得して格納
    while(1){
      $rec=$stmt->fetch(PDO::FETCH_ASSOC);
      if($rec==false){
        break;
      }
      $subjects[]=$rec;
    }

	//問題リスト呼び出し用に問題メインテーブルからレコード取得
	if(isset($_POST['subject_search'])){
    $sql = 'SELECT*FROM `main` WHERE `delete_flag`=0  AND `subject_id`='.$_POST['subject_search'].' ORDER BY `time_made` DESC';
  }
  else if(isset($_POST['subject_search'])&&$_POST['subject_search']==0){
    $sql = 'SELECT*FROM `main` WHERE `delete_flag`=0  ORDER BY `time_made` DESC';
  }
  else{
    $sql = 'SELECT*FROM `main` WHERE `delete_flag`=0  ORDER BY `time_made` DESC';
  }

	//SQL文の実行
    $stmt=$dbh->prepare($sql);
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
    

    //GET送信でIDを取得したとき、問題を呼び出せるようにメイン、'question'、'selection'にSQL文を送る

    //格納用変数の初期化
    $q = array();

    if(isset($_GET['id_que']) && !empty($_GET['id_que'])){//GET送信でIDが送られたとき
		    //対象IDのデータ取得
        $sql = 'SELECT*FROM `main` WHERE `id_que`='.$_GET['id_que'];

        //SQL文の実行
        $stmt=$dbh->prepare($sql);
        $stmt->execute();

        //取得したデータの格納
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $q[] = $rec;


        //取得したデータから問題タイプを判定して問題を出力
        if($q[0]['sel_type']==0){//文章問題

          //対象IDの問題と答えの取得(問題タイプごと)
  		    $sql = 'SELECT*FROM `question` WHERE `id_que`='.$_GET['id_que'];

  			   //SQL文の実行
  		    $stmt=$dbh->prepare($sql);
  		    $stmt->execute();
      }

      if($q[0]['sel_type']==1){
          //対象IDの問題と答えの取得(問題タイプごと)
          $sql = 'SELECT*FROM `selection` WHERE `id_que`='.$_GET['id_que'];

           //SQL文の実行
          $stmt=$dbh->prepare($sql);
          $stmt->execute();
      }



		    //格納する変数の初期化
			$qas = array();

      //データがfalseになるまで問題を取得
			while(1){
		    //データを取得
		    $rec=$stmt->fetch(PDO::FETCH_ASSOC);
		    if($rec == false){
		      break;
		    }
		    $qas[]=$rec;
		  }

	}
   

  	//データベースから切断
	$dbh = null;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <?php
		$string='生徒用ページ';
		echo'<title>';
		echo$string;
		echo'</title>';
	?>

  <!-- 問題回答時間取得用の関数 -->
  <?php require('time_get.php');?>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">

 

</head>
<body onLoad="disp()">

  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#page-top"><span class="strong-title"><i class="fa fa-pencil-square"></i> Question bbs</span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
<!--                   <li class="hidden">
                      <a href="#page-top"></a>
                  </li>
                  <li class="page-scroll">
                      <a href="#portfolio">Portfolio</a>
                  </li>
                  <li class="page-scroll">
                      <a href="#about">About</a>
                  </li>
                  <li class="page-scroll">
                      <a href="#contact">Contact</a>
                  </li> -->
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>



 <!-- ②画面左側に問題リストの呼び出し -->

  <div class="container">
    <div class="row">
      <div class="col-md-4 content-margin-top">

      		<!-- ここに4列分のコンテナの記述が可能 -->

        <!-- 科目検索用 -->
            <div class="form-group">
              <form method='post'>
                <select class="form-control" name="subject_search" style="width:150px">
                  <option value="0">全件検索</option>
                  <?php
                      foreach($subjects as $subject){
                    ?>

                    <option value="<?php echo $subject['subject_id'];?>"><?php echo $subject['subject_name'];?></option>

                  <?php  }  ?>
                  
                  </select>

                  <input type="submit" class="btn btn-default btn-xs" value="科目検索">
              </form>
            </div>
       
        <div class="timeline-centered box_srcollbar">

       <?php
              	//リストから取得した$questionから$question_eachに1列ずつデータを格納（全要素）
              	foreach ($questions as $question_each) {
              	?>

                <article class="timeline-entry">

                    <div class="timeline-entry-inner">

                        <div class="timeline-icon bg-success">
                            <i class="entypo-feather"></i>
                            <i class="fa fa-file-text-o"></i>
                        </div>

                        <div class="timeline-label">

                            
                        	<?php

                          $title_que=htmlspecialchars($question_each['title_que']);
                          //問題タイトルの出力
                        	echo '<h2><a href="student_main.php?id_que='.$question_each['id_que'].'">'.$title_que.'</a></h2>';
                          
                          // リストに最終更新日時を出力
                          if($question_each['time_edit']>$question_each['time_made'])echo '<h5>'.$question_each['time_edit'].'</h5>';
                          else echo '<h5>'.$question_each['time_made'].'</h5>';  
                         

                	
        			           ?>
        			
                </div>
            </div>

        </article>

        <?php
        }
    	?>

        <article class="timeline-entry begin">

            <div class="timeline-entry-inner">

                <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
                    <i class="entypo-flight"></i> +
                </div>

            </div>

        </article>

      </div> 
  
      </div>



      <!-- ③選択された問題と回答欄を呼び出す（答えの出力含む） -->

      <div class="col-md-8 content-margin-top">

      	<div class="timeline-centered">

        <article class="timeline-entry">

            <div class="timeline-entry-inner">

                <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                    <i class="fa fa-file-text-o"></i>
                </div>

                <div class="timeline-label">

                <!-- このDivに8列分のコンテナとして記述 -->

                <!-- 回答・答え合わせページの呼び出し -->
                <?php
                //文章問題の呼び出し
                  if(isset($_GET['id_que'])&&($q[0]['sel_type']=='0')){
                	 require("student_qa.php");
                  }
                  //選択問題の呼び出し
                  else if(isset($_GET['id_que'])&&$q[0]['sel_type']==1){
                   require("student_sel_qa.php");
                  }
                  //それ以外の場合は説明文を出力
                  else{
                    echo '<h2>左のリストから問題を選択してください<h2>';
                  }
                ?>
                

                	
                </div>
            </div>

        </article>




    </div>
  </div>





  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins)
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/form.js"></script>
</body>
</html>



