ユーザー名　：{{ $user_info->name }}</br>
プロフィール：{{ $user_info->description }}
<p><img src="{{ $user_info->profile_image_url_https }}" width="200px" height="150px"></p>
<a href="/ImageSearch/public/logout">ログアウト</a></br>
<a href="/ImageSearch/public/photos">画像検索＆ダウンロード</a></br>
<a href="/ImageSearch/public/posts">このアプリを宣伝する</a>

