<div class="container page-content">
    <div class="row"><?php

if(isset($_POST['submit']) && $_POST['submit'] == 'Check'){
    $word_get = filter_input(INPUT_POST, 'word', FILTER_SANITIZE_STRING);
    $output = array(); var_dump($arrData);exit;
    if($arrData['exist'] == false){        //var_dump($arrData['exist']);exit;
        if(isset($arrData['words'])){
            foreach ($arrData['words'] as $word){
                similar_text($word_get, $word['word'], $percent);
                if($percent > 79){//82
                    $output[] = $word['word'];
                }
            }
        }else{
            echo "<p>$word_get spelled correctly, or no suggestions founds.</p>";
        }
    }else if($arrData['exist'] == true){var_dump($arrData['exist']);}
//    if(empty($output)){
//            echo "<p>$word_get spelled correctly, or no suggestions founds.</p>";
//    }else{
//            echo '<pre>', print_r($output), '</pre>';
//    }
}
//    if(isset($_POST['word']) && trim($_POST['word']) !== null){
//        $word = $_POST['word'];
//        $spellcheck = spellcheck($word);
//        if($spellcheck !== false){
//            echo '<pre>', print_r($spellcheck, true), '</pre>';
//        }else if($spellcheck == false){
//            echo "<p>$word spelled correctly, or no suggestions founds.</p>";
//        }
//    }
    
        ?><form action="<?=SITE_ROOT?>/php/spellcheck" method="post">
            Check single word spelling:
            <input type="text" name="word">
            <input type="submit" name="submit" value="Check">
        </form>
        
    </div>
</div>

<?php

        function spellcheck($word) {
            //@mysql_connect('localhost', 'remb4372_victor', 'naiart92');
            //@mysql_select_db('remb4372_traian');
            $objDb = new PDO('mysql:host=localhost;dbname=remb4372_traian', 'remb4372_victor', 'naiart92');
            $output = array();
            //$word = mysql_real_escape_string($word);
            $wordc = strip_tags($word);
            //$word_exist = mysql_query("SELECT COUNT(`word`) FROM `dictionary` WHERE word = '$word'");
            //$words = mysql_query("SELECT `word` FROM `dictionary' WHERE SUBSTRING(`word`, 1, 1) = '".substr($word, 0, 1)."'");
            //$word_exist = $objDb->query("SELECT COUNT(`word`) FROM `dictionary` WHERE word = '$word'");
            $obj_stmt = $objDb->prepare("SELECT word FROM dictionary WHERE word = $wordc");
            $obj_stmt->execute();
            $obj_stmt->fetchAll(PDO::FETCH_ASSOC);
            if($obj_stmt->rowCount() === 0){
                $word_sub = substr($wordc, 0, 1);
                $stmt = $objDb->prepare("SELECT word FROM dictionary WHERE SUBSTRING(word, 1, 1) = '$word_sub'");
                $stmt->execute();
                //if(mysql_result($word_exist, 0) == 0){
                    //while ($words_row = mysql_fetch_assoc($words) !== false) {
                    while ($words_row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        similar_text($word, $words_row['word'], $percent);
                        if($percent > 79){
                            $output[] = $words_row['word'];
                        }
                    }
                }
            return (empty($output)) ? false : $output;
        }