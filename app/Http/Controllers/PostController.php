<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
#use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PostController extends Controller
{
	public function index() {
		// ログイン中でなければリダイレクト
		if (empty(session('oauth_verifier'))) {
			return redirect('/');
			exit;
		}
		
		require_once '../vendor/autoload.php';
		// API取得
		$oauth_token = session('oauth_token2');
		$oauth_token_secret = session('oauth_token_secret2');
		$consumer_key = config('twitter.consumer_key');
		$consumer_secret = config('twitter.consumer_secret');

                $connection = new TwitterOAuth(
                                $consumer_key,
                                $consumer_secret,
                                $oauth_token,
                                $oauth_token_secret
                );

		// ツイート機能
		$statuses = new \stdClass();
		$tweets = $connection->post('statuses/update', ['status' => 'https://yesm.site/ImageSearch/public/index?abcdef']);

		return view('posts.index');
	}
}
