
                <form method="post" name="form1" action="teacher_main.php">
                  <!-- 問題のタイトルを入れる -->
                  問題のタイトルを入力してください。（例：1ケタ×1ケタのかけ算）
                  <br />
                  <input name="question_title_new" type="text" style="width:500px"><br />

                  問題文を入力してください。（例：つぎの計算をしなさい）
                  <br />
                  <input name="question_title_sub" type="text" style="width:500px"><br />
                  <br />

                  
                  問題の追加
                  <input type="button" value="追加" onclick="insertRow_sen('make_table',<?php echo $_POST["number_que"];?>)" /><br />
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
                          echo'<input type="button" value="削除" onclick="deleteRow(this)" />';
                          echo'</td>';
                          echo'<td>問題';
                          echo($i+1);
                          echo'</td>'; 
                          echo'<td><input name="question';
                          echo$i;
                          echo '" type="text" style="width:100px"></td>' ;


                          //問題と答えの間に空白を入れる
                          echo '&emsp;';
                          echo '&emsp;';

                          //答えの作成
                          echo'<td>答え';
                          echo'<input name="answer';
                          echo $i;
                          echo '" type="text" style="width:100px"></td>';
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
                      <input type="submit"  onclick="return confirm('問題を保存しますか？\n※未完成の場合、左のリストから編集できます\n※公開する場合は左のリストをクリックして「公開承認」を押して保存して下さい。');"value="問題を作成する" >
                      </form>
                