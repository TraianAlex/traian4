<div class="container page-content">
    <div class="row">
<?php

//$_POST['uname'] = 'alex';
$value = '';

if (isset($_POST['uname'])){
   $value = $_POST['uname'];
   echo "You submitted the value '$value'<br />";
}

$self = $_SERVER['PHP_SELF'];
echo    "<br /><form method='post' action='$self'>\n";
echo    "Username: " . InputPrompt(
        "name='uname' type='text' size='50' value='$value'",
        'Required Field: Please enter your Username here');
echo    "<input type='submit'></form>\n";

?></div>
</div><?php

function InputPrompt($params, $prompt){
   // Plug-in 88: Input Prompt
   // This plug-in returns the HTML and JavaScript required
   // to add a prompt to an input field which is only displayed
   // when that field has an empty value. It requires these
   // arguments:
   //    $params: Parameters to control the input such as
   //             name=, type=, rows=, cols=, name=, size=
   //             value=, and so on
   //    $prompt: The prompt text to display

   $id = 'PIPHP_IP_' . rand(0, 1000000);

   $out = <<<_END
<input id='$id' $params
   onFocus="PIPHP_JS_IP1('$id', '$prompt')"
   onBlur="PIPHP_JS_IP2('$id', '$prompt')" />
_END;

   static $PIPHP_IP_NUM;
   if ($PIPHP_IP_NUM++ == 0) $out .= <<<_END
<script>
PIPHP_JS_IP2('$id', '$prompt')

function PIPHP_JS_IP1(id, prompt)
{
   if ($(id).value == prompt) $(id).value = ""
}

function PIPHP_JS_IP2(id, prompt)
{
   if ($(id).value == "") $(id).value = prompt
}

function $(id)
{
   return document.getElementById(id)
}
</script>
_END;
   return $out;
}
