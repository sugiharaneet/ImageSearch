<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="{{ asset('/css/style.css') }}">
	</head>
	<body>
		<h1>画像検索</h1></br>
		<a href="/ImageSearch/public/photos">戻る</a>

		<form action="{{ url('/photos/download') }}" method="POST">
		{{ csrf_field() }}

		@foreach ((array)$tweets as $value)
			@if (isset($value->extended_entities->media))
				@foreach((array)$value->extended_entities->media as $vaelu_media)
					@if($vaelu_media->type == 'photo')
					<div class="image-list">
						<ul>
							<li>
								<img src="{{ url($vaelu_media->media_url) }}" width="300" height="300"><input type="checkbox" name="img[]" value="{{ url($vaelu_media->media_url) }}" />
							</li>
						</ul>
					</div>
					@endif
				@endforeach
			@endif
		@endforeach
		<input type="submit" value="ダウンロード" style="padding:100px 100px;">
		</form>
	</body>
</html>
