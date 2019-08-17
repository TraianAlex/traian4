<style type="text/css">
    body,html {
        margin:0; /*overwrite default 8px margin*/
    }
    #slide-menu {
        background-color: #191e25;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        max-width: 250px;
        width: 250px;

        -webkit-transition: 0.3s;
        transition: 0.3s;

        -webkit-transform: translate3d(-250px, 0px, 0);
        transform: translate3d(-250px, 0px, 0);

        -webkit-transform: translate(-250px, 0px);
        transform: translate(-250px, 0px);
    }
    #slide-menu.open {
        -webkit-transform: translate3d(0px, 0px, 0);
        transform: translate3d(0px, 0px, 0);

        -webkit-transform: translate(0px, 0px);
        transform: translate(0px, 0px);
    }
    #menu-button {
        position: fixed;
        left: 20px;
        top: 20px;
        background-color: #191e25;
        color: white;
        font-family:verdana;
        cursor: pointer;
        padding:10px;
    }

    #menu-button:before {
        content:"Menu";
    }
    #menu-button.open {
        -webkit-transition: 0.3s;
        transition: 0.3s;

        -webkit-transform: translate3d(250px, 0px, 0);
        transform: translate3d(250px, 0px, 0);

        -webkit-transform: translate(250px, 0px);
        transform: translate(250px, 0px);
      }

    #menu-button.open:before {
        content:"Close";
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<div class="container page-content">
    <div class="row"><script src="<?=SITE_ROOT?>/js/breadcrumb.js"></script></div><br>
    
    <h2>Hardware Accelerated Slide Menu with CSS3</h2>

    <div id="slide-menu">
        
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages</a></li>
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages</a></li>
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages</a></li>
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages</a></li>
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages</a></li>
            <li role="presentation"><a href="#">Profile</a></li>
            <li role="presentation"><a href="#">Messages</a></li>
          </ul>
        
    </div>
    <div id="menu-button"></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    var menuButton = $('#menu-button');
    var menu = $('#slide-menu');

    $(menuButton).click(function() {
      $(menu).toggleClass('open');
      $(this).toggleClass('open');
    });
});    
</script>