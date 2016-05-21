              <div class="form-group">
                <form method="post" name="form1" action="teacher_main.php">
                  <!-- 問題のタイトルを入れる -->
                  <p>問題のタイトルを入力してください。（例：1ケタ×1ケタのかけ算）</p>
                  <br />
                  <input name="question_title_new" class="form-control" type="text" style="width:500px"><br />

                  問題文を入力してください。（例：つぎの計算をしなさい）
                  <br />
                  <input name="question_title_sub" class="form-control" type="text" style="width:500px"><br />
                  <br />

                  問題の科目（ジャンル）を選んでください
                  <select class="form-control" class="form-control"name="subject_id" style="width:150px">
                  <option value="0">科目を選択</option>
                  <?php
                      foreach($subjects as $subject){
                    ?>

                    <option value="<?php echo $subject['subject_id'];?>"><?php echo $subject['subject_name'];?></option>

                  <?php  }  ?>
                  
                  </select>
                   <p><a href='#' onClick="window.open('subject_add.php', 'child', 'width=500,height=400');">新しい科目を登録する</a></p><br />

                  
                  問題の追加
                  <input type="button" value="追加" class="btn btn-default btn-s" onclick="insertRow_sen('make_table',<?php echo $_POST["number_que"];?>)" /><br />
                  <br />

                  小問題のタイトルと答えを入力してください
                  <br />

                <table id="make_table">
                      <?php
                      for ($i=0; $i < $_POST["number_que"]; $i++)
                      {

                          //問題の作成
                          echo'<tr>';
                          echo'<td>';
                          echo'<input type="button" class="btn btn-default btn-xs" value="削除" onclick="deleteRow(this)" />';
                          echo'</td>';
                          echo'<td>問題';
                          echo($i+1);
                          echo'</td>'; 
                          echo'<td><input name="question';
                          echo$i;
                          echo '" type="text"  class="form-control" style="width:100px"></td>' ;


                          //問題と答えの間に空白を入れる
                          // echo '&emsp;';
                          // echo '&emsp;';

                          //答えの作成
                          echo'<td>答え</td>';
                          echo'<td><input name="answer';
                          echo $i;
                          echo '" type="text"  class="form-control" style="width:100px"></td>';
                          echo'</tr>';
                      }
                      ?>

                      </table>

                      <br />


                      <!-- 問題数の取得と送信データ作成 -->

                     
                      <!-- 
                        jsのDOM操作で指定したid or nameの要素のvalueに値をセットする
                        PHPの変数にJSの変数を代入する
                      -->
                      <input name="number_que_new" type="hidden">

                      <!-- 問題形式の取得 -->
                      <input name="sel_type" type="hidden" value="0">
                       
                      <br />
                      <input type="submit" class="btn btn-success btn-xs" onclick="return confirm('問題を保存しますか？\n※未完成の場合、左のリストから編集できます\n※公開する場合は左のリストをクリックして「公開承認」を押して保存して下さい。');"value="問題を作成する" >
                      </form>
                    </div>
                