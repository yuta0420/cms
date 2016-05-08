<?php

  //DB呼び出し
  require('dbconnect.php');

  //DB削除の場合
  require('dbconnect_delete.php');

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

  <script>
    /**
     * 行追加
     */
    function insertRow_sen(id) {
        // テーブル取得
        var table = document.getElementById(id);
        // 行を行末に追加
        var row = table.insertRow(-1);
        // セルの挿入
        var cell1 = row.insertCell(-1);
        var cell2 = row.insertCell(-1);
        var cell3 = row.insertCell(-1);
        var cell4 = row.insertCell(-1);

        // ボタン用 HTMLを作成
        var button = '<input type="button" value="削除" onclick="deleteRow(this)" />';
        // 行数取得
        var row_len = table.rows.length;
        // セルの内容入力
        cell1.innerHTML = button;
        cell2.innerHTML = "問題" + row_len ; 
        cell3.innerHTML = '<input name="question"' + row_len + '" type="text" style="width:100px">'+'&emsp;'+'&emsp;';
        cell4.innerHTML = '答え<input name="answer' + (row_len-1) + '" type="text" style="width:100px">';

    }
    /**
     * 行削除
     */
    function deleteRow(obj) {
        // 削除ボタンを押下された行を取得
        tr = obj.parentNode.parentNode;
        // trのインデックスを取得して行を削除する
        tr.parentNode.deleteRow(tr.sectionRowIndex);
    }

    function countRow(id){

      var table = document.getElementById(id);

      return alert(table.rows.length);
    }

    </script>

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
               <div class="timeline-centered box_srcollbar">       

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

