<div class="container page-content">
    <div class="row">
        
        <?php $texttoshort = "http://rover.ebay.com/rover/1/711-53200-19255-0/1?type=3&campid=5336224516&toolid=10001&customid=tiny-hp&ext=unicycle&satitle=unicycle";?><br>
        Before : <?=$texttoshort?><br><?php
        echo "After: <a href=\"$texttoshort\">" . ShortenText($texttoshort, 60, "/-/-/") . "</a>";?>
    </div>
</div>

<?php

function ShortenText($text, $size, $mark){
   // Plug-in 10: Shorten Text
   // This plug-in takes a string variable containing any
   // text and then shortens it to the length supplied by
   // removing text from the middle.
   // The arguments are:
   //    $text: Text to be modified
   //    $size: New size of the string
   //    $mark: String to mark position of removed text

   $len = strlen($text);
   if ($size >= $len) return $text;

   $a = substr($text, 0, $size / 2 -1);
   $b = substr($text, $len - $size / 2 + 1, $size/ 2 -1);
   return $a . $mark . $b;
}