<div class="container page-content">
    <div class="row"><?php     
        $texttoshort = "http://rover.ebay.com/rover/1/711-53200-19255-0/1?type=3&campid=5336224516&toolid=10001&customid=tiny-hp&ext=unicycle&satitle=unicycle";?><br>
        <strong>Before : </strong><?=$texttoshort?><br><?php
        echo "<strong>After : </strong><a href=\"$texttoshort\">" . ShortenText($texttoshort, 60, "/-/-/") . "</a><br>";?>
        <strong>Before : </strong><?=$text2 = "Nulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur aliquet quam id dui posuere blandit. Proin eget tortor risus. Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Curabitur aliquet quam id dui posuere blandit. Donec sollicitudin molestie malesuada. Donec rutrum congue leo eget malesuada.<br>";?>
        <strong>After1 : </strong><?=ShortenText($text2, 60, "<a href='#'> ...read... </a>");?>
        <strong>After2 : </strong><?=shorten_text($text2, 60);?>
    </div>
</div>

<?php

function shorten_text($text, $chars = 450)
{
  $text = $text." ";
  $text = substr($text, 0, $chars);
  $text = substr($text, 0, strrpos($text,' '));
  $text = $text."<a href='".SITE_ROOT."/php/shorten_text'> ...go to this link</a>";
  return $text;
}

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