<div class="container page-content">
    <div class="row">
        <?php

    if(isset($_POST['url']) == true && empty($_POST['url']) == false){
        $url = trim($_POST['url']);
        if(filter_var($url, FILTER_VALIDATE_URL) == true){
            echo 'Valid';
        }else{
            echo 'Invalid URL';
        }
    }
    Errors::show_errors();?>
        <form action="" method="post">
            Up, or Down? <input type="text" name="url">
            <input type="submit">
        </form> 
        
    </div>
</div><?php

function upordown($url){
    
    $cs = curl_init($url);
    curl_setopt($cs, CURLOPT_NOBODY, true);
    curl_setopt($cs, CURLOPT_FOLLOWLOCATION, true);
    curl_exec($cs);
    $status_code = curl_getinfo($cs, CURLINFO_HTTP_CODE);
    return ($status_code == 200) ? true : false;
}

