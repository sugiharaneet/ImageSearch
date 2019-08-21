<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
#use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class TimeLineController extends Controller
{
	public function index() {
		return view('time_lines.index');


	}

	public function show() {
		#return view('photos.index');
		if (isset($_POST['word'])) {
			$word = $_POST['word'];
		} elseif (isset($_POST['rt'])) {
			$rt = $_POST['rt'];
		} elseif (isset($_POST['favolite'])) {
			$favolite = $_POST['favolite'];
		}
		$count = $_POST['get_num'];
		
		require_once '../vendor/autoload.php';
		#$oauth_token = session('oauth_token');
		#$oauth_token_secret = session('oauth_token_secret');
		#$consumer_key = config('twitter.consumer_key');
		#$consumer_secret = config('twitter.consumer_secret');

		$consumer_key = 'HiuVRxQ2rbHOTIB1ONYCJD45n';
		$consumer_secret = 'vsrW9uaqAf1AI4SWRntdrzIq6y7TxcHWxClwaZ07h1cyyEYenN';
		$oauth_token = '1153164232415797250-56xGlMCw7j1hFLoJhllZGUDBT5UFt5';
		$oauth_token_secret = 'n0Up1FJek80wKFn4Hw1juINB435rO61UMh7e8rlbDOHIw';

		$connection = new TwitterOAuth
			("$consumer_key",
			"$consumer_secret",
			"$oauth_token",
			"$oauth_token_secret"
		);
		$statuses = new \stdClass();
		$tweets_params = array('count' => $count);
		$tweets = $connection->get('statuses/home_timeline', $tweets_params);

		session(['data' => $tweets]);

		return view('time_lines.show', compact('tweets', 'word', 'rt', 'favolite'));
		#$tweets = new \stdClass();
		#dd($tweets);
		#exit;

#		foreach ((array)$tweets as $value) { // ->statuses
#			#$value->created_at;      //ツイート時間
#			#$value->id;              //ツイートID
#			#$value->text;            //ツイートコメント
#			if (isset($value->extended_entities->media)) {
#				foreach((array)$value->extended_entities->media as $vaelu_media){
#					//Undefined property: stdClass::$extended_entities
#					#if(isset($value->extended_entities->media)){  
#					if($vaelu_media->type == 'photo'){ //$value->extended_entities->media->type
#						//Trying to get property 'type' of non-object
#						#$vaelu_media->id;          //画像ID
#						$vaelu_media->media_url;   //画像URL [media_url_https]httpsでも取得可能
#						#$vaelu_media->expanded_url; //ツイート詳細URL
#					} #elseif($vaelu_media->type == 'video'){
#						#$vaelu_media->id;          //動画ID
#						#$vaelu_media->expanded_url; //ツイート詳細URL
#						#$vaelu_media->video_info->variants[0]->url; //mp4動画URL
#					#}
#
##echo $media . '     ';
#				}
#			}
#		}
#echo $vaelu_media->media_url;
#foreach ((array)$media as $key) {
#	echo $key;
#}  
		#$media = $vaelu_media->media_url;
		#$filename = basename($media);
		#$image = file_get_contents($media);
		#file_put_contents($filename, $image);
		#return view('photos.index', compact('media'));
	}

	
}
