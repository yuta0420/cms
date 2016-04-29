<?php

  //ステップ1.db接続
  $dsn='mysql:dbname=cms;host=localhost:8080';/*本来はIPアドレスを指定*/

  //接続するためのユーザー情報
  $user='root';
  $password='sp4p09y6';

  //DB接続オブジェクトを作成
  $dbh=new PDO($dsn,$user,$password);

  //接続したDBオブジェクトで文字コードutf8を使うように指定
  $dbh->query('SET NAMES utf8');


  //公開フラグが押されたとき
  // if (isset($_GET['open_flag'])&&($_GET['open_flag']=='open')){
  //   $deletesql = sprintf('UPDATE `main` SET `open_flag` = 1 WHERE `id_que`=%d',$_GET['id_que']);

    //SQL文の実行
    // $stmt=$dbh->prepare($deletesql);
    // $stmt->execute();
  // }

  //新規追加の場合
  //MySQLの問題メインファイルの更新
  if((isset($_POST['question_title']) && !empty($_POST['question_title']))){

    $sql_sav_main = "INSERT INTO `main`(`title_que`, `title_que_sub`, `num_que`, `time_made`) VALUES ('".$_POST['question_title']."','".$_POST['question_title_sub']."','".$_POST['number_que']."',now())";

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
    for ($i=0; $i < $_POST['number_que']; $i++)
     {
       $sql = sprintf('INSERT INTO `question`(`id_que`, `question`, `answer`,`time_made`) VALUES (\'%d\', \'%s\',\'%s\',now())',$id_que['MAXID'],$_POST['question'.$i],$_POST['answer'.$i]);

     //SQL文の実行
       $stmt=$dbh->prepare($sql);
       $stmt->execute();
     }

   }

  }


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
                            <a href="teacher_main.php?id_que=<?php echo $question_each['id_que'];?>"><i class="fa fa-cogs"></i></a>
                        </div>

                        <div class="timeline-label">

                          <!-- 公開フラグ -->
                           <!-- <form method="get">
                            <p><input type="checkbox" name="open_flag" value="open">公開ボタン</p>
                           <p><input type="submit" value="公開の更新" ></p> -->
                          <?php //echo '<input name="number_que" type="hidden" value="'.$question_each['id_que'].'">'; ?>
                           <!-- </form> -->
                        	

                        	<a href="teacher_main.php?id_que=<?php echo $question_each['id_que'];?>"><?php echo $question_each['title_que']; ?></a>
                          <?php echo '<h5>'.$question_each['time_made'].'</h5>';  ?>   			
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

                    require('teacher_make_new.php');

                  }
                ?>

                <?php
                  if(isset($_GET["id_que"]) && !empty($_GET["id_que"])){

                    require('teacher_make_edit.php');

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




















