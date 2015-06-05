<!--script src="<?=SITE_ROOT?>/inc/js/vendor/jquery-1.11.2.min.js"></script-->
  <div class="container page-content">
    <div class="row"><script src="<?=SITE_ROOT?>/js/breadcrumb.js"></script></div><br>
    <div class="row"><?php

$cl = "Class_C";
echo substr($cl, 0, -2);

$name = "image.jpg";
echo "Extension for image.jpg is ". strtolower(substr($name, strpos($name, '.') + 1)).'<br>';

$class = "model/Users";
include("$class.php");
$class = str_replace('/', '', substr($class, strrpos($class, '/')));
echo $class.'<br>';
echo gettype($name),"<br>";
echo gettype(77).'<br>';
echo gettype(77.7).'<br>';
echo gettype(true).'<br>';
echo gettype([]).'<br>';

echo min([3,5,7,8,9]), '<br>';
echo max([3,5,7,8,9]), '<br>';
var_dump(get_url());
var_dump(parse_url($_SERVER['REQUEST_URI']));
$url2 = parse_url($_SERVER['HTTP_REFERER']);
var_dump($url2);
var_dump($_SERVER['REQUEST_URI']);
var_dump(parse_url($_SERVER['REQUEST_URI'])['path']);
?>
<script type="text/javascript">
    document.write('Location(js): ' + window.location + '<br>');
    document.write('Referrer(js): ' + document.referrer + '<br>');
</script><hr><?php
        
        echo time()."<br />";
        echo mktime(2, 30, 45, 10, 1, 2009)."<br />";
        // checkdate()
        echo checkdate(12,31,2000) ? 'true' : 'false';
        echo "<br />";
        echo checkdate(2,31,2000) ? 'true' : 'false';
        echo "<br />";

        $unix_timestamp = strtotime("last Monday");
        echo $unix_timestamp . "<br />";

        $timestamp = time();
        echo strftime("The date today is %m/%d/%y", $timestamp)."<br />";

        function strip_zeros_from_date($marked_string="") {
                // remove the marked zeros
                $no_zeros = str_replace('*0', '', $marked_string);
                // then remove any remaining marks
                $cleaned_string = str_replace('*', '', $no_zeros);
                return $cleaned_string;
        }

        echo strip_zeros_from_date(strftime("The date today is *%m/*%d/%y", $timestamp))."<br />";

        $dt = time();
        $mysql_datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);
        echo $mysql_datetime, '<hr>';
                
//$classes = get_declared_classes();
//foreach($classes as $class) {
//	echo $class ."<br />";
//}
echo '<br>';
foreach (ob_list_handlers() as $list){
    echo $list, '<br>';
}

echo strpos(strtoupper(PHP_OS),'WIN');

echo '<hr>';
$a = 'a';
$b = 'dddb';
$c = 'sdfsdfsd';
/*
 * return all results true if a false. if a true result b and c
 */
echo 'ternar using ? : ? : ? : <br>';
$a === 'a' ? print 'a -> a/ ' : $b === 'b' ? print 'b ->b/ ' : $c === 'c' ? print 'c -> c' : print 'a != a and b!= b and $c !=c';//a -> a/ b ->b/ c -> c  no
echo '<br>';

echo 'ternar using (? :) ? : ? :<br>';
($a === 'a' ? print 'a -> a/ ' : $b === 'b/ ') ? print 'b -> b/ ' : $c === 'c' ? print 'c -> c' : print 'a != a and b!= b and $c != c';//a -> a/ b -> b/ c -> c no
echo '<br>';

//return if a true all false 
echo 'ternar using ((? :) ? :) ? :<br>';
(($a === 'a' ? print 'a -> a/ ' : $b === 'b/ ') ? print 'b -> b/ ' : $c === 'c') ? print 'c -> c' : print 'a != a and b!= b and $c != c';//a -> a/ b -> b/ c -> c
echo '<br>';

echo 'ternar using ? (: ? : ? :)<br>';
$a === 'a' ? print 'a -> a/ ' : ($b === 'b/ ' ? print 'b -> b/ ' : $c === 'c' ? print 'c -> c' : print 'a != a and b!= b and $c != c');//a -> a/ no for b=b
echo '<br>';

echo 'ternar using ? (: ? (: ? :))<br>';
$a === 'a' ? print 'a -> a/ ' : ($b === 'b/ ' ? print 'b -> b/ ' : ($c === 'c' ? print 'c -> c' : print 'a != a and b!= b and $c != c'));//a -> a/ no for b=b
echo '<br>';

