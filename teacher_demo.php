<?php

	require('dbconnect.php');

	//問題タイトルの取得
	$sql = 'SELECT*FROM `main` WHERE`open_flag`=1';

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
    

    $q = array();
    if(isset($_GET['id_que']) && !empty($_GET['id_que'])){
		    //対象IDのデータ取得
        $sql = 'SELECT*FROM `main` WHERE `id_que`='.$_GET['id_que'];

        //SQL文の実行
        $stmt=$dbh->prepare($sql);
        $stmt->execute();

        
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        $q[] = $rec;


        //対象IDの問題と答えの取得
		    $sql = 'SELECT*FROM `question` WHERE `id_que`='.$_GET['id_que'];

			//SQL文の実行
		    $stmt=$dbh->prepare($sql);
		    $stmt->execute();

		    //格納する変数の初期化
			$qas = array();

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
		$string='先生用デモ画面';
		echo'<title>';
		echo$string;
		echo'</title>';
	?>

  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/form.css">
  <link rel="stylesheet" href="assets/css/timeline.css">
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

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
              <a class="navbar-brand" href="teacher_main.php"><span class="strong-title"><i class="fa fa-pencil-square"></i> Question bbs</span></a>
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



 

  <div class="container">
    <div class="row">
      <div class="col-md-4 content-margin-top">

      		<!-- ここに4列分のコンテナの記述が可能 -->
       
        <div class="timeline-centered">

       <?php
              	//リストから取得した$questionから$question_eachに1列ずつデータを格納（全要素）
              	foreach ($questions as $question_each) {
              	?>

                <article class="timeline-entry">

                    <div class="timeline-entry-inner">

                        <div class="timeline-icon bg-success">
                            <i class="entypo-feather"></i>
                            <i class="fa fa-cogs"></i>
                        </div>

                        <div class="timeline-label">

                            
                        	<?php

                          //問題タイトルの出力
                        	echo '<h2><a href="student_main.php?id_que='.$question_each['id_que'].'">'.$question_each['title_que'].'</a></h2>';
                          
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

      <div class="col-md-8 content-margin-top">

      	<div class="timeline-centered">

        <article class="timeline-entry">

            <div class="timeline-entry-inner">

                <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                    <i class="fa fa-cogs"></i>
                </div>

                <div class="timeline-label">

                <!-- このDivに8列分のコンテナとして記述 -->

                <!-- 回答・答え合わせページの呼び出し -->
                <?php
                	require("student_qa.php");
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



