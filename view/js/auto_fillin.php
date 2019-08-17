<script type="text/javascript">
    /* This script and many more are available free online at
The JavaScript Source!! http://www.javascriptsource.com
Created by: assbach | http://www.ipernity.com/home/assbach */

function dummyreg() {
  var currentDate = new Date()
  var month = currentDate.getMonth() +1
  var day = currentDate.getDate()
  var year = currentDate.getFullYear()
  var formDate = month + "-" + day + "-" + year

  // Use whatever data you like for the items below
 	document.getElementById("name").value = "Master Coder";
 	document.getElementById("email").value = "mc@somewhere.com";
 	document.getElementById("datebox").value = formDate;
 	document.getElementById("checkbox").checked = true; // checkbox
 	document.getElementById("radiobutton").checked = true; // radiobutton
 	document.getElementById("pulldown").selectedIndex = 1; // dropdown
}

// Multiple onload function created by: Simon Willison
// http://simonwillison.net/2004/May/26/addLoadEvent/
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

addLoadEvent(function() {
  dummyreg();
});

</script>

<br>
<h4>Autocomplete form</h4>
<form>
  <table>
    <tr>
      <td>Name:</td>
      <td><input class="inputBox" id="name" type="text"></td>
    </tr><tr>
      <td>E-mail:</td><td><input class="inputBox" id="email" type="text"></td>
    </tr><tr>
      <td>Date</td><td><input class="datebox" id="date" type="text"></td>
    </tr><tr>
      <td>
        <input type="checkbox" id="checkbox" name="option1" value="Milk"> Milk<br>
        <input type="checkbox" name="option2" value="Butter"> Butter<br>
        <input type="checkbox" name="option3" value="Cheese"> Cheese<br>
      </td>
      <td>
        <input type="radio" name="heading of button" value="Milk"> Milk<br>
        <input type="radio" id="radiobutton" name="heading of button" value="Butter"> Butter<br>
        <input type="radio" name="heading of button" value="Cheese"> Cheese
      </td>
    </tr>
    <tr>
      <td>
        <select id="pulldown">
          <option>Milk</option>
          <option>Coffee</option>
          <option>Tea</option>
        </select>
      </td>
      <td> </td>
    </tr>
  </table>
</form>
