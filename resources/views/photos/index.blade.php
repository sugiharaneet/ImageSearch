<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>画像検索</h1>
		<form action="{{ url('/photos/show') }}" method="POST">
		{{csrf_field()}}
		検索ワード：<input type="text" name="search">
		(空白はランダムで検索します。）</br>
		オプション：<select name="options">
			<option value="recent" selected>新着順</option>
			<option value="popular" selected>人気順</option>
			<option value="mixed" selected>ランダム</option>
			</select></br>
		取得数　　：<input type="number" min="20" name="get_num">(20～)</br>
		<input type="submit" value="検索" style="padding:7px 12px;"></br>
		</form>
	</body>
</html>
