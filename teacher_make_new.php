

                <form method="post" action="teacher_main.php">
                  <!-- 問題のタイトルを入れる -->
                  問題のタイトルを入力してください。（例：1ケタ×1ケタのかけ算）
                  <br />
                  <input name="question_title_new" type="text" style="width:500px"><br />
                  問題文を入力してください。（例：つぎの計算をしなさい）
                  <br />
                  <input name="question_title_sub" type="text" style="width:500px"><br />
                  <br />
                  小問題と答えを入力してください
                  <br />

                <table>
                      <?php
                      for ($i=0; $i < $_POST["number_que"]; $i++)
                      {

                          //問題の作成
                          echo'<tr>';
                          echo'<th>問題';
                          echo($i+1);
                          echo'</th>'; 
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
                      <?php echo '<input name="number_que_new" type="hidden" value="'.$_POST['number_que'].'">'; ?>
                      <?php echo '<input name="sel_type" type="hidden" value="0">'; ?>
                       <h2>※生徒に公開する場合は、右のリストから編集画面を開いて、「公開承認チェック」押して更新してください</h2>
                      <br />
                      <input type="submit" value="問題を作成する">
                      </form>
                