<?php

    //DB接続
    require('dbconnect.php');

    //MySQL問題メインのデータ取得
    $sql = 'SELECT*FROM `main` WHERE `id_que`='.$_GET['id_que'];

    //SQL文の実行
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

    $main=array();

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    $main=$rec;
   
     //MySQL問題メインのデータ取得
    $sql = 'SELECT*FROM `question` WHERE `id_que`='.$_GET['id_que'];

    //SQL文の実行
    $stmt=$dbh->prepare($sql);
    $stmt->execute();


    $questions_edit=array();

    while(1){
    //実行結果として得られたデータを取得
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec==false){
      break;
    }
    // 取得したデータを配列に格納しておく
    $questions_edit[] = $rec;
  }


 //データベースから切断
  $dbh = null;
?>

                <form method="post">
                  <!-- 問題のタイトルを入れる -->
                  問題のタイトルを入力してください。（例：1ケタ×1ケタのかけ算）
                  <br />
                  <input name="question_title" type="text" style="width:500px" value="<?php echo $main['title_que']; ?>"><br />
                  問題文を入力してください。（例：つぎの計算をしなさい）
                  <br />
                  <input name="question_title_sub" type="text" style="width:500px" value="<?php echo $main['title_que_sub']; ?>"><br />
                  <br />
                  小問題と答えを入力してください
                  <br />

                  <table>
                      <?php
                      $i=0;
                      foreach($questions_edit as $question_each_edit)
                      {
                          //問題の作成
                          echo'<tr>';
                          echo'<th>問題';
                          echo($i+1);
                          echo'</th>'; 
                          echo'<td><input name="question';
                          echo$i;
                          echo '" type="text" style="width:100px" value=';
                          echo$question_each_edit['question'];
                          echo '></td>' ;


                          //問題と答えの間に空白を入れる
                          echo '&emsp;';
                          echo '&emsp;';

                          //答えの作成
                          echo'<td>答え';
                          echo'<input name="answer';
                          echo $i;
                          echo '" type="text" style="width:100px" value=';
                          echo$question_each_edit['answer']; 
                          echo '></td>';
                          echo'</tr>';

                          
                          echo'<input name="id_sub_edit';
                          echo $i;
                          echo '" type="hidden" value=';
                          echo$question_each_edit['id_sub']; 
                          echo '>';

                          $i++;
                      }
                      ?>

                  </table>

                  <?php echo '<input name="id_que_edit" type="hidden" value="'.$main['id_que'].'">'; ?>
                  <?php echo '<input name="num_que_edit" type="hidden" value="'.$main['num_que'].'">'; ?>
                  
                  <!-- 公開フラグの設定 -->
                  <?php if($main['open_flag']==1){?>
                    <input type="checkbox" name="open_flag" value="1" checked="checked">公開承認チェック
                  <?php }else{ ?>
                    <input type="checkbox" name="open_flag" value="1" >公開承認チェック
                  <?php } ?>

                  <br />
                  <?php echo '<input name="sel_type" type="hidden" value="0">'; ?>
                  <input type="submit" value="問題を更新する">
                </form>
                