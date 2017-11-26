<?php
if(!file_exists("start.txt")){
  $h = fopen($b,"w");
fwrite($h,"0");
fclose($h);
  {
$b = @file_get_contents("start.txt");
for($a=$b;$a<11;$a++){
print $a."Work2";
if($a==10){
sleep(60);
$h = fopen($b,"w");
fwrite($h,"0");
fclose($h);
print"next 1 menit lagi";
}
}
