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
    $sql = 'SELECT*FROM `selection` WHERE `id_que`='.$_GET['id_que'];

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
                  <input name="question_title" type="text" style="width:500px" value="<?php echo htmlspecialchars($main['title_que']);?>"><br />
                  問題文を入力してください。（例：つぎの計算をしなさい）
                  <br />
                  <input name="question_title_sub" type="text" style="width:500px" value="<?php echo htmlspecialchars($main['title_que_sub']); ?>"><br />
                  <br />

                   問題の追加
                  <input type="button" value="追加" onclick="insertRow_sel('make_sel_table_edit', <?echo $main['num_que']?>)" /><br />
                  <br />

                  小問題と答えを入力してください
                  <br />

                  <table id='make_sel_table_edit'>
                      <?php
                      $i=0;
                      foreach($questions_edit as $question_each_edit)
                      {
                          echo '<tr>';
                          echo'<td><input type="button" value="削除" onclick="deleteRow(this)" /></td>';
                          echo '<td>';
                          echo '<table>';



                          //問題の作成
                          echo'<tr>';
                          echo'<td>問題文';
                          echo($i+1);
                          echo'</td>';
                          echo'<td><input name="question';
                          echo$i;
                          echo '" type="text" style="width:300px" value="';
                          echo htmlspecialchars($question_each_edit['question']);
                          echo '"></td>';
                          echo '</tr>';
                          


                        

                        //答えの候補の作成
                        echo'<tr>';
                        echo'<td>候補1';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_1" type="text" style="width:100px" value="';
                        echo htmlspecialchars($question_each_edit['choose1']);
                        echo '"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<td>候補2';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_2" type="text" style="width:100px" value="';
                        echo htmlspecialchars($question_each_edit['choose2']);
                        echo '"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<td>候補3';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_3" type="text" style="width:100px" value="';
                        echo htmlspecialchars($question_each_edit['choose3']);
                        echo '"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<td>候補4';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_4" type="text" style="width:100px" value="';
                        echo htmlspecialchars($question_each_edit['choose4']);
                        echo '"></td>';
                        echo '</tr>';

                        echo '</table>';
                        
                        echo '<br />';

                      // 答えの番号の選択 
                        echo '<h2>答えの番号を選択してください</h2>';
                        echo $question_each_edit['answer'];
                        echo '<select name="ans'.$i.'">';

                        if($question_each_edit['answer']=="1"){echo '<option value="1" selected>1</option>';}
                        else {echo '<option value="1">1</option>';}

                        if($question_each_edit['answer']=="2"){echo '<option value="2" selected>2</option>';}
                        else {echo '<option value="2">2</option>';}

                        if($question_each_edit['answer']=="3"){echo '<option value="3" selected>3</option>';}
                        else {echo '<option value="3">3</option>';}

                        if($question_each_edit['answer']=="4"){echo '<option value="4" selected>4</option>';}
                        else {echo '<option value="4">4</option>';}
                        

                        echo '</select>';
                        echo '</td>';

                        echo '</tr>';
                        

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
                  <?php echo '<input name="sel_type" type="hidden" value="1">'; ?>
                  
                 <input type="submit" 
                 onclick="return confirm('※注意※\n未完成でも、「公開承認チェック」を押していると\n問題が公開されてしまいます。'); "
                 value="問題を更新する" >
                </form>
                