/*-----------------------------------------------------------------------------------------------------------*/
echo 'ternar using ? : ? : <br>';
$a === 'a' ? print 'a -> a/ ' : $b === 'b' ? print 'b -> b/ ' : print 'a != a and b!= b and $c != c';//a -> a/ b -> b/ no

/*----------------------------------------------------------------------------------------------------------------*/
echo '<hr>';

echo 'ex: ? : ? :<br>';
$d = 3 * 3 % 5; // (3 * 3) % 5 = 4
echo $d == true ? 0 : true ? 1 : 2; // (true ? 0 : true) ? 1 : 2 = 2
echo '<hr>';

//return only first stmt and stop
echo 'ternar using ((? :) || (? :) || (? :)<br>';
$x = (($a === 'a' ? print 'a -> a ' : print 'a != a/ ') ||
      ($b === 'b' ? print 'b -> b/ ' : print 'b != b/ ') ||
      ($c === 'c' ? print 'c -> c' : print '$c != c'));
var_dump($x);//a -> a 
echo '<br>';

//return all results true and false
echo 'ternar using (? :) && (? :) && (? :)<br>';
$x = (($a === 'a' ? print 'a -> a/ ' : print 'a != a/ ') &&
      ($b === 'b' ? print 'b -> b/ ' : print 'b != b/ ') &&
      ($c === 'c' ? print 'c -> c' : print '$c != c'));
var_dump($x);//a -> a/ b != b/ $c != c

//return corect stmt like next ex and int 1
echo 'ternar using ? : && ? : && ? :<br>';
$x = ($a === 'a' ? print 'a -> a/ ' : print 'a != a/ ' &&
      $b === 'b' ? print 'b -> b/ ' : print 'b != b/ ' &&
      $c === 'c' ? print 'c -> c' : print '$c != c');
var_dump($x);//a -> a/ 
echo $x;
echo '<br>';

/*-------------------------------------------------------------------------------------*/

$e = 4;
$f = 5;
$g = 6;
$h = false;

echo 'Expression expr1 ?: expr3 returns expr1 if expr1 evaluates to TRUE, and expr3 otherwise.<br>';
var_dump($h ?: print 'exp3'); echo '<br>';

 echo (true ? 'true' : false ? 't' : 'f'); echo '<br>';//t
echo ((true ? 'true' : false) ? 't' : 'f'); echo '<br>';//t
echo $h === true ? 'true' : ($h === false ? 't' : 'f'); echo '<br>';//t

echo "\n\n######----------- trinary operator associativity\n\n";

function trinaryTest($foo){

    $bar    = $foo > 20
            ? "greater than 20"
            : $foo > 10
                ? "greater than 10"
                : $foo > 5
                    ? "greater than 5"
                    : "not worthy of consideration";   
    echo $foo." =>  ".$bar."<br>";
}

echo "----trinaryTest<br>";
trinaryTest(21);
trinaryTest(11);
trinaryTest(6);
trinaryTest(4);

function trinaryTestParens($foo){
   
    $bar    = $foo > 20
            ? "greater than 20"
            : ($foo > 10
                ? "greater than 10"
                : ($foo > 5
                    ? "greater than 5"
                    : "not worthy of consideration"));   
    echo $foo." =>  ".$bar."<br>";
}

echo "----trinaryTestParens<br>";
trinaryTestParens(21);
trinaryTestParens(11);
trinaryTest(6);
trinaryTestParens(4);

(isset($foo) && $foo) ? $foo : '';

//returning the first non-false value within a group of expressions.
echo 0 ?: 1 ?: 2 ?: 3; //1
echo 1 ?: 0 ?: 3 ?: 2; //1
echo 2 ?: 1 ?: 0 ?: 3; //2
echo 3 ?: 2 ?: 1 ?: 0; //3

echo 0 ?: 1 ?: 2 ?: 3; //1
echo 0 ?: 0 ?: 2 ?: 3; //2
echo 0 ?: 0 ?: 0 ?: 3; //3
echo '<br>';

print '<div>'.(FALSE) ? 'TRUE [bad ternary]' : 'FALSE [bad ternary]';
print '<br>';
print '<div>'.((FALSE) ? 'TRUE [good ternary]' : 'FALSE [good ternary]'); echo '<br>';

$status = "1";
$var = '<option value="1" '.($status == "1" ? 'selected="selected"' :'').'>Value 1</option>';
echo $var;

