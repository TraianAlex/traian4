function insert(){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
        }
        xmlhttp.onreadystatechange = function (){
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
             document.getElementById('message').innerHTML = xmlhttp.responseText;
            }
        }
        parameters = 'text=' + encodeURIComponent(document.getElementById('text').value) + '&feedback=' + encodeURIComponent(document.getElementById('feedback').value) + '&v1=' + encodeURIComponent(document.getElementById('v1').value);
        xmlhttp.open("POST", "http://localhost/traian4/new-pdo/ajax/post_data", true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send(parameters);
}