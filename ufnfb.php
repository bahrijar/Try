<?php

####Copyright By Janu fb.com/lastducky####
####Thanks For Indra Swastika(fungsi.php)####
####Change This Copyright Doesn't Make You a Coder :) ####



echo "Username?\nInput : ";
$username =  trim(fgets(STDIN));
#######END OF EDIT AREA########
require_once('func.php');
if (!file_exists($username.".ig")) {
    echo "Password?\nInput : ";
    $password = trim(fgets(STDIN));
    $log = masuk($username, $password);
    if ($log == "data berhasil diinput") {
        echo "Berhasil Input Data\n";
    } else {
        echo "Gagal Input Data\n";
    }
} else {
    echo "Type? (1 = Yang Gak Follback)\nInput : ";
    $type = trim(fgets(STDIN));
    echo "Jeda Setiap Ekse? (Recom = 1)";
    $jeda = trim(fgets(STDIN));
    if($type==1) $type = "true";
    $gip    = file_get_contents($username.'.ig');
    $gip    = json_decode($gip);
    $cekuki = instagram(1, $gip->useragent, 'feed/timeline/', $gip->cookies);
    $cekuki = json_decode($cekuki[1]);
    if ($cekuki->status != "ok") {
        $ulang = masuk($username, $password);
        if ($ulang != "data berhasil diinput") {
            echo "Cookie Telah Mati, Gagal Membuat Ulang Cookie\n";
        } else {
            echo "Cookie Telah Mati, Sukses Membuat Ulang Cookie\n";
        }
    } else {
        
        $data = file_get_contents($username.'.ig');
        $data = json_decode($data);
        
        $userid = instagram(1, $data->useragent, 'users/' . $username . '/usernameinfo', $data->cookies);
        $userid = json_decode($userid[1]);
        $userid = $userid->user->pk;
        //print_r($userid);
        
        
        $cekfoll = instagram(1, $data->useragent, 'friendships/' . $userid . '/following/', $data->cookies);
        $cekfoll = json_decode($cekfoll[1]);
        $cekfoll = array_slice($cekfoll->users, 0, $jumlah);
        
        
        
        foreach ($cekfoll as $ids) {
            $cek = instagram(1, $data->useragent, 'friendships/show/' . $ids->pk, $data->cookies);
            $cek = json_decode($cek[1]);
            if ($type == true) {
                if ($cek->followed_by == false) {
                    $unfollow = instagram(1, $data->useragent, 'friendships/destroy/' . $ids->pk . "/", $data->cookies, generateSignature('{"user_id":"' . $ids->pk . '"}'));
                    echo "Success Unfollow @" . $ids->username . "\n";
                } else {
                    echo "Fail Unfollow @" . $ids->username . " Users Follow You";
                }
            } else {
                $unfollow = instagram(1, $data->useragent, 'friendships/destroy/' . $ids->pk . "/", $data->cookies, generateSignature('{"user_id":"' . $ids->pk . '"}'));
                echo "Success Unfollow @" . $ids->username . PHP_EOL;
            }
            sleep($jeda);
        }
        
        
    }
    
}

?>
