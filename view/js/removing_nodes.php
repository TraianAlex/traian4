<script type="text/javascript">
    /* This script and many more are available free online at
     The JavaScript Source!! http://www.javascriptsource.com
     Created by: Brad | http://snippets.dzone.com/posts/show/2598 */
    function removeBElm() {
        var para = document.getElementById("example");
        var boldElm = document.getElementById("example2");
        var removed = para.removeChild(boldElm);
    }

</script>

<br>
<fieldset style="width: 340px;">
    <legend>Remove a section</legend>
    <div id="example">
        <p>Ma quande lingues coalesce, li grammatica del resultant lingue.</p>
        <p id="example2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
    </div>
</fieldset>
<p id="example2"><a href="#" onclick="removeBElm();
        return false;">Click this link</a> to remove the section above.</p>

</div>
</div>
