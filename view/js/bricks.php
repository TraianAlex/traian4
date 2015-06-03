<script>
var posX=0;
var posY=20;
var xNegative=false;
var yNegative=false;
var time=0;
var caramizi=new Array();
var active=true;
function MainLoop()
 {
  if(!active)
  return;
  time++;
  frameRender();
  setTimeout("MainLoop()",10);
 }
function placaNimerita()
 {
  yNegative=true;
 } 
function caramidaNimerita(caramida)
 { 
  yNegative=false;
  cadru.removeChild(caramida);
  caramizi.splice(caramizi.indexOf(caramida),1);
 }
function sfarsitulJocului()
 {
  if(confirm("Jocul s-a terminat. Mai jucati o data?"))
  { 
   posX=0;
   posY=20;
   xNegative=false;
   yNegative=false;
   time=0;
   umpleCaramizile();
  }
  else
   active=false;
 }
function umpleCaramizile()
 {
  var pozitiaCaramiziiX=40;
  var pozitiaCaramiziiY=0;
  for(var i=0;i<10;i++)
   {
    if(i%5==0)
     {
      pozitiaCaramiziiY+=10;
      pozitiaCaramiziiX=30;
     }
    var caramida = document.createElement("div");
    caramida.style.border="1px black solid";
    caramida.style.width="30px";
    caramida.style.height="10px";
    caramida.style.position="absolute";
            caramida.style.top = pozitiaCaramiziiY + "px";
            caramida.style.left = pozitiaCaramiziiX + "px";
            pozitiaCaramiziiX += 30;
            cadru.appendChild(caramida);
            caramizi.push(caramida);
        }
    }
    function verificareColiziuniiCaramizilor(caramizi, obiect)
    {
        for (var i = 0; i < caramizi.length; i++)
        {
            //console.debug(caramizi[i]);
            if (
                    parseInt(caramizi[i].style.top) + parseInt(caramizi[i].style.height) > parseInt(obiect.style.top) &&
                    parseInt(caramizi[i].style.left) + parseInt(caramizi[i].style.width) > parseInt(obiect.style.left) &&
                    parseInt(caramizi[i].style.left) < parseInt(obiect.style.left) + parseInt(obiect.style.width) &&
                    parseInt(caramizi[i].style.top) < parseInt(obiect.style.top) + parseInt(obiect.style.height)
                    )
            {
                caramidaNimerita(caramizi[i]);
            }
        }
    }
    function verificareaColiziunii(obiect1, obiect2, cbFunc)
    {
        if (
                parseInt(obiect1.style.top) + parseInt(obiect1.style.height) > parseInt(obiect2.style.top) &&
                parseInt(obiect1.style.left) + parseInt(obiect1.style.width) > parseInt(obiect2.style.left) &&
                parseInt(obiect1.style.left) < parseInt(obiect2.style.left) + parseInt(obiect2.style.width) &&
                parseInt(obiect1.style.top) < parseInt(obiect2.style.top) + parseInt(obiect2.style.height)
                )
            cbFunc();
    }
    function frameRender()
    {
        if (caramizi.length < 1)
            sfarsitulJocului();
        verificareaColiziunii(iesire, placa, placaNimerita);

        verificareColiziuniiCaramizilor(caramizi, iesire);
        if (parseInt(iesire.style.left) >= (parseInt(iesire.parentNode.style.width) - parseInt(iesire.style.width)) - 1)
            xNegative = true;
        if (parseInt(iesire.style.top) >= (parseInt(iesire.parentNode.style.height) - parseInt(iesire.style.height)) - 1)
            sfarsitulJocului();
        if (parseInt(iesire.style.left) <= 0)
            xNegative = false;
        if (parseInt(iesire.style.top) <= 0)
            yNegative = false;
        if (!xNegative)
            posX++;
        else
            posX--;
        if (!yNegative)
            posY++;
        else
            posY--;
        iesire.style.left = posX + "px";
        iesire.style.top = posY + "px";
    }
    window.onkeydown = function (e)
    {
        if (e.keyCode == 37)
        {
            if (parseInt(placa.style.left) > 0)
                placa.style.left = (parseInt(placa.style.left) - 10) + "px";
        }
        if (e.keyCode == 39)
        {
            if (parseInt(placa.style.left) < (parseInt(cadru.style.width) - parseInt(placa.style.width)) - 1)
                placa.style.left = (parseInt(placa.style.left) + 10) + "px";
        }
    }
    var iesire = document.createElement("div");
    iesire.id = 'iesire';
    iesire.style.width = "20px";
    iesire.style.height = "20px";
    iesire.style.position = "absolute";
    iesire.style.border = "1px black solid";
    var cadru = document.createElement("div");
    cadru.style.border = "1px black solid";
    cadru.style.backgroundColor = "white";
    cadru.style.width = "200px";
    cadru.style.height = "200px";
    cadru.style.top = "0px";
    cadru.style.position = "relative";/*absolute*/
    var placa = document.createElement("div");
    placa.style.border = "1px black solid";
    placa.style.width = "30px";
    placa.style.height = "10px";
    placa.style.position = "absolute";
    placa.style.top = (parseInt(cadru.style.height) - parseInt(placa.style.height)) - 1 + "px";
    placa.style.left = 0 + "px";
    document.body.appendChild(cadru);
    umpleCaramizile();
    cadru.appendChild(iesire);
    cadru.appendChild(placa);
    MainLoop();
</script>

    </div>
</div>