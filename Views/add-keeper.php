<?php
  include_once('navKeeper.php'); 
  require_once("validate-session.php");
?>

<div class="mainForm fadeInDown">
  <div class="mainForm__container">
    <!-- Form -->
    <form action="<?php echo FRONT_ROOT?>Keeper/Add" method="POST" enctype="multipart/form-data" class="mainForm__form">
      <h2 class="mainForm__form--title">ADD AVAILABILITY</h2>

      <!-- <select class="mainForm__form--select fadeIn second" name="typePet" id="typePet" required>
        <option disabled selected>Select Pet type</option>
        <option value="cat">Cat</option>
        <option value="dog">Dog</option>
      </select> -->
      <p class="mainForm__form--select fadeIn second" name="typePet" id="typePet"> </p>
      <input type="text" name="typePet" id="typePet" value="All" hidden>

      <select class="mainForm__form--select fadeIn second" name="size" id="size" required>
        <option disabled selected>Select Size</option>
        <option value="small">Small</option>
        <option value="medium">Medium</option>
        <option value="big">Big</option>
      </select>

      <input type="number" id="salary" class="mainForm__form--input fadeIn second" name="salary" placeholder="Salary per day $" min="0" oninput="validity.valid||(value='');" required>
      
      <select class="mainForm__form--input fadeIn third" name="available" id="available" required>
        <option disabled selected>Select Status</option>
        <option value="true">Available</option>
        <option value="false">Not Available</option>
      </select>

      <!-- Date input -->
      <!--<input class="form-control" id="date" name="date" placeholder="Availability: DD/MM/YYY" type="text" min=""/>-->
      <div class="mainForm__form--calendars">
        <div class="calendar__item">
          <input type="date" name="dateStart" id="dateStart" class="mainForm__form--input fadeIn second" aria-label="...">
          <input type="date" name="dateEnd" id="dateEnd" class="mainForm__form--input fadeIn second" aria-label="...">
        </div>
      </div>

      <div class="formSend">
        <input type="submit"  class="mainForm__form--submit fadeIn third" value="Add availability">
        <a href="<?php echo FRONT_ROOT ?>User/HomeKeeper" class="fadeIn third">Cancel</a>
      </div>
      </form>
  </div>
</div>

<script>

  /* $(document).ready(function(){
    var date_input=$('input[name="date"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var options={
      format: 'dd/mm/yyyy',
      container: container,
      todayHighlight: true,
      autoclose: true,
    };
    date_input.datepicker(options);
  })  */

  document.getElementById('dateStart').setAttribute('min', new Date().toISOString().split('T')[0])
  document.getElementById('dateEnd').setAttribute('min', new Date().toISOString().split('T')[0])
</script>
