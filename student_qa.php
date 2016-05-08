
<!-- 問題の出力 -->
<?php
if(isset($_GET['id_que']) && !empty($_GET['id_que'])){
?>
	<?php
	//サニタイズ
	$title_que=htmlspecialchars($q[0]["title_que"]);
	$title_que_sub=htmlspecialchars($q[0]["title_que_sub"]);
	?>
	
	
	<?php echo $title_que; ?>
	<br />
	<br />
	<?php echo $title_que_sub; ?>
	<br />
	
	<form method="post">
	<table>

	<?php
	// $number=($question_each['num_que']);

	$i=0;
	foreach ($qas as $qa_each)
	{
		//サニタイズ
		$question=htmlspecialchars($qa_each['question']);
		$answer=htmlspecialchars($qa_each['answer']);

		//問題表示
		echo '<input type="hidden" name="question'.$i.'" value="'.$question.'">';
		echo '<input type="hidden" name="answer'.$i.'" value="'.$answer.'">';
		$i++;
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
	<?php echo '<input type="hidden" name="number0" value="'.$i.'">'; ?>
	<input type="submit" value="答えを確認する">
	</form>

<?php } ?>



<!-- 回答結果の出力 -->
<?php
if(isset($_POST['number0']) && !empty($_POST['number0'])){
?>



	<table>

	<?php
	// $number=($question_each['num_que']);

	
	for($i=0; $i<$_POST['number0']; $i++)//編集必要（問題数の取得）
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

		//答えの判定
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




