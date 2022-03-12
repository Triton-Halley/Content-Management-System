<?php



function writelog($txt)
{
    $filename_log = "log.txt";
    // if ($txt != null) {
    //     $txt['cat_id'] = $txt['cat_id'] + 1;
    // } else {
    //     $txt = "null";
    // }

    $handel = fopen($filename_log, 'w');
    if ($handel) {
        fwrite($handel, $txt);
    }
    fclose($handel);
}
