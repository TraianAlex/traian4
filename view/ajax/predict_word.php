<script type="text/javascript">
    function findmatch(){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function (){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
             document.getElementById('results').innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "http://localhost/traian4/new-pdo/ajax/extract_data_get/" + document.search.search_text.value, true);
        xmlhttp.send();/*"http://localhost/traian4/new-pdo/index.php?class=ajax&page=library&search_text=" + document.search.search_text.value*/
    }
</script>
<div class="container page-content">
    <div class="row">
        <form id="search" name="search">
            Type a name:<br>
            <input type="text" name="search_text" onkeyup="findmatch();">
        </form>
    </div>
    <div class="row" id="results"></div>

<!---------------------------------------------------------------------------->

<link type="text/css" rel="stylesheet" href="<?=SITE_ROOT?>/css/screen.css" />

<br>
<div class="row">
    <form method="post">
        <input type="text" class="autosuggest">
        <input type="submit" value="Search">
    </form>
    <div class="dropdown2">
        <ul class="result"></ul>

    </div>
</div>
</div>
<script type="text/javascript" src="<?=SITE_ROOT?>/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?=SITE_ROOT?>/js/autosuggest.js"></script>