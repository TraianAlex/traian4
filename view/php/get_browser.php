<div class="container page-content">
    <div class="row">
        <?php
        //$browser = get_browser(null, true);
        //print_r (get_browser($_SERVER['HTTP_USER_AGENT'], true)); echo '<hr>';//same
        //print_r ($browser); echo '<hr>';
        //$browser = strtolower($browser['browser']);
        //echo $browser;
        //if($browser != 'chrome'){
        //    echo "<br>You are not using Google Chrome<hr>";
        //}

	echo "REQUEST_URI: ". $_SERVER['REQUEST_URI'] ."<br />";
	
        $arr1 = explode('/', $_SERVER['REQUEST_URI']);
        echo '<pre>';print_r($arr1);echo '</pre>';
        
        if ($_SERVER['HTTP_HOST'] == 'www.traian4.embassy-pub.ro'){
            if(defined("PATH") && PATH != NULL){
                $clss = $arr1[2];
                $method = $arr1[3];
            }else{
                $clss = $arr1[1];
                $method = $arr1[2];
            }
        }else{
            if(defined("PATH") && PATH != NULL){
                $clss = $arr1[3];
                $method = $arr1[4];
            }else{
                $clss = $arr1[2];
                $method = $arr1[3];
            }
        }
        ?>
    </div>
</div>