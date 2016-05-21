<?php

  //DBへの接続
	require('dbconnect.php');

  if(isset($_POST['subject_name'])){
  	//問題リスト呼び出し用に問題メインテーブルからレコード取得
  	$sql = 'INSERT INTO `subject`(`subject_name`) VALUES ("'.htmlspecialchars($_POST['subject_name']).'")';

  	//SQL文の実行
      $stmt=$dbh->prepare($sql);
      $stmt->execute();
  }

  //header('Location:subject_add.php');

  	//データベースから切断
	$dbh = null;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <?php
		$string='科目新規追加';
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



 <!-- ②画面左側に問題リストの呼び出し -->

  <div class="container">
    <div class="row">



      <!-- ③選択された問題と回答欄を呼び出す（答えの出力含む） -->

      <div class="col-md-8 content-margin-top">

      	<div class="timeline-centered">

        <article class="timeline-entry">

            <div class="timeline-entry-inner">

            <form method="post">
              <input type="text" name="subject_name" style="width:150px" placeholder="例：算数">

              <input type="submit" value="登録する">
            </form>

            <p><a href="#" onClick="window.close();">画面を閉じる</a></p>
               
            </div>

        </article>


        </div>
      </div>

    </div>
  </div>





  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins)
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/form.js"></script>
</body>
</html>



