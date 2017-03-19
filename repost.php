<?php
if(!$_GET['cookies']||!$_GET['targetid']){
	print('No Data!');
}else{
	$c = $_GET['cookies'];
	$c = str_replace(" ", "+", $c);
	$t = strlen($_GET['targetid']);
	if($t<30){
		print('Target ID Salah');
		exit();
	}
	require_once('function.php');
	$app = new LineTimeline();
		$app->setSession($c);
		$get = json_decode(json_encode($app->getHomelist($t)),true);
		$user = json_decode(json_encode($app->userinfo()),true);
		$text = $get[0]['post']['contents']['text'];
		$text = str_replace("\n", "", $text);
		$id = $get[0]['feedInfo']['id'];
		$cek = $get[0]['post']['contents']['media'][0]['type'];
		$u = $user['user']['mid'];
    if(!file_exists("repost/".$u.".txt")){
        $h = fopen("repost/".$u.".txt","w");
        fwrite($h,"");
        fclose($h);
    }
	if($cek=='PHOTO' OR $cek=='VIDEO'){
			print('Quotes Ber-type '.$cek);
	}else{
		if(in_array($id,explode("\n",strtolower(file_get_contents("repost/".$u.".txt"))))){
				print('Quotes Dah Direpost'.$cek);
		}else{
				$photo = $app->postTimeline($text, 1, false);
					print('Sukses Repost Quotes => '.$text);
			if(!file_exists("repost/".$u.".txt")){
					$h = fopen("repost/".$u.".txt","w");
					fwrite($h,$id."\n");
					fclose($h);
			}else{
					$h = fopen("repost/".$u.".txt","a");
					fwrite($h,$id."\n");
					fclose($h);
			}
		}
	}
}
