          <div class="form-group">
            <form method="post" action="teacher_main.php">
                  <!-- 問題のタイトルを入れる -->
                  問題のタイトルを入力してください。（例：1ケタ×1ケタのかけ算）
                  <br />
                  <input name="question_title_new" type="text" class="form-control" style="width:500px"><br />
                  問題文を入力してください。（例：つぎの問題について答えを選択しなさい）
                  <br />
                  <input name="question_title_sub" type="text" class="form-control" style="width:500px"><br />
                  <br />

                  問題の科目（ジャンル）を選んでください
                  <select class="form-control" name="subject_id" style="width:150px">
                  <option value="0">科目を選択</option>
                  <?php
                      foreach($subjects as $subject){
                    ?>

                    <option value="<?php echo $subject['subject_id'];?>"><?php echo $subject['subject_name'];?></option>

                  <?php  }  ?>
                  
                  </select>
                  <!-- <p><a href='#' onClick="window.open('subject_add.php', 'child', 'width=500,height=400');">新しい科目を登録する</a></p><br /> -->

                  <div class="dropdown">
                    問題の追加
                    [<a href="#" class="dropdown-toggle" data-toggle="dropdown">?</a>]
                    <div class="dropdown-menu">
                      <h5>追加ボタンを押すと、問題数を一つ増やすことができます。</h5>
                    </div>
                  </div>
                  <input type="button" value="追加" class="btn btn-default btn-xs" onclick="insertRow_sel('make_sel_table', <?php echo $_POST["number_que"];?>)" /><br />
                  <br />

                  <div class="dropdown">
                    問題と答えを入力してください
                    [<a href="#" class="dropdown-toggle" data-toggle="dropdown">?</a>]
                    <div class="dropdown-menu">
                      <h5>問題と答えを入力して下さい。<br>※保存した後でも変更できます。</h5>
                    </div>
                  </div>
                  <br />

                <table id="make_sel_table">
                      <?php
                      for ($i=0; $i < $_POST["number_que"]; $i++)
                      {
                          echo '<tr>';
                          echo'<td><input type="button" value="削除" class="btn btn-default btn-xs" onclick="deleteRow(this)" /></td>';
                          

                          //問題の作成
                          echo'<td>';
                          echo '<table>';
                          echo '<tr>';
                          echo'<td>問題文';
                          echo($i+1);
                          echo'</td>'; 
                          echo'<td><input name="question';
                          echo$i;
                          echo '" type="text" class="form-control" style="width:300px"></td>' ;
                          echo'</tr>';


                      

                        //答えの候補の作成
                        echo'<tr>';
                        echo'<td>候補1';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_1" type="text" class="form-control" style="width:100px"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<td>候補2';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_2" type="text" class="form-control" style="width:100px"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<td>候補3';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_3" type="text" class="form-control" style="width:100px"></td>';
                        echo'</tr>';

                        echo'<tr>';
                        echo'<td>候補4';
                        echo '</td>';
                        echo'<td><input name="choose';
                        echo $i;
                        echo '_4" type="text" class="form-control" style="width:100px"></td>';
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
                      <div class="dropdown">
                          <input type="submit" class="btn btn-success btn-xs" onclick="return confirm('問題を保存しますか？\n※未完成の場合、左のリストから編集できます\n※公開する場合は左のリストをクリックして「公開承認」を押して保存して下さい。');"value="問題を作成する" >
                          [<a href="#" class="dropdown-toggle" data-toggle="dropdown">?</a>]
                          <div class="dropdown-menu">
                            <h5>問題と答えを入力して下さい。<br>※保存した後でも変更できます。</h5>
                          </div>
                        </div>
                      </form>
                    </div>