$username = 'eu';
$guestusername = 'el';
echo 'Hello, ' . isset($i) ? 'my friend: ' . $username . ', how are you doing?' : 'my guest, ' . $guestusername . ', please register';
echo 'Hello, ' . (isset($i) ? 'my friend: ' . $username . ', how are you doing?' : 'my guest, ' . $guestusername . ', please register');//for general rule, if you mix ?: with other sentences, always close it with parentheses.

$index=1;
$tally = array();
$tally[$index] = 1+(isset($tally[$index])?$tally[$index]:0); echo '<br>';
print_r($tally);

$test=true;
$test2=true;
$st = ($test) ? "TEST1 true" :  ($test2) ? "TEST2 true" : "false";
echo $st, "<br>";//TEST2 true
$st2 = ($test) ? "TEST1 true" : (($test2) ? "TEST2 true" : "false");
echo $st2, "<br>";//TEST1 true

$z = 2;
$text = ($z===1 ? 'ONE'
  : ($z===2 ? 'TWO'
  : ($z===3 ? 'THREE'
  : 'MORE' )));
echo($text); // RESULT='TWO'
// LONGHAND
$text = ($z===1 ? 'ONE' : ($z===2 ? 'TWO' : ($z===3 ? 'THREE' : 'MORE')));
echo($text); // RESULT='TWO' 

$z = 1;
$text = ($z===1 ? 'FIRST : OUTTER'
  : ($z===1 ? 'SECOND : INNER'
  : ($z===1 ? 'THIRD : LAST'
  : 'FAIL EVAL DEFAULT' ))); echo '<br>';
echo($text); // RETURN='FIRST : OUTTER'

$z = 2;
$text = ($z===1 ? 'FIRST : OUTTER'
  : ($z===1 ? 'SECOND : INNER'
  : ($z===1 ? 'THIRD : LAST'
  : 'FAIL EVAL DEFAULT' )));
echo($text); // RETURN='FAIL EVAL DEFAULT'
//(IF ? THEN : ELSE)
//(IF ? THEN : ELSE(IF ? THEN : ELSE(IF ? THEN : ELSE))
$gender = null;
?><form>
<input type='radio' name='gender' value='m' <?=($gender=='m')?"checked":""?>>Male
<input type='radio' name='gender' value='f' <?=($gender=='f')?"checked":""?>>Female
</form><?php

/*------------------------------------------------------------------------------------*/

const CONSTANT = 'Hello World';
echo CONSTANT, "<br>";
// Works as of PHP 5.6.0
//const ANOTHER_CONST = CONSTANT.' Goodbye World';
//echo ANOTHER_CONST;

//const ANIMALS = ['dog', 'cat', 'bird'];
//echo ANIMALS[1]; // outputs "cat"

//const CONFIG = ['index', 'login', 'register', 'log_out', 'forgot_password', 'send_pass'];
//if(in_array('login', CONFIG)) echo "<br>yes<br>";

$color = "red";
//const RED = "This is the color $color"; //Doesn't work
define(strtoupper($color), "This is the color $color"); // Works fine
        
/**
* Path to the root of the application
*/
define("PATH_ROOT", dirname(__FILE__));
//echo PATH_ROOT, "<br>";
//echo APP_PATH, "<br>";
//echo SITE_ROOT, "<br>";
//echo dirname(__DIR__), "<br>";
//echo $_SERVER['DOCUMENT_ROOT'], "<br>";
//echo 'http://'.$_SERVER['HTTP_HOST'].str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', dirname(__DIR__))), "<br>";
/**
* Path to configuration files
*/
//const PATH_CONFIG = PATH_ROOT . "/config";
//echo PATH_CONFIG, "<br>";
/**
* Path to configuration files - DEPRECATED, use PATH_CONFIG
*/
//const PATH_CONF = PATH_CONFIG;
//echo PATH_CONF, "<br>";

goto a;
echo 'Foo';
 
a:
echo 'Bar'; echo '<br>';

for($i=0,$j=50; $i<100; $i++) {
  while($j--) {
    if($j==17) goto end; 
  }  
}
echo "i = $i";
end:
echo 'j hit 17'; echo '<br>';

$headers = Array('subject', 'bcc', 'to', 'cc', 'date', 'sender');
$position = 0;

hIterator: {
    $c = 0;
    echo $headers[$position] . PHP_EOL;

    cIterator: {
        echo ' ' . $headers[$position][$c] . PHP_EOL;

        if(!isset($headers[$position][++$c])) {
            goto cIteratorExit;
        }
        goto cIterator;
    }

    cIteratorExit: {
        if(isset($headers[++$position])) {
            goto hIterator;
        }
    }
}
    ?></div>
  </div>
