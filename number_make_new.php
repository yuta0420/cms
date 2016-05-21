<!-- 新規作成ボタン押下時の情報取得（問題タイプと問題数） -->

<div class="form-group">

	<form method="post" action="teacher_main.php">
	<!-- 問題タイプの取得 -->
		<input type="radio" name="sel" value="0" checked>短文形式
		<input type="radio" name="sel" value="1">選択形式
		<br />
	<!-- 問題数の入力（上限50問） -->
	    問題数<input type="number" name="number_que" min="1" max="50" value="10" style="width:50px" id="number_que"><br />
	<!-- 送信ボタン -->
	    <input type="submit" class="btn btn-success btn-xs" value="新規作成" ><br /><br />
	</form>
</div>