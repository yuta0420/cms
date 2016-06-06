<!-- 先生用（問題作成者用）のメインページ -->
<!-- ①DB接続とDB更新用のファイル呼び出し -->
<!-- 【未実装】②ログイン時のセッションとログイン判定 -->
<!-- ③自分が作った問題の生徒側画面のデモページを表示 -->
<!-- ④新規作成（初期問題数・タイプ選択）ボタンの作成 -->
<!-- ⑤ページの左側に問題リストを呼び出し -->
<!-- ⑥新規作成・問題編集（公開承認フラグ含む）の呼び出し -->





<?php

  //DB接続関数の呼び出し
  require('dbconnect.php');

  //セッションを使うページに必ず入れる
  session_start();

  //セッションにidが存在し、かつセッションのtimeと3600秒足した値が
  //現在時刻より小さいときにログインをしていると判断する
  if(isset($_SESSION['id'])&&$_SESSION['time']+3600>time()){
    //セッションに保存している期間更新
    $_SESSION['time']=time();

    //ログインしているユーザーのデータをDBから取得
    $sql=sprintf('SELECT * FROM `teachers` WHERE `teacher_id`=%d',
      $_SESSION['id']
      );

    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    $record=$stmt->fetch(PDO::FETCH_ASSOC);
    $teacher=$record;


  }else{
    //ログインしていない場合の処理
    header('Location: login.php');
    exit();
  }

  //①DB接続とDB更新用のファイル呼び出し


  //テーブルのレコードを削除する場合
  require('dbconnect_delete.php');

  //問題の各レコードの公開フラグ更新の場合
  require('dbconnect_open_flag.php');  

  //文章問題のレコードを更新する場合
  require('dbconnect_make_edit.php');

  //文章問題の新規作成時のレコード追加をする場合
  require('dbconnect_make_new.php');

  //選択問題の新規作成時のレコード追加をする場合
  require('dbconnect_make_sel_new.php');

  //選択問題のレコードを更新する場合
  require('dbconnect_make_sel_edit.php');

  //ページに問題リストを呼び出す場合
  require('dbconnect_make_list.php');

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

  

  //データベースから切断
	$dbh = null;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <?php
		$string='Question BBS';
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

  <!-- テーブル行数編集用関数（JAVA script） -->
  <?php require('function_table.php');?>

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
              <a class="navbar-brand" href="top/index.php"><span class="strong-title"><i class="fa fa-pencil-square"></i> Question bbs</span></a>
          </div>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li><?php echo $teacher['nick_name']?>さん専用ページ</li>
                <li><a href="logout.php" onclick="return confirm('ログアウトしますか？'); ">ログアウト</a></li>
                <li><a href="user_edit.php">会員情報変更</a></li>
              </ul>
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

             

              <!-- ③自分が作った問題の生徒側画面のデモページを表示 -->

              <a href="teacher_demo.php">生徒用画面デモはこちら</a><br /><br />
                  
              <!-- ④新規作成（初期問題数・タイプ選択）ボタンの作成 -->
              <?php
                  require('number_make_new.php');
              ?>


              <!-- 科目検索用 -->
              <form method='post'>
                <select class="form-control" name="subject_search" style="width:150px">
                  <option value="0">全件表示</option>
                  <?php
                      foreach($subjects as $subject){
                    ?>

                    <option value="<?php echo $subject['subject_id'];?>"><?php echo $subject['subject_name'];?></option>

                  <?php  }  ?>
                  
                  </select>

                  <input type="submit" class="btn btn-success btn-xs" value="科目検索">
              </form>

              <!-- アイコン付き（問題リスト） -->
               <div class="timeline-centered box_srcollbar">       

                <!-- ⑤ページの左側に問題リストを呼び出し -->
               <?php
              	//リストから取得した$questionから$question_eachに1列ずつデータを格納（全要素）
              	foreach ($questions as $question_each) {
              	?>

                <article class="timeline-entry">

                    <div class="timeline-entry-inner">

                        <div class="timeline-icon bg-success">
                            <i class="entypo-feather"></i>
                            <!-- アイコンの文字上にも編集画面用のパラメータを送信 -->
                            <a href="teacher_main.php?id_que=<?php echo $question_each['id_que'];?>&sel=<?php echo $question_each['sel_type'];?>"><i class="fa fa-edit"></i></a>
                        </div>
                          <!-- 問題リストの呼び出し -->
                          <?php require('teacher_make_list.php'); ?>	

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

      <div class="col-md-7 content-margin-top">

      	<div class="timeline-centered">

        <article class="timeline-entry">

            <div class="timeline-entry-inner">

                <div class="timeline-icon bg-success">
                    <i class="entypo-feather"></i>
                    <i class="fa fa-edit"></i>
                </div>

                <div class="timeline-label">

                <!-- このDivに8列分のコンテナとして記述 -->
                
                <!-- ⑥新規作成・問題編集（公開承認フラグ含む）の呼び出し -->

                <?php
                //問題数を設定して新規作成ボタンが押された場合に新規作成画面を呼び出す
                //"sel"が0のときは、文章問題、"1"のときには選択問題を呼び出す            
                if(isset($_POST["number_que"]) && !empty($_POST["number_que"])){
                  if($_POST["sel"]=="0"){ 
                      require('teacher_make_new.php');//文章問題
                    }
                 
                  if($_POST["sel"]=="1"){
                      require('teacher_make_sel_new.php');//選択問題
                    }
                  }
                ?>

                <!-- URLパラメータが送信されたとき、編集画面を呼び出す -->
                <?php
                if(isset($_GET["id_que"]) && !empty($_GET["id_que"])){
                    if($_GET["sel"]=="0"){
                      require('teacher_make_edit.php');//文章問題
                    }
                
                       if($_GET["sel"]=="1"){
                        require('teacher_make_sel_edit.php');//選択問題
                       }
                  }
                ?>

                <!-- 新規作成ボタン、URLパラメータが押されていないときは説明文を出力 -->
                <?php if(empty($_POST["number_que"])&&empty($_GET["id_que"])){
                  echo '左上の問題タイプ選択ボタンと問題数を選択して、「新規作成」ボタンを押すか<br />';
                  echo '左のリストから問題を選んで、再編集してくさい。<br />';
                  echo '※問題を公開する場合は、再編集画面で「公開承認チェック」を押してください。<br />';
                  echo '※問題が未完成でも再編集画面から再度編集できます。<br />';
                  }?>           
                	
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

