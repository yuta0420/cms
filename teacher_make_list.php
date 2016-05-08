
<div class="timeline-label">                                            	
<!-- リストに問題タイトルを出力 -->
	<?php
	//サニタイズ
	$title_que=htmlspecialchars($question_each['title_que']);
	?>

	<!-- リスト出力 -->
	<a href="teacher_main.php?id_que=<?php echo $question_each['id_que'];?>&sel=<?php echo $question_each['sel_type'];?>"><?php echo $title_que; ?></a>
<!-- リストに最終更新日時を出力 -->
<?php 
	if($question_each['time_edit']>$question_each['time_made'])
		echo '<h5>'.$question_each['time_edit'].'</h5>';
	else echo '<h5>'.$question_each['time_made'].'</h5>';
?>
 	<p id="icon">
	<a onclick="return confirm('完全に削除しますか？');" href="teacher_main.php?action=delete&id_del=<?php echo $question_each['id_que'];?>" ><i class="fa fa-trash fa-lg"></i></a>
	</p>

