<style type="text/css">
    #photos {
        margin-top:20px;
    }
    #photos img { 
        height:140px; 
        margin-right:10px;
        margin-bottom:10px;
    }
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
    $('document').ready(function ()
    {
        $('#photoform').submit(function ()
        {
          //get the value of the search tag
          var keyword = $('#keyword').val();
          //shows the please wait until result is fetched
          $("#photos").html('Please wait..');

          $.getJSON('http://api.flickr.com/services/feeds/photos_public.gne?tags=' + keyword + '&format=json&jsoncallback=?',
                    function (data)
                    {
                        //delete the child elements of #photos 
                        $("#photos").empty();
                        $.each(data.items, function (index, item) {
                            //now append each images to #photos						
                            $("#photos").append('<img src="' + item.media.m + '" />');
                        });
                    }
            );
            //to product from the reloading the page
            return false;
        });
    });
</script>
<div class="container page-content">
    <div class="row">
        <form method="post" name="photoform" id="photoform">
            Keyword : <input type="text" name="keyword" id="keyword" value=""   /> <input name="findphoto" id="findphoto" value="Find" type="submit" /> 
        </form>
        <div id="photos"></div>
    </div>
</div>