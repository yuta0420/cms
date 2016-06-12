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
              <div class="form_group">
                <form method="post">
                  <!-- 問題のタイトルを入れる -->
                  問題のタイトルを入力してください。（例：1ケタ×1ケタのかけ算）
                  <br />
                  <input name="question_title" type="text" style="width:80%" class="form-control" value="<?php echo htmlspecialchars($main['title_que']); ?>"><br />
                  問題文を入力してください。（例：つぎの計算をしなさい）
                  <br />
                  <input name="question_title_sub" type="text" style="width:80%" class="form-control" value="<?php echo htmlspecialchars($main['title_que_sub']); ?>"><br />
                  <br />

                  問題の科目（ジャンル）を選んでください
                  <select class="form-control" name="subject_id" style="width:150px">
                  <option value="0">科目を選択</option>
                  <?php
                      foreach($subjects as $subject){
                    ?>
                      <?php if($subject['subject_id']==$main['subject_id']){?>
                        <option value="<?php echo $subject['subject_id']?>" selected><?php echo $subject['subject_name'];?></option>
                      <?php } else{?>
                      <option value="<?php echo $subject['subject_id']?>"><?php echo $subject['subject_name'];?></option>
                      <?php }?>
                  <?php  }   ?>
                </select>
                <p><a href='#' onClick="window.open('subject_add.php', 'child', 'width=500,height=400');">新しい科目を登録する</a></p><br />

                   <div class="dropdown">
                    問題の追加
                    [<a href="#" class="dropdown-toggle" data-toggle="dropdown">?</a>]
                    <div class="dropdown-menu">
                      <h5>追加ボタンを押すと、問題数を一つ増やすことができます。</h5>
                    </div>
                  </div>
                  <input type="button" value="追加" class="btn btn-default btn-xs" onclick="insertRow_sen('make_table_edit',<?php echo $main["num_que"];?>)" /><br />
                  <br />

                  <div class="dropdown">
                    問題と答えを入力してください
                    [<a href="#" class="dropdown-toggle" data-toggle="dropdown">?</a>]
                    <div class="dropdown-menu">
                      <h5>問題と答えを入力して下さい。<br>※保存した後でも変更できます。</h5>
                    </div>
                  </div>
                  <br />

                  <table id='make_table_edit'>
                      <?php
                      $i=0;
                      foreach($questions_edit as $question_each_edit)
                      {
                          //問題の作成
                          echo'<tr>';
                          echo'<td>';
                          echo'<input type="button" value="削除" class="btn btn-default btn-xs"onclick="deleteRow(this)" />';
                          echo'</td>';
                          echo'<td>問題';
                          echo($i+1);
                          echo'</td>'; 
                          echo'<td><input name="question';
                          echo$i;
                          echo '" type="text"  class="form-control"style="width:100px" value=';
                          echo htmlspecialchars($question_each_edit['question']);
                          echo '></td>' ;


                          //問題と答えの間に空白を入れる
                          echo '&emsp;';
                          echo '&emsp;';

                          //答えの作成
                          echo'<td>答え</td>';
                          echo'<td><input name="answer';
                          echo $i;
                          echo '" type="text" style="width:100px" class="form-control" value=';
                          echo htmlspecialchars($question_each_edit['answer']); 
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
                  <div class="dropdown">
                    <input type="checkbox" name="open_flag" value="1" checked="checked">公開承認チェック
                    [<a href="#" class="dropdown-toggle" data-toggle="dropdown">?</a>]
                    <div class="dropdown-menu">
                      <h5>公開承認チェックにチェックをすると問題が公開されます。</h5>
                    </div>
                  </div>
                  <?php }else{ ?>
                  <div class="dropdown">
                    <input type="checkbox" name="open_flag" value="1" >公開承認チェック
                    [<a href="#" class="dropdown-toggle" data-toggle="dropdown">?</a>]
                    <div class="dropdown-menu">
                      <h5>公開承認チェックにチェックをすると問題が公開されます。</h5>
                    </div>
                  </div>
                  <?php } ?>

                  <br />
                  <?php echo '<input name="sel_type" type="hidden" value="0">'; ?>

                  <div class="dropdown">
                    <input type="submit" class="btn btn-success btn-s"
                 onclick="return confirm('※注意※\n未完成でも、「公開承認チェック」を押していると\n問題が公開されてしまいます。'); "
                 value="問題を更新する" >
                    [<a href="#" class="dropdown-toggle" data-toggle="dropdown">?</a>]
                    <div class="dropdown-menu">
                      <h5>問題と答えを入力して下さい。<br>※保存した後でも変更できます。</h5>
                    </div>
                  </div>
                 
                </form>
              </div>
                