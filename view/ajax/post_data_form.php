<div class="container page-content">
    <div class="row">
        <?=Errors::show_errors()?>
        <form method="post" action="<?=SITE_ROOT?>/ajax/post_data_form/<?=T?>" class="ajax">
            <div>
                <input type="text" name="name" placeholder="Your name">
            </div>
            <div>
                <input type="email" name="email" placeholder="Your email">
            </div>
            <div>
                <textarea name="message" placeholder="Your message"></textarea>
            </div>
            <div><?=CSRF::tokenize()?>
                <input type="submit" value="Send">
            </div>
        </form>
        <div id="message"></div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="<?=SITE_ROOT?>/js/post_data_form.js"></script>
    </div>
</div>
