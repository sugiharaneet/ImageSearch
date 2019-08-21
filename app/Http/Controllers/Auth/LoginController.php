<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	public function twitter()
	{
		$twitter = new TwitterOAuth(
			config('twitter.consumer_key'),
			config('twitter.consumer_secret')
		);
		# 認証用のrequest_tokenを取得
		$token = $twitter->oauth('oauth/request_token', array(
			'oauth_callback' => config('twitter.callback_url')
		));

		# 認証画面で認証を行うためSessionに入れる
		session(array(
			'oauth_token' => $token['oauth_token'],
			'oauth_token_secret' => $token['oauth_token_secret'],
		));

		# 認証画面へ移動させる
		$url = $twitter->url('oauth/authenticate', array(
			'oauth_token' => $token['oauth_token']
		));

		return redirect($url);
	}

	public function callback(Request $request)
	{
		$oauth_token = session('oauth_token');
		$oauth_token_secret = session('oauth_token_secret');

		# request_tokenが不正な値だった場合リダイレクト
		if ($request->has('oauth_token') && $oauth_token !== $request->oauth_token) {
			return Redirect::to('/login');
		}

		# request_tokenからaccess_tokenを取得
		$twitter = new TwitterOAuth(
				$oauth_token,
				$oauth_token_secret
				);
		$token = $twitter->oauth('oauth/access_token', array(
					'oauth_verifier' => $request->oauth_verifier,
					'oauth_token' => $request->oauth_token,
					));

                session(array(
			'oauth_verifier' => $request->oauth_verifier,
			'oauth_token' => $request->oauth_token,
                ));
		//アプリ宣伝用にトークン取得
		session(array(
			'oauth_token2' => $token['oauth_token'],
			'oauth_token_secret2' => $token['oauth_token_secret'],
		));	
		# access_tokenを用いればユーザー情報へアクセスできるため、それを用いてTwitterOAuthをinstance化
		$twitter_user = new TwitterOAuth(
				config('twitter.consumer_key'),
				config('twitter.consumer_secret'),
				$token['oauth_token'],
				$token['oauth_token_secret']
				);

		# 本来はアカウント有効状態を確認するためのものですが、プロフィール取得にも使用可能
		$user_info = $twitter_user->get('account/verify_credentials');
		
		return view('callback', ['user_info' => $user_info]);
	}
	
	public function logout() {
		session()->flush();
		return redirect('/');
	}
	
	use AuthenticatesUsers;

	protected $redirectTo = '/home';

	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}
}
