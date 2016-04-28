<?php

//ステップ1.db接続
	$dsn='mysql:dbname=cms;host=localhost:8080';/*本来はIPアドレスを指定*/

	//接続するためのユーザー情報
	$user='root';
	$password='sp4p09y6';

	//DB接続オブジェクトを作成
	$dbh=new PDO($dsn,$user,$password);

	//接続したDBオブジェクトで文字コードutf8を使うように指定
	$dbh->query('SET NAMES utf8');

?>