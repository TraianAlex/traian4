<div class="container page-content">
    <div class="row"><?php
    
        $adr = str_replace( $_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']);
    	echo $adr, '<br>'; 
    	echo 'SERVER_DOCUMENT_ROOT: ' .$_SERVER['DOCUMENT_ROOT']. '<br>';
    	echo 'SITE_ROOT:' .SITE_ROOT. '<br>';
    	echo 'SERVER_SCRIPT_FILENAME: ' .$_SERVER['SCRIPT_FILENAME'], '<br>';
        echo URL::xdelete('admins', 'test', '');
        
echo getenv('path')."<br>";
echo getenv('DOCUMENT_ROOT')."<br>";

function getIPfromXForwarded() {
    $ipString = $_SERVER["REMOTE_ADDR"];//@getenv("HTTP_X_FORWARDED_FOR")//func 'getenv' doesn't work if your Server API is ASAPI (IIS)
    $addr = explode(",", $ipString);
    return $addr[sizeof($addr) - 1];
}
echo trim(getIPfromXForwarded())."<br>";

$get_name = getenv('PATH_INFO');
$get_name = str_replace(' ', '_', str_replace('/', '', $get_name));
print_r($get_name);
echo getenv('PATH_INFO');

        
echo getPageFanCount($page = 'traianvic');
               
function getPageFanCount($page) {
    $pageData = @file_get_contents('https://graph.facebook.com/'.$page);
    if ($pageData) { // if valid json object
        $pageData = json_decode($pageData); // decode json object
        if (isset($pageData->likes)) { // get likes from the json object
            return $pageData->likes;
        }
        return "Id: " . $pageData->id . "<br>".
              "First name: " . $pageData->first_name . "<br>".
              /*"Gender: " . $pageData->gender . "<br>".*/
              "Last_name: " . $pageData->last_name . "<br>".
              /*"Locale: " . $pageData->locale . "<br>".*/
              "Name:" . $pageData->name . "<br>";
              /*"Username: " . $pageData->username;*/
    } else {
        echo 'page is not a valid FB Page';
    }
}
//The HTTP_X_REQUESTED_WITH header is sent by all recent browsers that support AJAX requests.
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){
     // something
}?><hr><?php
echo "Server details:<br />";
	echo "SERVER_NAME: ". $_SERVER['SERVER_NAME'] ."<br />";
	echo "SERVER_ADDR: ". $_SERVER['SERVER_ADDR'] ."<br />";
	echo "SERVER_PORT: ". $_SERVER['SERVER_PORT'] ."<br />";
	echo "DOCUMENT_ROOT: ". $_SERVER['DOCUMENT_ROOT'] ."<br />";
	echo "<br />";
	
	echo "Page details:<br />";
	echo "PHP_SELF: ". $_SERVER['PHP_SELF'] ."<br />";
	echo "SCRIPT_FILENAME: ". $_SERVER['SCRIPT_FILENAME'] ."<br />";
	echo "<br />";
	
	echo "Request details:<br />";
	echo "REMOTE_ADDR: ". $_SERVER['REMOTE_ADDR'] ."<br />";
	echo "REMOTE_PORT: ". $_SERVER['REMOTE_PORT'] ."<br />";
	echo "REQUEST_URI: ". $_SERVER['REQUEST_URI'] ."<br />";//////////////
	echo "QUERY_STRING: ". $_SERVER['QUERY_STRING'] ."<br />";
	echo "REQUEST_METHOD: ". $_SERVER['REQUEST_METHOD'] ."<br />";
	echo "REQUEST_TIME: ". $_SERVER['REQUEST_TIME'] ."<br />";
	echo "HTTP_REFERER: ". $_SERVER['HTTP_REFERER'] ."<br />";
	echo "HTTP_USER_AGENT: ". $_SERVER['HTTP_USER_AGENT'] ."<br /><hr>";?>
    </div>
</div>