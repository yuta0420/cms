
                <form method="post" action="teacher_main.php">
                  <!-- 問題のタイトルを入れる -->
                  問題のタイトルを入力してください。（例：1ケタ×1ケタのかけ算）
                  <br />
                  <input name="question_title_new" type="text" style="width:500px"><br />
                  問題文を入力してください。（例：つぎの計算をしなさい）
                  <br />
                  <input name="question_title_sub" type="text" style="width:500px"><br />
                  <br />
                  
                  問題の追加
                  <input type="button" value="追加" onclick="insertRow_sen('make_table')" /><br />
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
                      <?php $number_que_new = (echo 'countRow("make_table")'); ?>
                      <?php echo '<input name="number_que_new" type="hidden" value="'.$number_que_new.'">'; ?>

                      <!-- 問題形式の取得 -->
                      <?php echo '<input name="sel_type" type="hidden" value="0">'; ?>
                       <h2>※生徒に公開する場合は、右のリストから編集画面を開いて、「公開承認チェック」押して更新してください</h2>
                      <br />
                      <input type="submit"  value="問題を作成する" >
                      </form>
                