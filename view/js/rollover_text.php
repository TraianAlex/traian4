<div class="container page-content">
    <div class="row">

<div id="coment">acesta este un comentariu</div><?php
echo StatusMessage('show status', 'coment', 'status');?>

    </div>
</div><?php

function StatusMessage($text, $id, $status){
   // Plug-in 86: Status Message
   // This plug-in takes some text that will activate a status
   // message when rolled over with the mouse, the ID of an
   // HTML element whose contents should be used for a status
   // message, and the status message to use. It requires these
   // arguments:
   //    $text:   The text to display and activate a status
   //    $id:     The ID of an HTML element
   //    $status: The message to insert in $id

   $target = "getElementById('$id').innerHTML";
   return    "<span onMouseOver=\"PIPHP_temp=$target; " .
             "$target='$status';\" onMouseOut=\"$target=" .
             "PIPHP_temp;\">$text</span>";
}