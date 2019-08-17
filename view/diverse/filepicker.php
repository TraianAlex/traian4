<script type="text/javascript" src="//api.filepicker.io/v1/filepicker.js"></script>
<div class="container page-content">
    <div class="row">
        <input type="filepicker" data-fp-apikey="AyyiS1HHRsGNWZkatyueQz" data-fp-mimetypes="*/*" data-fp-container="modal" onchange="alert(event.fpfile.url)">

        <script type="text/javascript">
            filepicker.setKey("AyyiS1HHRsGNWZkatyueQz")
                function pickMe(){
                    filepicker.pickAndStore(
                      {
                        mimetypes: ['image/*', 'text/plain'],
                        container: 'modal',
                        services:['COMPUTER', 'FACEBOOK', 'GMAIL'],
                      },
                      {
                        location:"S3"
                      },
                      function(Blob){
                        document.getElementById("instagram").src = Blob[0].url
                      },
                      function(FPError){
                        console.log(FPError.toString());
                      }
                    );
                }
        </script>

        or <button onClick="pickMe()">Load an image</button>
        <a href="https://www.filepicker.com/demos/" target="_blank">Demo</a>
    </div>
    <div class="row">
        <div id="box">
            <img id="instagram" src="" width="512" height="512" />
        </div>
        
            <img src="https://www.filepicker.io/api/file/ElMLDnuBQPyJrSat2qlA" />
    </div>
</div>