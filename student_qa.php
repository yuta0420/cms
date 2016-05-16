
<!-- 問題と回答欄の出力 -->
<?php
if(isset($_GET['id_que']) && !empty($_GET['id_que'])){
?>
	<?php
	//サニタイズ
	$title_que=htmlspecialchars($q[0]["title_que"]);
	$title_que_sub=htmlspecialchars($q[0]["title_que_sub"]);
	?>
	
	<form method="post" name="form1">

	<!-- 経過時間の出力 -->
	経過時間：<input type="text" name="time" size="8"><br />
	<br />

	<!-- 問題のタイトルを出力 -->
	<?php echo $title_que; ?>
	<br />
	<br />
	<?php echo $title_que_sub; ?>
	<br />


	<!-- 問題の出力 -->
	<table>

	<?php
	// $number=($question_each['num_que']);

	$i=0;
	foreach ($qas as $qa_each)
	{
		//サニタイズ
		$question=htmlspecialchars($qa_each['question']);
		$answer=htmlspecialchars($qa_each['answer']);

		//答え合わせ用に再度、問題と答えをhiddenで送信
		echo '<input type="hidden" name="question'.$i.'" value="'.$question.'">';
		echo '<input type="hidden" name="answer'.$i.'" value="'.$answer.'">';
		$i++;

		//問題表示
		echo'<tr>';
		echo'<td>問題';
		echo$i; 
		echo'</td>';
		echo'<th>'.$question.'</th>';
		echo'<th><input name="st_answer';
		echo $i;
		echo '" type="text" style="width:100px"></th>';
		echo'</tr>';
	}
	?>
	</table>
	<br />

	<!-- 答え合わせ用に問題数をhiddenで送信 -->
	<?php echo '<input type="hidden" name="number0" value="'.$i.'">'; ?>

	<!-- 回答が終わったら答え合わせ、確認メッセージを出力 -->
	<input type="submit" onclick="return confirm('答え合わせをしますか？');"value="答えを確認する">
	</form>

<?php } ?>



<!-- 回答結果の出力 -->
<?php
if(isset($_POST['number0']) && !empty($_POST['number0'])){
?>



	<table>

	<?php
	// $number=($question_each['num_que']);

	//回答にかかった時間を表示
	echo '経過時間:';
	echo $_POST['time'];
	echo '<br />';

	//回乙内容と正誤判定
	for($i=0; $i<$_POST['number0']; $i++)
	{
		//サニタイズ
		$st_answer=htmlspecialchars($_POST['st_answer'.($i+1)]);

		echo'<tr>';
		echo'<td>問題';
		echo$i+1; 
		echo'</td>';
		echo'<th>'.$_POST['question'.$i].'</th>';
		echo'<th>あなたの答え：';
		echo $st_answer;
		echo '</th>';
		echo '<th>';
		echo '&nbsp';

		//答えの判定（文字列の長さと内容が一致した場合は正解）
		if(!empty($st_answer)){
			if((strpos($_POST['answer'.$i],$st_answer) !== false)&&(strlen($_POST['answer'.$i])==strlen($st_answer)))echo '正解';
			else echo '不正解';
		}
		else echo '不正解';
		echo '&nbsp';
		echo '答え；';
		echo $_POST['answer'.$i];
		echo '</th>';
		echo'</tr>';
	}
	?>
	</table>
	<br />

<?php } ?>




