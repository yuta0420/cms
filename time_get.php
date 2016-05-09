<script type="text/javascript">
<!--

var start = new Date();

// 初期化
var hour = 0;
var min = 0;
var sec = 0;
var now = 0;
var datet = 0;

function disp(){

	now = new Date();

	datet = parseInt((now.getTime() - start.getTime()) / 1000);

	hour = parseInt(datet / 3600);
	min = parseInt((datet / 60) % 60);
	sec = datet % 60;

	// 数値が1桁の場合、頭に0を付けて2桁で表示する指定
	if(hour < 10) { hour = "0" + hour; }
	if(min < 10) { min = "0" + min; }
	if(sec < 10) { sec = "0" + sec; }

	// フォーマットを指定（不要な行を削除する）
	var timer1 = hour + ':' + min + ':' + sec; // パターン1
	

	// テキストフィールドにデータを渡す処理（不要な行を削除する）
	document.form1.time.value = timer1; // パターン1
	
	

	setTimeout("disp()", 1000);

}

// -->
</script>