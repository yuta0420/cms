            <form method="post" action="teacher_main.php">
                  <!-- 問題のタイトルを入れる -->
                  問題のタイトルを入力してください。（例：1ケタ×1ケタのかけ算）
                  <br />
                  <input name="question_title_new" type="text" style="width:500px"><br />
                  問題文を入力してください。（例：つぎの問題について答えを選択しなさい）
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
                          echo'<th>問題文';
                          echo($i+1);
                          echo'</th>'; 
                          echo'<td><input name="question';
                          echo$i;
                          echo '" type="text" style="width:300px"></td>' ;
                          echo'</tr>';


                      

                        //答えの候補の作成
                        echo'<tr>';
                        echo'<th>候補1';
                        echo '</th>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_1" type="text" style="width:100px"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<th>候補2';
                        echo '</th>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_2" type="text" style="width:100px"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<th>候補3';
                        echo '</th>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_3" type="text" style="width:100px"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<th>候補4';
                        echo '</th>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_4" type="text" style="width:100px"></td>';
                        echo'</tr>';

                        
                        echo '</table>';
                        echo '<br />';

                      // 答えの番号の選択 
                        echo '<h2>答えの番号を選択してください</h2>';
                        echo '<select name="ans'.$i.'"">';

                        echo '<option value="1">1</option>';
                        echo '<option value="2">2</option>';
                        echo '<option value="3">3</option>';
                        echo '<option value="4">4</option>';

                        echo '</select>';

                        echo '<br />';
                        echo '<br />';      
                      
                      }
                      ?>

                      
                      <?php echo '<input name="number_que_new" type="hidden" value="'.$_POST['number_que'].'">'; ?>
                      <?php echo '<input name="sel_type" type="hidden" value="1">'; ?>
                       <h3>※生徒に公開する場合は、右のリストから編集画面を開いて、「公開承認チェック」押して更新してください</h3>
                      <br />
                      <input type="submit" value="問題を作成する">
                      </form>