
<!-- 問題の出力 -->
<?php
if(isset($_GET['id_que']) && !empty($_GET['id_que'])){
?>

	
	<?php echo $q["title_que"]; ?>
	<?php echo $q["title_que_sub"]; ?>
	
	<form method="post">
	<table>

	<?php
	// $number=($question_each['num_que']);

	$i=0;
	foreach ($qas as $qa_each)
	{
		echo '<input type="hidden" name="question'.$i.'" value="'.$qa_each['question'].'">';
		echo '<input type="hidden" name="answer'.$i.'" value="'.$qa_each['answer'].'">';
		$i++;
		echo'<tr>';
		echo'<td>問題';
		echo$i; 
		echo'</td>';
		echo'<th>'.$qa_each['question'].'</th>';
		echo'<th><input name="st_answer';
		echo $i;
		echo '" type="text" style="width:100px"></th>';
		echo'</tr>';
	}
	?>
	</table>
	<br />
	<?php echo '<input type="hidden" name="number" value="'.$i.'">'; ?>
	<input type="submit" value="答えを確認する">
	</form>

<?php } ?>


<!-- 回答結果の出力 -->
<?php
if(isset($_POST['number']) && !empty($_POST['number'])){
?>

	<table>

	<?php
	// $number=($question_each['num_que']);

	
	for($i=0; $i<$_POST['number']; $i++)//編集必要（問題数の取得）
	{
		echo'<tr>';
		echo'<td>問題';
		echo$i+1; 
		echo'</td>';
		echo'<th>'.$_POST['question'.$i].'</th>';
		echo'<th>あなたの答え：';
		echo $_POST['st_answer'.($i+1)];
		echo '</th>';
		echo '<th>';
		if((strpos($_POST['answer'.$i],$_POST['st_answer'.($i+1)]) !== false)&&(strlen($_POST['answer'.$i])==strlen($_POST['st_answer'.($i+1)])))echo '正解';
		else echo '不正解';
		echo '</th>';
		echo'</tr>';
	}
	?>
	</table>
	<br />

<?php } ?>




