<script>

    //編集画面での問題作成時の問題追加・削除用の関数
    //①文章問題の行追加
    //②選択問題の行追加
    //③行削除
    
    var cnt=0;//追加回数のカウント用変数（問題数取得時用）

    /**
     * ①文章問題の行追加
     */

    function insertRow_sen(id, number) {


        cnt++;

        // テーブル取得
        var table = document.getElementById(id);
        // 行を行末に追加
        var row = table.insertRow(-1);
        // セルの挿入
        var cell1 = row.insertCell(-1);
        var cell2 = row.insertCell(-1);
        var cell3 = row.insertCell(-1);
        var cell4 = row.insertCell(-1);
        var cell5 = row.insertCell(-1);

        // ボタン用 HTMLを作成
        var button = '<input type="button" value="削除" class="btn btn-default btn-xs" onclick="deleteRow(this)" />';
        
        // セルの内容入力
        cell1.innerHTML = button;
        cell2.innerHTML = "問題" + (cnt+number); 
        cell3.innerHTML = '<input name="question' + (cnt+number-1) + '" type="text" class="form-control" style="width:100px">'+'&emsp;'+'&emsp;';
        cell4.innerHTML = '答え';
        cell5.innerHTML ='<input name="answer' + (cnt+number-1) + '" type="text" class="form-control" style="width:100px">';

    }


    /**
     * 行追加
     */

     var cnt=0;//追加回数のカウント用変数（問題数取得時用）

    function insertRow_sel(id, number) {
        cnt++;

        // テーブル取得
        var table = document.getElementById(id);
        // 行を行末に追加
        var row = table.insertRow(-1);
        // セルの挿入
        var cell1 = row.insertCell(-1);
        var cell2 = row.insertCell(-1);
        

        // ボタン用 HTMLを作成
        var button = '<input type="button" value="削除"  class="btn btn-default btn-xs"onclick="deleteRow(this)" />';
        // 行数取得
        var row_len = table.rows.length;

        //各セルに代入する文字列を取得（あまりにも長いので、別で格納してから、セルに格納）
        var row_que = '<table><tr><td>問題文' + (cnt+number) + '</td>' + '<td><input name="question' + (cnt+number-1) + '" type="text" class="form-control" style="width:300px"></td></tr>';

        var row_ch1 = '<tr><td>候補1</td><td><input name="choose' +(cnt+number-1) + '_1" type="text" class="form-control" style="width:100px"></td></tr>';

        var row_ch2 = '<tr><td>候補2</td><td><input name="choose' + (cnt+number-1) + '_2" type="text" class="form-control" style="width:100px"></td></tr>';

        var row_ch3 = '<tr><td>候補3</td><td><input name="choose' + (cnt+number-1) + '_3" type="text" class="form-control" style="width:100px"></td></tr>'

        var row_ch4 = '<tr><td>候補4</td><td><input name="choose' + (cnt+number-1) + '_4" type="text" class="form-control" style="width:100px"></td></tr>'

        var space = '</table><br />';

        var answer = '<h2>答えの番号を選択してください</h2><select name="ans' + (cnt+number-1) + '" class="form-control">'+'<option value="1">1</option>' + '<option value="2">2</option>' + '<option value="3">3</option>' + '<option value="4">4</option>' + '</select>';



        // セルの内容入力
        cell1.innerHTML = button;
        cell2.innerHTML = row_que + row_ch1 + row_ch2 + row_ch3 + row_ch4 + space + answer; 
 

    }


    /**
     * 行削除
     */
    function deleteRow(obj) {

        // 削除ボタンを押下された行を取得
        tr = obj.parentNode.parentNode;
        // trのインデックスを取得して行を削除する
        tr.parentNode.deleteRow(tr.sectionRowIndex);
    }

    

    </script>