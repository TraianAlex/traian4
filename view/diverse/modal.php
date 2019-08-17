<style type="text/css">
.modal-box {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.8);
  z-index: 99999;
  opacity: 0;
  -webkit-transition: opacity 0.4s ease-in;
  -moz-transition: opacity 0.4s ease-in;
  transition: opacity 0.4s ease-in;
  pointer-events: none;
}
.modal-box:target {
  opacity: 1;
  pointer-events: auto;
}
.modal-box__content {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  width: 800px;
  padding: 20px;
  background: #fff;
}
.modal-box--close {
  background: #606061;
  color: #FFFFFF;
  height: 30px;
  line-height: 30px;
  position: absolute;
  right: -15px;
  top: -15px;
  padding: 0 10px;
}
</style>
<br>
<?=URL::link('diverse/modal#modal-box--open', 'Open Modal Box')?>
<div id="modal-box--open" class="modal-box">
  <div class="modal-box__content">
    <?=URL::link('diverse/modal#modal-box--close', 'Close Modal Boxl', null, 'class="modal-box--close"')?>
    <h2>Modal Box</h2>
    <p>
      Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Nulla vitae elit libero, a pharetra augue. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit.
    </p>
  </div>
</div>