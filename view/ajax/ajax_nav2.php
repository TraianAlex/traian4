<script type="text/javascript" src="<?=SITE_ROOT?>/js/ajax_nav2.js"></script>
<script type="text/javascript">
  set_loading_message("Please wait while the page is opening....");
</script>

<div class="container page-content">
    <div class="row">
        <H5>My Navagation links</H5>
        <ul class="nav nav-pills">
            <li role="presentation" class="active">
                <a href="javascript:void(0)" onclick="open_url('http://localhost/traian3/new-pdo/js/delete_confirmation1', 'my_site_content');">delete_confirmation1</a>
            </li>
            <li role="presentation" class="active">
                <a href="javascript:void(0)" onclick="open_url('http://localhost/traian3/new-pdo/js/add_remove_elements', 'my_site_content');">add_remove_elements</a>
            </li>
            <li role="presentation" class="active">
                <a href="javascript:void(0)" onclick="open_url('http://localhost/traian3/new-pdo/js/toggle_text', 'my_site_content');">toggle_text</a></li>
            <li role="presentation" class="active">
                <a href="javascript:void(0)" onclick="open_url('http://localhost/traian3/new-pdo/js/rollover_text', 'my_site_content');">rollover_text</a></li>
            <li role="presentation" class="active">
                <a href="javascript:void(0)" onclick="open_url('xxxx.html', 'my_site_content');">Broken Link</a></li>
        </ul>
    </div>
    <div class="row" id="my_site_content"></div>
</div>
