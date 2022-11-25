<?php
  require_once("validate-session.php");
  include_once("navOwner.php"); 
?>

<div class="mainForm fadeInDown">
  <div class="mainForm__container">
    <!-- Login Form -->
    <form action="<?php echo FRONT_ROOT?>Pet/Add" method="POST" enctype="multipart/form-data" class="mainForm__form">
      <h2 class="mainForm__form--title">ADD PET</h2>

      <select class="fadeIn second" name="type" id="type" required>
        <option disabled selected>Seleccionar Pet</option>
        <option value="Dog">Dog</option>
        <option value="Cat">Cat</option>
      </select>

      <input type="text" id="race" class="mainForm__form--input fadeIn second" name="race" placeholder="Race" required>

      <select class="fadeIn second" name="size" id="size" required>
        <option disabled selected>Seleccionar Size</option>
        <option value="small">Small</option>
        <option value="medium">Medium</option>
        <option value="big">Big</option>
      </select>

      <input type="file" accept="image/*" id="vaccination" class="inputImgVaccine fadeIn second" name="vaccinationImg" required>

      <input type="text" id="description" class="mainForm__form--input fadeIn second" name="description" placeholder="Description" required>

      <input type="file" accept="image/*" id="image" class="inputImgPet fadeIn second" name="petImage" required>

      <div class="formSend">
        <input type="submit" class="mainForm__form--submit fadeIn third" value="Add Pet">
        <a href="<?php echo FRONT_ROOT ?>User/HomeOwner" class="formSend__cancel">Cancel</a>
      </div>
    </form>
  </div>
</div>