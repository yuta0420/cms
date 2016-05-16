
<!-- 問題の出力 -->
<?php
if(isset($_GET['id_que']) && !empty($_GET['id_que'])){
?>

	
	<?php
	//サニタイズ
	$title_que=htmlspecialchars($q[0]["title_que"]);
	$title_que_sub=htmlspecialchars($q[0]["title_que_sub"]);
	?>

	<form method="post" name="form1">
	
	<!-- 経過時間の取得 -->
	経過時間：<input type="text" name="time" size="8"><br />
	<br />
	
	<!-- タイトルの取得 -->
	<?php echo $title_que; ?>
	<br />
	<br />
	<?php echo $title_que_sub; ?>
	<br />
	
	<?php
	// $number=($question_each['num_que']);

	//問題の出力

	//ループカウント用の変数を初期化
	$i=0;
	foreach ($qas as $qa_each)
	{

		//サニタイズ
		$question=htmlspecialchars($qa_each['question']);
		$choose1=htmlspecialchars($qa_each['choose1']);
		$choose2=htmlspecialchars($qa_each['choose2']);
		$choose3=htmlspecialchars($qa_each['choose3']);
		$choose4=htmlspecialchars($qa_each['choose4']);

		//答え合わせ用に問題と答えを再度hiddenで送信
		echo '<input type="hidden" name="question'.$i.'" value="'.$qa_each['question'].'">';
		echo '<input type="hidden" name="answer'.$i.'" value="'.$qa_each['answer'].'">';
		$i++;//カウントアップ

		echo '問題'.$i;
		echo '<br />';
		echo$question;
		echo '<br />';

		

		echo'<input name="st_answer';
		echo $i;
		echo '" type="radio" value="1">'.$choose1;
		echo '&nbsp';


		echo'<input name="st_answer';
		echo $i;
		echo '" type="radio" value="2">'.$choose2;
		echo '&nbsp';


		echo'<input name="st_answer';
		echo $i;
		echo '" type="radio" value="3">'.$choose3;
		echo '&nbsp';


		echo'<input name="st_answer';
		echo $i;
		echo '" type="radio" value="4">'.$choose4;
		echo '&nbsp';

		echo'<br />';
		echo'<br />';
		
		
	}
	?>
	<br />
	<?php echo '<input type="hidden" name="number1" value="'.$i.'">'; ?>
	<input type="submit" onclick="return confirm('答え合わせをしますか？');"　value="答えを確認する">
	</form>

<?php } ?>



<!-- 回答結果の出力 -->
<?php
if(isset($_POST['number1']) && !empty($_POST['number1'])){

	//経過時間の取得
	echo '経過時間:';
	echo $_POST['time'];
	echo '<br />';
?>

	<table>

	<?php
	
	for($i=0; $i<$_POST['number1']; $i++)
	{
		echo'<tr>';
		echo'<td>問題';
		echo$i+1; 
		echo '&nbsp';
		echo'</td>';
		echo'<th>'.$_POST['question'.$i].'</th>';
		echo'<th>あなたの答え：';
		echo $_POST['st_answer'.($i+1)];
		echo '</th>';
		echo '<th>';
		echo '&nbsp';
		if($_POST['st_answer'.($i+1)]==$_POST['answer'.$i])echo '正解';
		//問題番号が一致していたら正解
		else echo '不正解';
		echo '&nbsp';
		echo '答え：';
		echo $_POST['answer'.$i];
		echo '&nbsp';
		echo '</th>';
		echo'</tr>';
	}
	?>
	</table>
	<br />

 <?php } ?>




