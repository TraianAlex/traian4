<div class="container page-content">
    <div class="row">
<?php

echo ToggleText(' Site1', 'http://traian.embassy-pub.ro ', ' Site MVC', 'http://traian1.embassy-pub.ro ');

?></div>
</div><?php
/*-----------------------------------------------------------------------------------*/

function ToggleText($text1, $link1, $text2, $link2){
   // Plug-in 85: Toggle Text
   // This plug-in takes two pairs of details each comprising
   // a text and a link. When clicked the link text for each
   // causes the other text and link to be displayed, thus
   // toggling between the two. It returns the JavaScript
   // necessary to insert in your web page to achieve this
   // effect. It requires these arguments:
   //    $text1: The original text to display
   //    $link1: The original link text to display
   //    $text2: The alternative text
   //    $link2: the alternative link text

   $tok  = rand(0, 1000000);
   $out  = "<div id='PIPHP_TT1_$tok' style='display:block;'>" .
           "<a href=\"javascript://\" onClick=\"document." .
           "getElementById('PIPHP_TT1_$tok').style.display=" .
           "'none'; document.getElementById('PIPHP_TT2_$tok')" .
           ".style.display='block';\">$link1</a>$text1</div>\n";

   $out .= "<div id='PIPHP_TT2_$tok' style='display:none;'>" .
           "<a href=\"javascript://\" onClick=\"document." .
           "getElementById('PIPHP_TT1_$tok').style.display=" .
           "'block'; document.getElementById('PIPHP_TT2_$tok')" .
           ".style.display='none';\">$link2</a>$text2</div>\n";
   return  $out;
}