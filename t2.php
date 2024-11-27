<?php
echo iconv('UTF-8','TIS-620//ignore',iconv('TIS-620','UTF-8//ignore',"งานบ้าน"));
echo iconv('TIS-620','UTF-8//ignore',iconv('UTF-8','TIS-620//ignore',"งานบ้าน"));
//echo iconv('UTF-8','TIS-620//ignore',"งานบ้าน");
if (extension_loaded('mbstring')) {
    echo 'mbstring enabled';
} else {
    echo 'mbstring disabled';
}

if (!function_exists('mb_convert_encoding')) {
    echo 'mb_convert_encoding function was not found.';
}
?>