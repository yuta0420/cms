<?php 
  //セッションを使用
  session_start();

  require('../dbconnect2.php');



  // if(!isset($_SESSION['join'])){
  //   header('Location:index.php');
  //   exit();
  // }


  //セッションの削除の仕方
  // $_SESSION = Array();//空の配列を上書き
  // session_unset();
  // session_destroy();

// $_SESSION['join']が存在しなければindex.phpに強制遷移させる
  

  if(!isset($_SESSION['join'])){
    header('Location:index.php');
    exit();
  }

  //isset($_POST)と!emptyは少しだけ処理が変わります
  //変数に値があるかどうかを判定したい場合は!empty()を使用する

  // var_dump($_POST);
  if(!empty($_POST)){
    //登録処理
    //SQL文でデータを登録するには、INSERT文を使用する
    //使用する流れ

    //①sql文を用意する
    //$sql='INSERT INTO `members` SET `nick_name`="hoge", `email`="hoge@gmail.com", `password`="hogehoge", `picture_path`="hoge.jpg", `created`=NOW()';

    $sql=sprintf('INSERT INTO `teachers` SET `nick_name`="%s", `email`="%s", `self`="%s", `link`="%s", password="%s", `picture_path`="%s", created=now()',
      mysqli_real_escape_string($db,$_SESSION['join']['nick_name']),
      mysqli_real_escape_string($db,$_SESSION['join']['email']),
      mysqli_real_escape_string($db,$_SESSION['join']['self']),
      mysqli_real_escape_string($db,$_SESSION['join']['link']),
      mysqli_real_escape_string($db,sha1($_SESSION['join']['password'])),
      mysqli_real_escape_string($db,$_SESSION['join']['picture'])
      );



    //②sql文を実行する
    mysqli_query($db, $sql)or 
  die(mysqli_error($db));

    //③実行時に取得したデータを使用する(SELECTの場合のみ)
  unset($_SESSION['join']);
  header('Location: thanks.php');
  exit();
  }
  // var_dump($_SESSION['join']);

  function h($value){
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }
?>



<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Question BBS</title>

    <!-- Bootstrap -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/form.css" rel="stylesheet">
    <link href="../assets/css/timeline.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
    <!--
      designフォルダ内では2つパスの位置を戻ってからcssにアクセスしていることに注意！
     -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
              <a class="navbar-brand" href="index.php"><span class="strong-title"><i class="fa fa-pencil-square"></i> Qestion BBS</span></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4 content-margin-top">
        <form method="post" action="" class="form-horizontal" role="form">
          <input type="hidden" name="action" value="submit">
          <div class="well">ご登録内容をご確認ください。</div>
            <dl>
              <dt>ニックネーム</dt>
              <dd>
              <?php echo h($_SESSION['join']['nick_name']);?>
              </dd>
              <dt>メールアドレス</dt>
              <dd>
              <?php echo h($_SESSION['join']['email']);?>
              </dd>
              <dt>パスワード</dt>
              【表示されません】
              <dt>自己紹介文</dt>
              <dd>
              <?php echo h($_SESSION['join']['self']);?>
              </dd>
              <dt>ご自身のリンク</dt>
              <dd>
              <?php echo h($_SESSION['join']['link']);?>
              </dd>
              <dd>
              <dt>写真など</dt>
              <dd>
              <img src="../member_picture/<?php echo h($_SESSION['join']['picture']);?>" width="100" height="100" alt"" />
              </dd>
            </dl>

            <a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | 
            <input type="submit" class="btn btn-default" value="会員登録">
          </div>
        </form>
      </div>
    </div>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
