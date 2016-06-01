
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

    // header('Location: teacher_main.php');


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
              <a class="navbar-brand" href="index.php"><span class="strong-title"><i class="fa fa-pencil-square"></i> Question bbs</span></a>
          </div>

          

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                  <li>
                      <a class="btn btn-default btn-block btn-xs" href="student_main.php" role="button">問題に答える(会員登録不要)</a>
                  </li>
                  <li>
                      <a class="btn btn-default btn-block btn-xs" href="login.php" role="button">ログイン</a>
                      
                  </li>
                  <li class="page-scroll">
                      <a class="btn btn-default btn-block btn-xs" href="join/index.php">新規登録はこちら</a>
                  </li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

 

 

  <div id="hello">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2 centered">
            <h1>ようこそ！<br>Question BBSへ</h1>
            <h2>簡単に始めることができる問題配信システム</h2>
          </div><!-- /col-lg-8 -->
        </div><!-- /row -->
      </div> <!-- /container -->
  </div><!-- /hello -->
  
  <div id="green">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 centered relative">
          <img src="assets/img/iphone.png" alt="">
        </div>
        
        <div class="col-lg-7 lefted">
          <h3>
            会員登録をするだけで問題を作成することができます。<br>
            問題作成もキーボードで入力するだけですので、簡単です。<br>
          </h3>
          <p>
            ※会員登録なしでも問題を解くことができます。
          </p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="row centered mt grid">
      <span class="strong-title"><h3>使い方</h3></span>
      <div class="mt"></div>
      <div class="col-lg-4">
        <h4>STEP1. 会員登録</h4>
        <figure>
          <!-- <a href="about.html">  --><img src="assets/img/01_2.jpg" alt=""><!-- </a> --> 
        </fiure>
        <h4>まずは会員登録を行います。<br><a href="join/index.php">新規登録はこちら>></a></h4>
      </div>
      <div class="col-lg-4">
        <h4>STEP2. 問題作成</h4>
        <figure>
          <img src="assets/img/02_2.png" alt=""></a>
        </figure>
        <h4>登録が完了したら、専用ページの左上の「新規作成」ボタンを押して作成を開始します。</h4>
      </div>
      <div class="col-lg-4">
        <h4>STEP3. 問題公開</h4>
        <figure>
          <img src="assets/img/03_2.png" alt=""></a>
        </figure>
        <h4>新規作成で保存した問題を左の作成リストから公開したい問題を選んで、「公開チェック」を押して保存して、問題を公開します。</h4>
      </div>
    </div>
    
    <!-- <div class="row centered mt grid">
      <div class="mt"></div>    
      <div class="col-lg-4">
        <figure>
          <a href="benesse.html"><img src="assets/img/04_2.png" alt=""></a>
          <figcaption>
            <a href="benesse.html"><img src="assets/img/gray4.png" alt=""></a>
          </figcaption>
        </figure>
      </div>
      <div class="col-lg-4">
        <figure>
          <a href="hobby.html"><img src="assets/img/05_2.png" alt=""></a>
          <figcaption>
            <a href="hobby.html"><img src="assets/img/gray5.png" alt=""></a>
          </figcaption>
        </figure>
      </div>
      <div class="col-lg-4">
        <figure>
          <a href="fukuoka.html"><img src="assets/img/06_2.png" alt=""></a>
          <figcaption>
            <a href="fukuoka.html"><img src="assets/img/gray6.png" alt=""></a>
          </figcaption>
        </figure>
      </div>
    </div> -->
    
    <!-- <div class="row mt centered">
      <div class="col-lg-7 col-lg-offset-1 mt">
          <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.</p>
      </div>
      
      <div class="col-lg-3 mt">
        <p><button type="button" class="btn btn-theme btn-lg">Email Me!</button></p>
      </div>
    </div> -->
  </div>


  <div id="skills">
    <div class="container">
      <span class="strong-title"><h3>活用例</h3></span>
      <div class="row centered">

          <div class="mt"></div>
          <div class="col-lg-4">
            <h4>友達同士で</h4>
            <figure>
              <!-- <a href="about.html">  --><img src="assets/img/01_2.jpg" alt=""><!-- </a> --> 
            </fiure>
            <h4>会員登録をすれば誰でも問題を作ることができるので、自宅で勉強しながら友達同士で問題を出し合うことができます。</h4>
          </div>
          <div class="col-lg-4">
            <h4>先生と生徒で</h4>
            <figure>
              <img src="assets/img/02_2.png" alt=""></a>
            </figure>
            <h4>「自分で問題を配信したいけど、時間がない・・・」そんな忙しい学校や塾の先生も簡単に問題を配信できます。<br>今まで小テストで出していた問題も宿題として配信できます。</h4>
          </div>
          <div class="col-lg-4">
            <h4>仕事・アルバイトのアピールとして</h4>
            <figure>
              <img src="assets/img/03_2.png" alt=""></a>
            </figure>
            <h4>問題を解くときに作成した人のプロフィールを見ることができます。生徒を募集する際のアピールとして、自作問題を公開できます。Facebookやブログのリンクを掲載できるので、それぞれのサイトを同時に活用して、先生にコンタクトをとることもできます。</h4>
          </div>
            
      </div><!-- /row -->
    </div><!-- /container -->
  </div><!-- /skills -->
  
  <section id="contact"></section>
  <div id="social">
    <div class="container">
      <div class="still"></div>
      <div class="row centered">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="col-md-3">
            <a href="#"><i class="fa fa-facebook"></i></a>
          </div>
          <div class="col-md-3">
            <a href="#"><i class="fa fa-dribbble"></i></a>
          </div>
          <div class="col-md-3">
            <a href="#"><i class="fa fa-twitter"></i></a>
          </div>
          <div class="col-md-3">
            <a href="#"><i class="fa fa-envelope"></i></a>
          </div>
        </div>
      </div>
    </div><!-- /container -->
  </div><!-- /social -->


  <div id="f">
    <div class="container">
      <div class="row">
        <!-- <p>Crafted with <i class="fa fa-heart"></i> by BlackTie.co.</p> -->
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

