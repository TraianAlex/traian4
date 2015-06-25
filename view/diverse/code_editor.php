<style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Lato:300,400,700|PT+Mono);
    body {
        background: LightCoral;
        font-family: Lato, sans-serif;
        font-size: 15px;
        margin: 0;
    }
    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }
    *:focus {
        outline: none;
    }
    a {
        text-decoration: none;
        color: inherit;
    }
    main {
        min-height: 100vh;
        display: flex;
        display: -webkit-flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-flex-direction: column;
        flex-direction: column;
    }
    .title {
        color: #fff;
        text-align: center;
        font-weight: 300;
        text-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
        font-size: 2.8em;
        margin-top: 1.5em;
    }
    .title small {
        display: block;
        font-size: 0.6em;
        margin-top: 0.4em;
    }
    .credits {
        color: #fff;
        text-shadow: 0 1px 0 rgba(0, 0, 0, 0.2);
        margin-top: 2em;
        font-size: 0.8em;
        opacity: 0.5;
    }
    .window {
        width: 547px;
        background: GhostWhite;
        border-radius: 0.3rem;
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .window .window-header {
        height: 37px;
        background: Gainsboro;
        position: relative;
    }
    .window .window-header .action-buttons {
        position: absolute;
        top: 50%;
        left: 10px;
        margin-top: -5px;
        width: 10px;
        height: 10px;
        background: Crimson;
        border-radius: 50%;
        box-shadow: 15px 0 0 Orange,
            30px 0 0 LimeGreen;
    }
    .window .window-header .language {
        display: inline-block;
        position: absolute;
        right: 10px;
        top: 50%;
        margin-top: -10px;
        height: 21px;
        padding: 0 1em;
        text-align: right;
        -webkit-appearance: none;
        appearance: none;
        border: none;
        background: transparent;
        font-family: Lato, sans-serif;
        color: DimGrey;
    }
    .window .window-header .language:before {
        content: 'asd';
    }
    .window .window-header .language:hover {
        background: rgba(0, 0, 0, 0.1);
    }
    .window .window-body {
        position: relative;
        height: 300px;
    }
    .window .window-body .code-input,
    .window .window-body .code-output {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        padding: 1rem;
        border: none;
        font-family: 'PT Mono', monospace;
        font-size: 0.8rem;
        background: transparent;
        white-space: pre-wrap;
        line-height: 1.5em;
        word-wrap: break-word;
    }
    .window .window-body .code-input {
        opacity: 0.7;
        margin: 0;
        color: #999;
        resize: none;
    }
    .window .window-body .code-output {
        pointer-events: none;
        z-index: 3;
        margin: 0;
        overflow-y: auto;
    }
    .window .window-body .code-output code {
        position: absolute;
        top: 0;
        left: 0;
        margin: 0;
        padding: 1rem;
        display: block;
        color: #666;
        font-size: 0.8rem;
        font-family: 'PT Mono', monospace;
    }
    a.token {
        text-decoration: none;
    }
    .token.selector,
    .token.punctuation,
    .token.keyword {
        color: PaleVioletRed;
    }
    .token.property,
    .token.number,
    .token.string,
    .token.punctuation,
    .token.tag-id {
        color: DodgerBlue;
    }
    .token.function,
    .token.attr-name {
        color: CadetBlue;
    }
    .token.atrule .atrule-id {
        color: BlueViolet;
    }
    .token.boolean {
        color: LightSlateGray;
    }
    .token.comment {
        color: DarkGrey;
    }
    .language-php .variable {
        color: CadetBlue;
    }
</style>
<script type="text/javascript">
    ;
    var MicroCode = (function () {
        return {
            init: function (inputSel, outputSel, languageSel) {
                this.focusInput(inputSel);
                this.listenForInput(inputSel);
                this.listenForLanguage(languageSel, '.code-output', inputSel);
                this.renderOutput(outputSel, $(inputSel)[0].value);
                this.listenerForScroll(inputSel, outputSel);
            },
            listenForInput: function (inputSel) {
                var self = this;

                $(inputSel).on('input keydown', function (key) {
                    var input = this,
                            selStartPos = input.selectionStart,
                            inputVal = input.value;

                    if (key.keyCode === 9) {
                        input.value = inputVal.substring(0, selStartPos) + "    " + inputVal.substring(selStartPos, input.value.length);
                        input.selectionStart = selStartPos + 4;
                        input.selectionEnd = selStartPos + 4;
                        key.preventDefault();
                    }

                    self.renderOutput('.code-output', this.value);
                });

                Prism.highlightAll();
            },
            listenForLanguage: function (languageSel, outputSel, inputSel) {
                var self = this;
                $(languageSel).on('change', function () {
                    $('code', outputSel)
                            .removeClass()
                            .addClass('language-' + this.value)
                            .removeAttr('data-language');

                    $(outputSel)
                            .removeClass()
                            .addClass('code-output language-' + this.value);

                    $(inputSel)
                            .val('');

                    $('code', outputSel)
                            .html('');

                    self.focusInput(inputSel);
                });
            },
            listenerForScroll: function (inputSel, outputSel) {
                $(inputSel).on('scroll', function () {
                    console.log(this.scrollTop);
                    $(outputSel)[0].scrollTop = this.scrollTop;
                });
            },
            renderOutput: function (outputSel, value) {
                $('code', outputSel)
                        .html(value.replace(/&/g, "&amp;").replace(/</g, "&lt;")
                                .replace(/>/g, "&gt;") + "\n");

                Prism.highlightAll();
            },
            focusInput: function (inputSel) {
                var input = $(inputSel);

                input.focus();

                input[0].selectionStart = input[0].value.length;
                input[0].selectionEnd = input[0].value.length;
            }
        }
    })();

    MicroCode.init('.code-input', '.code-output', '.language');
</script>
<main class="view">
    <h1 class="title">
        Micro Code Editor
        <small>With syntax highlight*</small>
    </h1>

    <div class="window">
        <div class="window-header">
            <div class="action-buttons"></div>
            <select class="language">
                <option value="javascript" selected>JavaScript</option>
                <option value="markup">HTML</option>
                <option value="php">PHP</option>
            </select>
        </div>
        <div class="window-body">
            <textarea class="code-input">// Switch the language and put some code on me :)           ↑↑↑↑↑↑
// This is a 'Hello World' example.

function greetings(name){
    name = name || "stranger";
    return "Hello, " + name + "!";
}

window.onLoad = greetings();</textarea>
            <pre class="code-output">
				<code class="language-javascript">
					
				</code>
            </pre>
        </div>
    </div>
    <div class="credits">
        *thanks to <a href="https://twitter.com/leaverou">Lea Verou</a> for <a href="http://prismjs.com/">Prism.js</a>
    </div>
</main>