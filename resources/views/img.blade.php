<?php
    
//    $storyid = htmlentities($_GET['storyid']);
    $fullpath = htmlentities($_GET['imgurl']);
    
//    $fileDir = '/path/to/files/';
//    $fullpath = sprintf("/home/kongdeyu/storyimg/%s",$storyid);
    
//    echo $imgurl;
    $contents = file_get_contents($fullpath);
    
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($fullpath);
    ob_clean();
    header("Content-Type: ".$mime);
    echo $contents;
?>