<?php

for($a=0;$a<18662400000;$a++){
print $a."Work2\n";
if($a%10==0){
print "next 1 menit lagi\n";
  sleep(60);
}
}
