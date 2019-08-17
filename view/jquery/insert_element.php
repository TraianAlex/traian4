<script type="text/javascript" src="<?=SITE_ROOT?>/js/jquery-1.7.1.min.js"></script>
<div class="container page-content">
    <div class="row"><script src="<?=SITE_ROOT?>/js/breadcrumb.js"></script></div><br>
    <div class="row"><!-- javascript variant-->
        <script type="text/javascript">
          (function(){
              var div = document.createElement('div');
              document.body.appendChild(div);
          }());
        </script>
        <br>
        <script type="text/javascript">
          (function(){
              var p = document.createElement('p');
              txt = document.createTextNode('This is the text in new element with javascript.');
              
              p.appendChild(txt);
              document.body.appendChild(p);
          }());
        </script>
        <br>
        <script type="text/javascript">
          (function(){
              $('body').append('<p>This is the text in new element with jquery.<p>');
          }());
        </script>
        
<script type="text/javascript">
            function creeazaDiv(id){
                var dv = document.createElement('div');
                dv.setAttribute('id', id);
                dv.innerHTML="<div id=\""+id+"\">testDiv "+id+"</div>";
                dv.onmouseover = function () {
                    this.style.cursor = 'pointer';
                    this.style.color = 'red';
                }
                dv.onmouseout = function () {
                    this.style.color = 'black';
                }
                dv.onclick = function () {
                    alert("click pe obiect");
                }
                document.body.appendChild(dv);
            }
        </script>
<script>
    for(i=0;i<20;i++)
        creeazaDiv(i); 
</script>
    </div>
</div>