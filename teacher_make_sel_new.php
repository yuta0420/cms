            <form method="post" action="teacher_main.php">
                  <!-- 問題のタイトルを入れる -->
                  問題のタイトルを入力してください。（例：1ケタ×1ケタのかけ算）
                  <br />
                  <input name="question_title_new" type="text" style="width:500px"><br />
                  問題文を入力してください。（例：つぎの問題について答えを選択しなさい）
                  <br />
                  <input name="question_title_sub" type="text" style="width:500px"><br />
                  <br />

                  問題の追加
                  <input type="button" value="追加" onclick="insertRow_sel('make_sel_table', <?php echo $_POST["number_que"];?>)" /><br />
                  <br />

                  小問題と答えを入力してください
                  <br />

                <table id="make_sel_table">
                      <?php
                      for ($i=0; $i < $_POST["number_que"]; $i++)
                      {
                          echo '<tr>';
                          echo'<td><input type="button" value="削除" onclick="deleteRow(this)" /></td>';
                          

                          //問題の作成
                          echo'<td>';
                          echo '<table>';
                          echo '<tr>';
                          echo'<td>問題文';
                          echo($i+1);
                          echo'</td>'; 
                          echo'<td><input name="question';
                          echo$i;
                          echo '" type="text" style="width:300px"></td>' ;
                          echo'</tr>';


                      

                        //答えの候補の作成
                        echo'<tr>';
                        echo'<td>候補1';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_1" type="text" style="width:100px"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<td>候補2';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_2" type="text" style="width:100px"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<td>候補3';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_3" type="text" style="width:100px"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<td>候補4';
                        echo '</td>';
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
                        echo '</td>';

                        echo '</tr>';    
                      
                      }
                      ?>

                      </table>

                      
                      <?php echo '<input name="number_que_new" type="hidden" value="'.$_POST['number_que'].'">'; ?>
                      <?php echo '<input name="sel_type" type="hidden" value="1">'; ?>
                       
                      <br />
                      <input type="submit"  onclick="return confirm('問題を保存しますか？\n※未完成の場合、左のリストから編集できます\n※公開する場合は左のリストをクリックして「公開承認」を押して保存して下さい。'); "value="問題を作成する" >
                      </form>