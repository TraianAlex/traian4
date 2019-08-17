<style type="text/css">
    .hexagon {
        position: relative;
        width: 6.928203232em;
        height: 4em;
        margin: 2em auto;
        color: rgba(255,0,0,0.5);
        font-size: 16px;
        background-color: currentColor;
    }
    .hexagon::before,
    .hexagon::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: inherit;
    }
    .hexagon::before {
        -webkit-transform: rotate(60deg);
        -ms-transform: rotate(60deg);
        transform: rotate(60deg);
    }
    .hexagon::after {
        -webkit-transform: rotate(-60deg);
        -ms-transform: rotate(-60deg);
        transform: rotate(-60deg);
    }
    .hexagon,
    .hexagon::before,
    .hexagon::after {
        border-radius: 50%/50%;
    }
    .box {
        position: relative;
        width: 16em;
        margin: 2em auto;
        overflow: hidden;
    }
    .box:hover * {
        -webkit-animation-play-state: paused;
        animation-play-state: paused;
    }
    .box:active * {
        -webkit-animation-play-state: running;
        animation-play-state: running;
    }
    .ctrl {
        max-width: 30rem;
        margin: auto;
        text-align: left;
    }
    .ctrl .table {
        width: 100%;
        table-layout: fixed;
        display: table;
    }
    .ctrl .td {
        display: table-cell;
        vertical-align: top;
        margin: 2% 0%;
        background-color: rgba(153,153,153,0.1);
        padding: 1% 3%;
    }
    .ctrl h4 {
        margin: 1em 0;
    }
    .ctrl label {
        display: block;
        margin-bottom: 1em;
        cursor: pointer;
    }
    .ctrl .ib {
        display: inline-block;
        width: 3em;
    }
    .ctrl input.block {
        display: block;
        width: 80%;
        margin-left: 10%;
        margin-right: 10%;
    }
    .ctrl input {
        cursor: pointer;
    }
    .ctrl a {
        color: inherit;
    }
    .ctrl style {
        display: block;
        padding: 1em;
        word-break: break-word;
        opacity: 0.5;
    }
    .ctrl style.update {
        -webkit-animation: update 1s linear 1;
        animation: update 1s linear 1;
    }
    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }
    body {
        position: relative;
        margin: 0;
        padding-top: 1px;
        text-align: center;
        /* background-color: #2b2e2d; */
        /* color: #e4e3c8; */
    }
    .intro {
        width: 80%;
        max-width: 30rem;
        padding-bottom: 1rem;
        margin: 0.5em auto 1em;
        text-transform: capitalize;
        border-bottom: 1px dashed #999;
    }
    .intro small {
        display: block;
        opacity: 0.5;
        font-style: italic;
        text-transform: capitalize;
    }
    @-webkit-keyframes update {
        0% {
            background-color: rgba(255,255,0,0.7);
        }
        100% {
            background-color: rgba(255,255,255,0);
        }
    }
    @keyframes update {
        0% {
            background-color: rgba(255,255,0,0.7);
        }
        100% {
            background-color: rgba(255,255,255,0);
        }
    }
</style>

<h1 class="intro">hexagon<small>hexagon transformer</small></h1>
<div class="box">
    <div class="hexagon"></div>
