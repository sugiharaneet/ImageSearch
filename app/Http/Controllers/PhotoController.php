<?php

namespace App\Http\Controllers;

use ZipArchive;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
#use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PhotoController extends Controller
{
	public function index() {
		if (empty(session('oauth_verifier'))) {
			return redirect('/');
			exit;
		}
		return view('photos.index');
	}

	public function show() {
		$type = $_POST['options'];
		$count = $_POST['get_num'];
		$q = $_POST['search'] . ' filter:images';
		
		require_once '../vendor/autoload.php';

		$consumer_key = config('twitter.consumer_key');
		$consumer_secret = config('twitter.consumer_secret');
		$oauth_token = config('twitter.access_token');
		$oauth_token_secret = config('twitter.access_token_secret');


		$connection = new TwitterOAuth
			("$consumer_key",
			"$consumer_secret",
			"$oauth_token",
			"$oauth_token_secret"
		);
		$statuses = new \stdClass();
		$tweets_params = array('q' => $q, 'result_type'=>$type, 'count' => $count);
		$tweets = $connection->get('search/tweets', $tweets_params)->statuses;

		session(['data' => $tweets]);

		return view('photos.show', compact('tweets'));
	}

	public function download() {
		// ダウンロードさせたいファイル
		if (!empty($_POST['img'])) {
			$img = $_POST['img'];
			$pathAry = array();
			for($i=0; $i<sizeof($img); $i++) {
				$pathAry[] = $img[$i];
			}
		} else {
			return redirect()->action('PhotoController@error');
			exit;
		}

		// zipのインスタンス作成
		$objzip = new \zipArchive($pathAry);

		// 一時ファイル（zip）の名前とPath
		$zipName = 'file_' . date('Ymds') . '.zip';
		$zipPath = '/tmp/' . $zipName;

		// 一時ファイル（zipファイル）を作成
		$result = $objzip->open($zipPath, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
		if ($result !== true) {
			echo 'error';
			exit;
		}
		set_time_limit(0);

		// zipに追加
		foreach ($pathAry as $filepath) { 
			$filename = basename($filepath);
			$objzip->addFromString($filename, file_get_contents($filepath));
		}

		//zip ファイルを閉じる
		@$objzip->close();

		//ダウンロード指示
		$headers = ['Content-Type' => 'image/jpeg',
			     'Content-Length' => filesize($zipPath)
				];
		return \Response::download($zipPath, $zipName, $headers);

	}

	public function error() {
		return view('photos.error');
	}
}
