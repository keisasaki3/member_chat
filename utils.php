<?php
function h($str){
    $str = htmlspecialchars($str);
    $pat = '/((http|https):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
    $replace = '<a href="$1" target="_blank">$1</a>';
    $str = preg_replace($pat, $replace, $str);
    return $str;
}
?>