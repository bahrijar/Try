<?php
$b = @file_get_contents("start.txt");
for($a=$b;$a<11;$a++){
print $a."Work2";
if($a==10 OR !file_exists("start.txt")){
sleep(60);
$h = fopen($b,"w");
fwrite($h,"0");
fclose($h);
print"next 1 menit lagi";
}
}
