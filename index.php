

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
<body >

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
      <div class="col-md-4 content-margin-top">

      		<!-- ここに4列分のコンテナの記述が可能 -->

          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-info">Question BBSについて</a>
            <a href="#" class="list-group-item list-group-item-info">使い方</a>
            <a href="#" class="list-group-item list-group-item-info">活用シーン</a>
            <a href="#" class="list-group-item list-group-item-info">ログイン</a> 
          </div>
      </div> 
    


      <div class="col-md-8 content-margin-top">
        <table　 width="100%">
          
          <tr>
            <td>
              <a class="btn btn-primary btn-block btn-lg" href="student_main.php" role="button">問題に答える(会員登録不要)</a>
            </td>
            <td>
              <a class="btn btn-success btn-block btn-lg" href="login.php" role="button">問題を作る（ログイン）</a>
            </td>
          </tr>
          <tr>
            <td></td>
            <td><a href="join/index.php">新規登録はこちら(問題を作る方は必須になります)</a></td>
          </tr>
        </table>
      	
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



