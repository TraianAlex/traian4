<div class="container page-content">
    <div class="row">

        <a href="<?=SITE_ROOT?>/js/wordfromroot/aba">chech an << aba >></a><br><?php
        
$out = "";
$max = 5;
//$_GET['word'] = 'aba';
if (!isset($_GET['id'])) exit;
if (isset($_GET['max'])) $max = $_GET['max'];

if (!isset($_GET['id']))
   exit;

$result = PIPHP_WordsFromRoot($_GET['id'], APP_PATH.'/library/dictionary.txt', $max);
if ($result != FALSE)
   foreach ($result as $word)
      echo "$word<br />";

echo substr($out, 0, -1);

?></div>
</div><?php

function PIPHP_WordsFromRoot($word, $filename, $max){
   // Plug-in 89: Words From Root
   //    $word:       A word to look up
   //    $dictionary: The location of a list of words separated by non-word or space characters such as \n or \r\n

   $dict  = file_get_contents($filename);
   preg_match_all('/\b' . $word . '[\w ]+/', $dict, $matches);
   $c     = min(count($matches[0]), $max);
   $out   = array();
   for ($j = 0 ; $j < $c ; ++$j) $out[$j] = $matches[0][$j];
   return $out;
}