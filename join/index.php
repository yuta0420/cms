<?php

  require('../dbconnect2.php');

 //セッションを使うページに必ず入れる
  session_start();

  $error = array();

  //フォームからデータが送信されたとき
  if(!empty($_POST)){

    // var_dump($_FILES);

    $name = trim(mb_convert_kana($_POST['nick_name'],"s",'UTF-8'));
    if($name==''){
      $error['nick_name']='blank';
    }
    if($_POST['email']==''){
      $error['email']='blank';
    }
    if($_POST['password']==''){
      $error['password']='blank';
    }
    else if(strlen($_POST['password'])<4){
      $error['password']='length';
    }

    $fileName =$_FILES['picture_path']['name'];
    if(!empty($fileName)){
      $ext = substr($fileName, -3);
      if($ext!='jpg'&&$ext!='gif'&&$ext!='png'){
        $error['picture_path']='type';
      }
    }


    //重複アカウントチェック
    if(empty($error)){
      $sql = sprintf('SELECT COUNT(*) AS cnt FROM teachers WHERE email="%s"',
        mysqli_real_escape_string($db,$_POST['email']));

      $record = mysqli_query($db, $sql) or die(mysqli_error($db));
      $table = mysqli_fetch_assoc($record);
      if($table['cnt']>0){
        $error['email']='duplicate';
      }
    }

    //エラーがない場合
    if(empty($error)){
      $picture = date('YmdHis').$_FILES['picture_path']['name'];
      move_uploaded_file($_FILES['picture_path']['tmp_name'], '../member_picture/'.$picture);

      $_SESSION['join']=$_POST;
      $_SESSION['join']['picture']=$picture;
      header('Location: check.php');
      exit();
    }

  }


  //書き直し
  if(isset($_REQUEST['action'])&&($_REQUEST['action']=='rewrite')){
    //$_REQUESTスーパーグローバル変数
    //$_GETと$_POSTなどのスーパーグローバル変数を含む変数です
    $_POST=$_SESSION['join'];
    $error['rewrite']=true;
  }

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
              <a class="navbar-brand" href="index.php"><span class="strong-title"><i class="fa fa-pencil-square"></i> Question BBS</span></a>
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
      <div class="col-md-6 col-md-offset-3 content-margin-top">
        <legend>会員登録</legend>
        <form method="post" action="" class="form-horizontal" role="form" enctype="multipart/form-data">
          <!-- ニックネーム -->
          <div class="form-group">
          <p class="error">*は必須入力です。</p><br>
            <label class="col-sm-4 control-label">ニックネーム<p class="error">*</p></label>
            <div class="col-sm-8">
            <?php if(isset($_POST['nick_name'])):?>
              <input type="text" name="nick_name" class="form-control" placeholder="例： Seed kun" value="<?php echo htmlspecialchars($_POST['nick_name'],ENT_QUOTES,'UTF-8'); ?>">
            <?php else: ?>
              <input type="text" name="nick_name" class="form-control" placeholder="例： Seed kun">
            <?php endif; ?>
              <?php if( isset($error['nick_name']) && $error['nick_name']=='blank'): ?>
                <p class="error">*ニックネームを入力してください。</p>
            <?php endif; ?>
            </div>
          </div>
          <!-- メールアドレス -->
          <div class="form-group">
            <label class="col-sm-4 control-label">メールアドレス<p class="error">*</p></label>
            <div class="col-sm-8">
              <?php if(isset($_POST['email'])):?>
              <input type="text" name="email" class="form-control" placeholder="例： seedkun@nexseed.com" value="<?php echo htmlspecialchars($_POST['email'],ENT_QUOTES,'UTF-8'); ?>">
            <?php else: ?>
              <input type="text" name="email" class="form-control" placeholder="例： seedkun@nexseed.com">
            <?php endif; ?>
              <?php if( isset($error['email']) && $error['email']=='blank'): ?>
                <p class="error">*メールアドレスを入力してください。</p>
            <?php endif; ?>
            <?php if(isset($error['email']) && $error['email']=='duplicate'):?>
            <p class = "error">*指定されたメールアドレスはすでに登録されています</p>
          <?php endif;?>
            </div>
          </div>

          <!-- パスワード -->
          <div class="form-group">
            <label class="col-sm-4 control-label">パスワード<p class="error">*</p></label>
            <div class="col-sm-8">
              <?php if(isset($_POST['password'])):?>
              <input type="password" name="password" class="form-control" size="10" maxlength="20" value="<?php echo htmlspecialchars($_POST['password'],ENT_QUOTES,'UTF-8'); ?>">
            <?php else: ?>
              <input type="password" name="password" class="form_control" size="10" maxlength="20" class="form-control" >
            <?php endif; ?>
              <?php if( isset($error['password']) && $error['password']=='blank'): ?>
                <p class="error">*パスワードを入力してください。</p>
              <?php endif; ?>
              <?php if(isset($error['password'])&&$error['password']=='length'): ?>
                  <p class="error">*パスワードは4文字以上で入力してください。</p>
              <?php endif; ?>
            
            </div>
          </div>

          <!-- 自己紹介文 -->
          <div class="form-group">
            <label class="col-sm-4 control-label">自己紹介文</label>
            <div class="col-sm-8">
            <?php if(isset($_POST['self'])):?>
              <textarea name="self" cols="50" rows="5" class="form-control" placeholder="あいさつ、経歴、得意分野、アピールなど"><?php echo h($_POST['self']);?></textarea>
            <?php else: ?>
              <textarea name="self" cols="50" rows="5" class="form-control" placeholder="あいさつ、経歴、得意分野、アピールなど"></textarea>
            <?php endif; ?>
            </div>
          </div>

          <!-- 自己紹介リンク -->
          <div class="form-group">
            <label class="col-sm-4 control-label">ご自身のリンク</label>
            <div class="col-sm-8">
            <?php if(isset($_POST['link'])):?>
              <input type="text" name="link" class="form-control" placeholder="ご自身のfacebookページ、ブログのURL" value=<?php echo h($_POST['link']);?>>
            <?php else: ?>
              <input type="text" name="link" class="form-control" placeholder="ご自身のfacebookページ、ブログのURL">
            <?php endif; ?>
            </div>
          </div>

          
          <!-- プロフィール写真 -->
          <div class="form-group">
            <label class="col-sm-4 control-label">プロフィール写真</label>
            <div class="col-sm-8">
              <input type="file" name="picture_path" class="form-control">
              <?php if(isset($error['picture_path'])&&$error['picture_path']=='type'):?>
                  <p class="error">*プロフィール写真には、「.gif」「.jpg」「.png」の画像を指定してください。</p>
              <?php endif; ?>
              <?php if(!empty($error)):?>
                <p class="error">恐れ入りますが、画像を改めて指定してください。</p>
              <?php endif; ?>
            </div>
          </div>

          <input type="submit" class="btn btn-default" value="確認画面へ">
        </form>
      </div>
    </div>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
