<?php

  //DB呼び出し
  require('dbconnect.php');

  //公開フラグ更新の場合
  require('dbconnect_open_flag.php');  

  //文章問題の更新の場合
  require('dbconnect_make_edit.php');

  //文章問題の新規追加の場合
  require('dbconnect_make_new.php');

  //選択問題の新規追加の場合
  require('dbconnect_make_sel_new.php');

  //選択問題の更新の場合
  require('dbconnect_make_sel_edit.php');

  //問題リスト用に呼び出し
  require('dbconnect_make_list.php');

  //データベースから切断
	$dbh = null;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <?php
		$string='先生用ページ';
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



 

  <div class="container">
    <div class="row">
      <div class="col-md-4 content-margin-top">

              <!-- ここに4列分のコンテナの記述が可能 -->

              <!-- 生徒用デモ画面呼び出し -->

              <a href="teacher_demo.php">生徒用画面デモはこちら</a>
                  
              <!-- 問題数選択フォーム呼び出し -->
              <?php
                  require('number_make_new.php');
              ?>   

              <!-- アイコン付き（問題リスト） -->
               <div class="timeline-centered">       

               <?php
              	//リストから取得した$questionから$question_eachに1列ずつデータを格納（全要素）
              	foreach ($questions as $question_each) {
              	?>

                <article class="timeline-entry">

                    <div class="timeline-entry-inner">

                        <div class="timeline-icon bg-success">
                            <i class="entypo-feather"></i>
                            <a href="teacher_main.php?id_que=<?php echo $question_each['id_que'];?>&sel=<?php echo $question_each['sel_type'];?>"><i class="fa fa-cogs"></i></a>
                        </div>

                        <div class="timeline-label">                                            	
                        <!-- リストに問題タイトルを出力 -->
                        	<a href="teacher_main.php?id_que=<?php echo $question_each['id_que'];?>&sel=<?php echo $question_each['sel_type'];?>"><?php echo $question_each['title_que']; ?></a>
                        <!-- リストに最終更新日時を出力 -->
                          <?php 
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
                
                <!-- 問題作成用フォーム呼び出し -->

                <?php
                                 
                if(isset($_POST["number_que"]) && !empty($_POST["number_que"])){
                  if($_POST["sel"]=="0"){ 
                      require('teacher_make_new.php');
                    }
                  }
                ?>

                <?php
                                  
                if(isset($_POST["number_que"]) && !empty($_POST["number_que"])){
                  if($_POST["sel"]=="1"){
                      require('teacher_make_sel_new.php');
                    }
                  }
                ?>


                <?php
                  if(isset($_GET["id_que"]) && !empty($_GET["id_que"])){
                    if($_GET["sel"]=="0"){
                      require('teacher_make_edit.php');
                    }
                  }
                ?>

                <?php
                  if(isset($_GET["id_que"]) && !empty($_GET["id_que"])){
                       if($_GET["sel"]=="1"){
                        require('teacher_make_sel_edit.php');
                       }
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

