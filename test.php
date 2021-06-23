<?php

$string = 'AbcXUrT';
echo $string.'<br>';
$newStr = '';
for ($i=0; $i < strlen($string); $i++) { 
    if (ctype_upper($string[$i])) {
        $newStr[$i] = strtolower($string[$i]);
    }else{
        $newStr[$i] = strtoupper($string[$i]);
    }
}

echo $newStr;