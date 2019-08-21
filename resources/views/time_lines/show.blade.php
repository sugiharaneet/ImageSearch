<html lang="ja">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}" type="text/css">
</head>
<body>
<!--
        @if (!empty($word))
                @if (preg_match("$word", $value->text))
		@endif
	@endif
-->
<h1>タイムライン</h1>
<table border="1" width="80%">
@foreach ((array)$tweets as $value)
	<thead>
	<th width="10%"><p>{{ $value->user->name }}</p></th>
	<th width="5%"><p><img src="{{ url($value->user->profile_image_url) }}"></p></th>
	<th width="40%"><p>{{ $value->text }}</p></th>
	@if (isset($value->extended_entities->media))
		@foreach((array)$value->extended_entities->media as $vaelu_media)
			@if($vaelu_media->type == 'photo')
				<th width="25%"><img src="{{ url($vaelu_media->media_url) }}" width="200" height="150"></th>
			@endif
		@endforeach
	@endif
	</thead>
@endforeach
</table>
</body>
</html>
