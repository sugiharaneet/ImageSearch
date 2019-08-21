<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>タイムライン取得</h1>
		<form action="{{ url('/time_lines/show') }}" method="POST">
		{{csrf_field()}}
		取得数(最大200）　　：<input type="number"min="1" max="200" name="get_num" required></br>
		～（取得後）詳細検索～</br>
		特定キーワード：<input type="text" name="word"></br>
		指定RT以上を検索：<input type="number" name="rt"></br>
		指定いいね以上を検索：<input type="number" name="favolite"></br>
		<input type="submit" value="検索"></br>
		</form>
	</body>
</html>
