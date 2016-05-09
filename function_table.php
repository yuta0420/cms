<script>
    /**
     * 行追加
     */
    function insertRow_sen(id) {
        // テーブル取得
        var table = document.getElementById(id);
        // 行を行末に追加
        var row = table.insertRow(-1);
        // セルの挿入
        var cell1 = row.insertCell(-1);
        var cell2 = row.insertCell(-1);
        var cell3 = row.insertCell(-1);
        var cell4 = row.insertCell(-1);

        // ボタン用 HTMLを作成
        var button = '<input type="button" value="削除" onclick="deleteRow(this)" />';
        // 行数取得
        var row_len = table.rows.length;
        // セルの内容入力
        cell1.innerHTML = button;
        cell2.innerHTML = "問題" + row_len ; 
        cell3.innerHTML = '<input name="question"' + (row_len-1) + '" type="text" style="width:100px">'+'&emsp;'+'&emsp;';
        cell4.innerHTML = '答え<input name="answer' + (row_len-1) + '" type="text" style="width:100px">';

    }


    /**
     * 行追加
     */
    function insertRow_sel(id) {
        // テーブル取得
        var table = document.getElementById(id);
        // 行を行末に追加
        var row = table.insertRow(-1);
        // セルの挿入
        var cell1 = row.insertCell(-1);
        var cell2 = row.insertCell(-1);
        

        // ボタン用 HTMLを作成
        var button = '<input type="button" value="削除" onclick="deleteRow(this)" />';
        // 行数取得
        var row_len = table.rows.length;

        var row_que = '<table><tr><td>問題文' + row_len + '</td>' + '<td><input name="question' + (row_len-1) + '" type="text" style="width:300px"></td></tr>';

        var row_ch1 = '<tr><td>候補1</td><td><input name="choose' + (row_len-1) + '_1" type="text" style="width:100px"></td></tr>';

        var row_ch2 = '<tr><td>候補2</td><td><input name="choose' + (row_len-1) + '_2" type="text" style="width:100px"></td></tr>';

        var row_ch3 = '<tr><td>候補3</td><td><input name="choose' + (row_len-1) + '_3" type="text" style="width:100px"></td></tr>'

        var row_ch4 = '<tr><td>候補4</td><td><input name="choose' + (row_len-1) + '_4" type="text" style="width:100px"></td></tr>'

        var space = '</table><br />';

        var answer = '<h2>答えの番号を選択してください</h2><select name="ans' + (row_len-1) + '">'+'<option value="1">1</option>' + '<option value="2">2</option>' + '<option value="3">3</option>' + '<option value="4">4</option>' + '</select>';



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

    function countRow(id){

      var table = document.getElementById(id);

      return alert(table.rows.length);
    }

    </script>