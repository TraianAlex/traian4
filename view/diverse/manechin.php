<link type="text/css" rel="stylesheet" href="<?=SITE_ROOT?>/css/manechin.css">
  <div id="nopose"></div>
  <div id="one"></div>
  <div id="two"></div>
  <div id="three"></div>
  <div id="four"></div>
  <div class="PoseSelector">
    <?=URL::link('diverse/manechin#nopose', 'No Pose')?>
    <?=URL::link('diverse/manechin#one', 'Pose 1')?>
    <?=URL::link('diverse/manechin#two', 'Pose 2')?>
    <?=URL::link('diverse/manechin#three', 'Pose 3')?>
    <?=URL::link('diverse/manechin#four', 'Pose 4')?>
  </div>
  <main class="Scene">
    <div class="Camera">
      <figure class="Mannequin">
        <section class="Body">
          <div class="UpperBody">
            <div class="UpperBody-frontFace Face"></div>
            <div class="UpperBody-backFace Face"></div>
            <header class="Head">
              <div class="Head-frontFace Face"></div>
              <div class="Head-backFace Face"></div>
            </header>
            <aside class="Arm left">
              <div class="Arm-upperArm">
                <div class="Arm-upperArm-frontFace Face"></div>
                <div class="Arm-upperArm-backFace Face"></div>
              </div>
              <div class="Arm-lowerArm">
                <div class="Arm-lowerArm-frontFace Face"></div>
                <div class="Arm-lowerArm-backFace Face"></div>
              </div>
            </aside>
            <aside class="Arm right">
              <div class="Arm-upperArm">
                <div class="Arm-upperArm-frontFace Face"></div>
                <div class="Arm-upperArm-backFace Face"></div>
              </div>
              <div class="Arm-lowerArm">
                <div class="Arm-lowerArm-frontFace Face"></div>
                <div class="Arm-lowerArm-backFace Face"></div>
              </div>
            </aside>
          </div>
          <div class="LowerBody">
            <div class="LowerBody-frontFace Face"></div>
            <div class="LowerBody-backFace Face"></div>
          </div>
        </section>
        <footer class="Legs">
          <div class="Leg left">
            <div class="Leg-upperLeg">
              <div class="Leg-upperLeg-frontFace Face"></div>
              <div class="Leg-upperLeg-backFace Face"></div>
            </div>
            <div class="Leg-lowerLeg">
              <div class="Leg-lowerLeg-frontFace Face"></div>
              <div class="Leg-lowerLeg-backFace Face"></div>
            </div>
          </div>
          <div class="Leg right">
            <div class="Leg-upperLeg">
              <div class="Leg-upperLeg-frontFace Face"></div>
              <div class="Leg-upperLeg-backFace Face"></div>
            </div>
            <div class="Leg-lowerLeg">
              <div class="Leg-lowerLeg-frontFace Face"></div>
              <div class="Leg-lowerLeg-backFace Face"></div>
            </div>
          </div>
        </footer>
      </figure>
      <div class='GroundPlane'></div>
    </div>
  </main>
  <div class='Links'>
    <a href="http://twitter.com/neoberg" target="_blank">@neoberg</a>
    <a href="mailto:neoberg@gmail.com">contact me</a>
  </div>
