<?php

  // //DB接続関数の呼び出し
  // require('dbconnect.php');

  // //セッションを使うページに必ず入れる
  // session_start();

  // //セッションにidが存在し、かつセッションのtimeと3600秒足した値が
  // //現在時刻より小さいときにログインをしていると判断する
  // if(isset($_SESSION['id'])&&$_SESSION['time']+3600>time()){
  //   //セッションに保存している期間更新
  //   $_SESSION['time']=time();

  //   //ログインしているユーザーのデータをDBから取得
  //   $sql=sprintf('SELECT * FROM `teachers` WHERE `teacher_id`=%d',
  //     $_SESSION['id']
  //     );

  //   $stmt=$dbh->prepare($sql);
  //   $stmt->execute();

  //   $record=$stmt->fetch(PDO::FETCH_ASSOC);
  //   $teacher=$record;

  //   // header('Location: teacher_main.php');


  // }

  // データベースから切断
  // $dbh = null;
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Question BBS</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/styles.css" rel="stylesheet">

    <!-- CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/css/form.css">
  <link rel="stylesheet" href="../assets/css/timeline.css">
  <link rel="stylesheet" href="../assets/css/main.css">


  </head>
  <body>
<div class="navbar-wrapper">
  <div class="container">
    <div class="navbar navbar-default navbar-fixed-top">
      
       <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><span class="strong-title"><i class="fa fa-pencil-square"></i> Question bbs</span></a>
          </div>

          

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                  <li>
                      <a class="btn btn-default btn-block btn-xs" href="../student_main.php" role="button">問題に答える(会員登録不要)</a>
                  </li>
                  <li>
                      <a class="btn btn-default btn-block btn-xs" href="../login.php" role="button">ログイン</a>
                      
                  </li>
                  <li class="page-scroll">
                      <a class="btn btn-default btn-block btn-xs" href="../join/index.php">新規登録はこちら</a>
                  </li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      

    </div>
  </div><!-- /container -->
</div><!-- /navbar wrapper -->


 <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="images/top.jpg" style="width:100%" class="img-responsive">
          <div class="container">
            <div class="carousel-caption">
              <h1>ようこそ！Question BBSへ</h1>
              <p></p>
              <p><a class="btn btn-lg btn-primary" href="http://getbootstrap.com">Learn More</a>
            </p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="images/top.jpg" class="img-responsive">
          <div class="container">
            <div class="carousel-caption">
              <h1>簡単に問題を配信することができる</h1>
              <p>問題作成は問題と答えを入力するだけです。<br>「アプリで問題を配信するのはむずかしそう・・・」という方もQuestion BBSなら簡単です！</p>
              <p><a class="btn btn-large btn-primary" href="../join/index.php">会員登録して問題を作る</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="images/globe.png" class="img-responsive">
          <div class="container">
            <div class="carousel-caption">
              <h1>会員登録なしで問題がとける</h1>
              <p>ユーザーが作成した問題は会員登録なしで問題をとくことができます</p>
              <p><a class="btn btn-large btn-primary" href="../student_main.php">問題を解いてみる</a></p>
            </div>
          </div>
        </div>
      </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
      </a>  
    </div>
    <!-- /.carousel -->



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-md-4 text-center">
          <img class="img-circle" src="images/security.png">
          <h2>STEP1. 会員登録</h2>
          <p>まずは問題を作成する前に、<br>会員登録を行います。<br></p>
          <p><a class="btn btn-default" href="../join/index.php">新規登録はこちら »</a></p>
        </div>
        <div class="col-md-4 text-center">
          <img class="img-circle" src="images/computer.png">
          <h2>STEP2. 問題作成</h2>
          <p>登録が完了したら、<br>専用ページの「新規作成」ボタンを押して作成を始めます。</p>
          <p><a class="btn btn-default" href="../login.php">ログインする »</a></p>
        </div>
        <div class="col-md-4 text-center">
          <img class="img-circle" src="images/globe.png">
          <h2>STEP3. 問題公開</h2>
          <p>作成リストから公開したい問題を選んで、<br>「公開チェック」を押して保存して、問題を公開します。</p>
          <p><a class="btn btn-default" href="../login.php">ログインする »</a></p>
        </div>
      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image img-circle pull-right" src="http://placehold.it/512">
        <h2 class="featurette-heading">友達同士で</h2>
        <p class="lead">会員登録をすれば誰でも問題を作ることができるので、自宅で勉強しながら友達同士で問題を出し合うことができます。</p>
      </div>

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image img-circle pull-left" src="http://placehold.it/512">
        <h2 class="featurette-heading">先生と生徒で</h2>
        <p class="lead">「自分で問題を配信したいけど、時間がない・・・」そんな忙しい学校や塾の先生も簡単に問題を配信できます。<br>今まで小テストで出していた問題も宿題として配信できます。</p>
      </div>

      <hr class="featurette-divider">

      <div class="featurette">
        <img class="featurette-image img-circle pull-right" src="http://placehold.it/512">
        <h2 class="featurette-heading">仕事・アルバイトのアピールとして</h2>
        <p class="lead">問題を解くときに作成した人のプロフィールを見ることができます。生徒を募集する際のアピールとして、自作問題を公開できます。Facebookやブログのリンクを掲載できるので、各SNSを通じて家庭教師の募集をすることもできます。</p>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


  <!-- FOOTER -->
  <footer>
    <p class="pull-right"><a href="#">Back to top</a></p>
    <p>This Bootstrap layout is compliments of Bootply. · <a href="http://www.bootply.com/62603">Edit on Bootply.com</a></p>
  </footer>

</div><!-- /.container -->
  <!-- script references -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>