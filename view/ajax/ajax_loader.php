
<script src="<?=SITE_ROOT?>/inc/js/vendor/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?=SITE_ROOT?>/js/ajax_loader.js"></script>
<script type="text/javascript">
    
    $(document).ready(ajaxLoader('http://localhost/traian3/new-pdo/js/toggle_text', 'contentLYR'));
    $(document).ready(ajaxLoader2('http://localhost/traian3/new-pdo/js/rollover_text', 'content2'));
    
</script>
<!-- ../view/js/removing_nodes.php-->
<!--body onload="ajaxLoader('http://localhost/traian3/new-pdo/js/toggle_text', 'contentLYR')"-->
<div class="container page-content">
    <div class="row">
    <input type="submit" onclick="ajaxLoader2('http://localhost/traian3/new-pdo/js/add_remove_elements', 'content3')">
    </div>
    <div class="row" id="contentLYR"></div>
    <div class="row" id="content2"></div>
    <div class="row" id="content3"></div>
</div>