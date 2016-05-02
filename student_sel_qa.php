
<!-- 問題の出力 -->
<?php
if(isset($_GET['id_que']) && !empty($_GET['id_que'])){
?>

	
	<?php echo $q[0]["title_que"]; ?>
	<br />
	<?php echo $q[0]["title_que_sub"]; ?>
	
	<form method="post">
	

	<?php
	// $number=($question_each['num_que']);

	$i=0;
	foreach ($qas as $qa_each)
	{
		echo '<input type="hidden" name="question'.$i.'" value="'.$qa_each['question'].'">';
		echo '<input type="hidden" name="answer'.$i.'" value="'.$qa_each['answer'].'">';
		$i++;

		echo '問題'.$i;
		echo '<br />';
		echo$qa_each['question'];
		echo '<br />';

		

		echo'<input name="st_answer';
		echo $i;
		echo '" type="radio" value="1">'.$qa_each['choose1'];
		echo '&nbsp';


		echo'<input name="st_answer';
		echo $i;
		echo '" type="radio" value="2">'.$qa_each['choose2'];
		echo '&nbsp';


		echo'<input name="st_answer';
		echo $i;
		echo '" type="radio" value="3">'.$qa_each['choose3'];
		echo '&nbsp';


		echo'<input name="st_answer';
		echo $i;
		echo '" type="radio" value="4">'.$qa_each['choose4'];
		echo '&nbsp';

		echo'<br />';
		echo'<br />';
		
		
	}
	?>
	<br />
	<?php echo '<input type="hidden" name="number1" value="'.$i.'">'; ?>
	<input type="submit" value="答えを確認する">
	</form>

<?php } ?>



<!-- 回答結果の出力 -->
<?php
if(isset($_POST['number1']) && !empty($_POST['number1'])){
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




