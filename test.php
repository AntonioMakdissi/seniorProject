<?php
require_once('php/branches.php');
require_once 'php/connection.php';

?>
<form method="post" action="your_php_script.php">
  <select name="selected_value">
    <option value="value1">Option 1</option>
    <option value="value2">Option 2</option>
    <option value="value3">Option 3</option>
  </select>
  <input type="submit" value="Submit">
  <input type="hidden" name="form_submitted" value="1">
</form>

<!-- <script>
$(document).ready(function () {
    createCookie("height", $(window).height(), "10");
  });
  
  function createCookie(name, value, days) {
    var expires;
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
    }
    else {
      expires = "";
    }
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
  }
</script>
   -->