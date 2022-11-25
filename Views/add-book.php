<?php
  include_once('navOwner.php'); 
  require_once("validate-session.php");

?>
<div class="mainForm fadeInDown">
  <div class="mainForm__container">
    <!-- Form -->
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <form action="<?php echo FRONT_ROOT?>Book/Add" method="POST" class="mainForm__form">
      <h2 class="mainForm__form--title">CONFIRM BOOK</h2>

      <div class="form-confirmBook">
        <div class="confirmBook-keeper">
          <h5 style="color:#39ace7">Keeper Name: </h5>
          <p id="nameKeeper" name="nameKeeper" class="confirmBook-keeper-item"><?php echo $frontKeeper->getFirstName()." ". $frontKeeper->getLastName() ?></p>
          <input type="number" name="idKeeper" id="idKeeper" value="<?php echo $frontKeeper->getId() ?>" hidden>
          <input type="number" name="idOwner" id="idOwner" value="<?php echo $frontOwnerBook->getId() ?>" hidden>
          <input type="number" name="idKeeperBook" id="idKeeperBook" value="<?php echo $frontKeeperBook ?>" hidden>
        </div>
        <?php foreach ($frontBookPets as $key => $value) {?>
        <div class="confirmBook-pets">
          <h5 style="color:#39ace7">Pet: </h5>
          <p id="pet" name="pet" class="confirmBook-pets-item"><?php echo $value->getType() ?> / <?php echo $value->getRace() ?></p>
        </div>
        <?php } ?>
        <div class="confirmBook-book">
          <input type="text" name="petType" id="petType" value="<?php echo $value->getType() ?>" hidden>
          <input type="text" name="petSize" id="petSize" value="<?php echo $petSize ?>" hidden>
          <div class="confirmBook-book-date">
            <h5 style="color:#39ace7">Date range: </h5>
            <p class="confirmBook-book-date-item"><?php echo $frontDateStart . " / " . $frontDateEnd ?></p>
            <input type="date" name="dateStart" id="dateStart" value="<?php echo $frontDateStart ?>" hidden>
            <input type="date" name="dateEnd" id="dateEnd" value="<?php echo $frontDateEnd ?>" hidden>
          </div>
          <div class="confirmBook-book-price">
            <h5 style="color:#39ace7">Price: </h5>
            <p class="confirmBook-book-price-item"><?php echo $frontPrice ?></p>
            <input type="number" name="bookPrice" id="bookPrice" value="<?php echo $frontPrice ?>" hidden>
          </div>
        </div>
      </div>
 
      <input type="email" name="emailOwner" id="emailOwner" value="<?php echo $frontOwnerBook->getEmail() ?>" hidden>
    
      <input type="submit" class="mainForm__form--submit fadeIn second" value="Confirm">

      <?php if($_SESSION["loggedUser"]->getRole()=="Owner"){ ?>
        <a href="<?php echo FRONT_ROOT ?>Owner/HomeOwner" class="btn btn-outline-primary">Cancel</a>
      <?php }else{ ?>
        <a href="<?php echo FRONT_ROOT ?>User/HomeKeeper" class="btn btn-outline-primary">Cancel</a>
      <?php } ?>
     
    </form>
  </div>
</div>
