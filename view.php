<?php

  require('dbconnect.php');

     function h($value){
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }


    //ログインしているユーザーのデータをDBから取得
    $sql=sprintf('SELECT * FROM `teachers` WHERE `teacher_id`=%d',
      $_POST['id_teach']
      ); 
    
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    $record=$stmt->fetch(PDO::FETCH_ASSOC);
    $teacher=$record;


    $sql = 'SELECT *FROM `main` WHERE `delete_flag`=0  AND `id_teach`='.$_POST['id_teach'].' ORDER BY `time_made` DESC';

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
 
?>



<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>QuestionBBS</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/form.css" rel="stylesheet">
    <link href="assets/css/timeline.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
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
        <legend><?php echo h($teacher['nick_name']).'さん'?></legend>

        <table border="1" cellpadding=10>
          <tr>
            <!-- プロフィール写真 -->
            <td width="150">プロフィール写真</td>
            <td width="400" style="margin:0 auto">
              <img src="member_picture/<?php echo h($teacher['picture_path']);?>" width="300px" height="auto" >
            </td>
          </tr>


          

          <!-- 自己紹介文 -->
          <tr>
            <td width="150">自己紹介文</td>
            <td class="col-sm-8">
              <?php echo  nl2br(h($teacher['self']));?>
            </td>
          </tr>

          <!-- 自己紹介リンク -->
          <tr>
            <td width="150"><?php echo h($teacher['nick_name']).'さん'?>のリンク</td>
            <td class="col-sm-8">
            <?php echo '<a href="';
                  echo h($teacher['link']);
                  echo '">'.h($teacher['link']);
                  echo '</a>';
            ?>
            </td>
          </tr>

          <tr>
            <td width="150"><?php echo h($teacher['nick_name']).'さん'?>の<br/>作成した問題</td>
            <td class="col-sm-8">
              <?php
              //リストから取得した$questionから$question_eachに1列ずつデータを格納（全要素）
              foreach ($questions as $question_each) {

                $title_que=htmlspecialchars($question_each['title_que']);
                //問題タイトルの出力
                 echo '<a href="student_main.php?id_que='.$question_each['id_que'].'">'.$title_que.'</a>';

                // リストに最終更新日時を出力
                if($question_each['time_edit']>$question_each['time_made'])echo '<h5>'.$question_each['time_edit'].'</h5>';
                else echo '<h5>'.$question_each['time_made'].'</h5>';  
              }?>
            </td>
          </tr>

        </table>

        <br /><br />
        <a href="student_main.php">戻る</a>
        
      </div>
    </div>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
