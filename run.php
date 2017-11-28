<?php
echo "List Tools :\n[1]Unfollow Not Followback Instagram\n[2]Like Timeline Instagram\n[3]Bomb Sms Tri\n[4]\nBomb Sms Tsel\nMasukan Pilihanmu : ";
$pilih = trim(fgets(STDIN));
if($pilih==1){
    $type = "unfoll";
}elseif($pilih==2){
    $type = "liketl";
}elseif($pilih==3){
    $type = "bomb3";
}elseif($pilih==4){
    $type = "bombtsel";
}else{
    echo "Pilihan Tidak ada, silahkan pilih yang ada!\nMasukan Pilihanmu : ";
}

require_once($type.".php");