</div>
<!--/////-->
<form class="ctrl">
    <div class="table">
        <div class="td">
            <h4>border radius</h4>
            <label>
                <input type="checkbox" checked="checked" data-str="radius.linked"/>linked?
            </label>
            <label>horizontal radius:
                <input id="radius-h" type="range" min="0" max="100" data-str="radius.h" value="50" class="block"/>
            </label>
            <label>vertical radius:
                <input id="radius-v" type="range" min="0" max="100" data-str="radius.v" value="50" class="block"/>
            </label>unit: <br/>
            <label class="ib">
                <input type="radio" name="radius-unit" value="%" checked="checked" data-str="radius.unit" class="radius-unit"/>%
            </label>
            <label class="ib">
                <input type="radio" name="radius-unit" value="px" data-str="radius.unit" class="radius-unit"/>px
            </label>
        </div>
        <div class="td">
            <h4>color</h4>
            <label>color(#rgb):
                <input id="color-hex" type="color" value="#ff0000" data-str="color.hex" class="block"/>
            </label>
            <label>alpha:
                <input id="color-alpha" type="range" min="0" max="1" step="0.01" value=".5" data-str="color.alpha" class="block"/>
            </label>
            <input id="reset" type="reset" class="block"/>
            <p><a id="permalink" href="###">permalink</a></p>
        </div>
    </div>
    <h4>style preview</h4>
    <pre><style id="inline" contenteditable=""></style></pre>
</form>

<script type="text/javascript">
    (function () {
        'use strict';

        var inputs = document.getElementsByTagName('input');
        var varInput = document.querySelectorAll('[data-str]');
        var style = document.getElementById('inline');
        var permalink = document.getElementById('permalink');
        var data = {
            color: {
                hex: '#9900ff',
                alpha: 0.6
            },
            radius: {
                h: 0,
                v: 0,
                linked: true,
                unit: '%'
            }
        };

        var updateData = function (inputArray, _id) {
            inputArray = inputArray ? inputArray : varInput;

            [].forEach.call(inputArray, function (_input) {
                var _type = _input.type;

                if ('radio' === _type && !_input.checked) {
                    return;
                }

                var pos = _input.getAttribute('data-str').split('.');
                var val = ('checkbox' === _type) ? _input.checked : _input.value;

                data[pos[0]][pos[1]] = val;
            });

            // if radius liined
            if (/radius/.test(_id) && data.radius.linked) {
                var linkedTargetId = ('radius-h' === _id) ? 'radius-v' : 'radius-h';
                var linkedTarget = document.getElementById(linkedTargetId);
                var changingItem = document.getElementById(_id);

                linkedTarget.value = changingItem.value;

                // update just another linked input value
                updateData([linkedTarget]);
            }

            updateState();
        };

        var updateState = function () {
            var dataExport = JSON.stringify(data);
            // history.pushState(null, null, location.href);
            // location.hash = 'go=' + dataExport;
            permalink.href = location.origin + location.pathname + '#go=' + dataExport;
        };

        var hex2Dec = function (hex) {
            return Number('0x' + hex.toString());
        };

        var rgba = function (hexColor, alpha) {
            hexColor = hexColor.trim().substr(1);
            alpha = (alpha !== undefined ? alpha : 1);

            var step = (hexColor.length / 3);
            var pattern = new RegExp('.{' + step + '}', 'g');
            var colorString = hexColor.match(pattern);
            var r, g, b;

            r = hex2Dec(colorString[0]);
            g = hex2Dec(colorString[1]);
            b = hex2Dec(colorString[2]);

            return 'rgba(' + [r, g, b, alpha].join(',') + ')';
        };

        var render = function () {
            style.textContent = '.hexagon, .hexagon::before, .hexagon::after {\n  color: ' + rgba(data.color.hex, data.color.alpha) + ';\n  border-radius: ' + [data.radius.h, data.radius.unit, ' / ', data.radius.v, data.radius.unit].join('') + ';\n}';

            style.className = '';

            setTimeout(function () {
                style.className = 'update';
            }, 30);
        };

        var bindChange = function () {
            [].forEach.call(varInput, function (_input) {
                _input.addEventListener('input', function () {
                    renderWithUpdate(this.id);
                });
                _input.addEventListener('change', function () {
                    renderWithUpdate(this.id);
                });
            });

            // bind reset
            document.getElementById('reset').addEventListener('click', function (e) {
                setTimeout(renderWithUpdate, 50);
            });
        };

        var renderWithUpdate = function (_id) {
            updateData(false, _id);
            render();
        };

        var init = (function () {
            var dataImport = location.hash.split('#go=');
            if (dataImport.length > 1) {
                data = JSON.parse(dataImport[1]);
            } else {
                updateData();
            }
            render();
            bindChange();
        })();

    })();
</script>