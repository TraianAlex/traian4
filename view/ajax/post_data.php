<div class="container page-content">
    <div class="row">
        <form method="post">
            <input type="text" id="text"><br>
            <textarea name="feedback" id="feedback"></textarea><br>
            <?=CSRF::tokenizeInput()?>
            <input type="button" value="Submit" onclick="insert();">
        </form>
        <div id="message"></div>
    </div>
</div>
<script src="<?=SITE_ROOT?>/js/post_data.js"></script>