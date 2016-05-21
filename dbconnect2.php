<?php
	$db = mysqli_connect('localhost:8080', 'root', 'sp4p09y6','cms') or 
	die(mysqli_connect_error());
	mysqli_set_charset($db, 'utf8');

	//or die()という書き方について
	//orの左側に記述してあるコードがfalseを返すとき、右側の処理を実行する
	//dieが実行されると()内のデータを出力する

	//mysqli_connect_error()関数は、DBとの接続時にエラーを取得する関数

	//PDOとmysqli関数の違い
	//PDOはどのDBの種類が何であれ、等しく実行できる命令文
	//mysqli群は、DBの種類がMysqlの場合に限り実行できる命令文
?>