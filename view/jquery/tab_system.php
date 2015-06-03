<style type="text/css">
    .tabs{
        width: 50%;
    }
    .tabs ul{
        list-style-type: none;
        padding-left: 0;
        border-left: 1px solid #ccc;
        overflow: hidden;
        margin: 0;
    }
    .tabs ul li{
        float: left;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-bottom: 0;
        border-left: 0;
    }
    .tabs ul li a{
        text-decoration: none;
        color: black;
        text-transform: uppercase;
    }
    .tabs div{
        float: left;
        padding: 0 10px;
        border: 1px solid #ccc;
    }
    .tabs ul li.selected{
        background: #ccc;
    }
    .tab{
        display: none;
    }
    .tab.one{
        display: block;
    }
</style>
<div class="container page-content">
    <div class="row"><script src="http://www.traian4.embassy-pub.ro/new-pdo/js/breadcrumb.js"></script></div><br>
    <div class="row">
        
        <div class="tabs">
            <ul>
                <li class="selected"><a href="#one">Tennis</a></li>
                <li><a href="#two">Squash</a></li>
                <li><a href="#three">Hockey</a></li>
            </ul>
            <div class="tab one">
                <p>
                    Donec sollicitudin molestie malesuada. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla porttitor accumsan tincidunt. Curabitur aliquet quam id dui posuere blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porttitor accumsan tincidunt. Pellentesque in ipsum id orci porta dapibus. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
                </p>
            </div>
            <div class="tab two">
                <p>
                    Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Curabitur aliquet quam id dui posuere blandit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus. Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Nulla quis lorem ut libero malesuada feugiat. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Nulla porttitor accumsan tincidunt.
                </p>
            </div>
            <div class="tab three">
                <p>
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus suscipit tortor eget felis porttitor volutpat. Donec rutrum congue leo eget malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Sed porttitor lectus nibh.
                </p>
            </div>
        </div>
        
        
        
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $('.tabs > ul li a').on('click', function (){
       var that = $(this),
           tabs = that.parent().parent().parent(),
           target = $.trim(that.attr('href').substring(1)),
           items = tabs.find('ul li');
           
    items.removeClass('selected').find('a[href="#' + target + '"]').parent().addClass('selected');
    tabs.find('.tab').show();
    tabs.find('.tab:not(".' + target + '")').hide();
    });
</script>