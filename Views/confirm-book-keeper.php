<?php
  include_once('navKeeper.php'); 
  require_once("validate-session.php");
?>
<div class="mainForm fadeInDown">
    <div class="mainForm__container">
        <!-- Form -->
        <script src="https://smtpjs.com/v3/smtp.js"></script>
        <form action="<?php echo FRONT_ROOT?>Book/UpdateBook" method="POST" class="mainForm__form">
            <h2 class="mainForm__form--title">CONFIRM BOOK</h2>

            <div class="form-confirmBook">
                <div class="confirmBook-keeper">
                    <h5 style="color:#39ace7">Keeper Name</h5>
                    <input type="number" name="idBook" id="idBook" value="<?php echo $book->getId() ?>" hidden>
                    <input type="number" name="idKeeper" id="idKeeper" value="<?php echo $idKeeper ?>" hidden>
                    <input type="number" name="idOwner" id="idOwner" value="<?php echo $frontOwnerBook?>" hidden>
                    <input type="text" name="petType" id="petType" value="<?php echo $book->getPetType() ?>" hidden>
                    <p id="nameKeeper" class="confirmBook-keeper-item"><?php echo $frontKeeper->getFirstName()." ". $frontKeeper->getLastName() ?></p>   
                  
                </div>
                <div class="confirmBook-pets">
                    <h5 style="color:#39ace7">Pet: </h5>
                    <p id="pet" name="pet" class="confirmBook-pets-item"><?php echo $pet ?></p>
                </div>
                <div class="confirmBook-book">
                    <div class="confirmBook-book-date">
                        <h5 style="color:#39ace7">Date range </h5>
                        <p name="date" class="confirmBook-book-date-item"><?php echo $frontDateStart . " / " . $frontDateEnd ?></p>
                        <input type="dateStart" name="dateStart" id="dateStart" value="<?php echo $frontDateStart ?>" hidden>
                        <input type="dateEnd" name="dateEnd" id="dateEnd" value="<?php echo $frontDateEnd ?>" hidden>
                    </div>
                    <div class="confirmBook-book-price">
                        <h5 style="color:#39ace7">Price  $ </h5>
                        <p class="confirmBook-book-price-item" id="price"><?php echo $frontPrice ?></p>
                    </div>
                </div>
            </div>
            <input type="email" name="emailOwner" id="emailOwner" value="<?php echo $userEmail ?>" hidden>

            <input type="submit" class="mainForm__form--submit fadeIn second" value="Confirm">

            <?php if($_SESSION["loggedUser"]->getRole()=="Owner"){ ?>
                <a href="<?php echo FRONT_ROOT ?>Owner/HomeOwner" class="btn btn-outline-primary">Cancel</a>
            <?php }else{ ?>
                <a href="<?php echo FRONT_ROOT ?>User/HomeKeeper" class="btn btn-outline-primary">Cancel</a>
            <?php } ?>
        </form>
        <input type="button" class="mainForm__form--submit fadeIn second" value="Send Email" onclick="sendEmail()">
        
    </div>
</div>
<script>
  bookPrice = "Total Price: $".bold()+document.getElementById('price').innerHTML
  nameKeeper = "Keeper Name: ".bold()+document.getElementById('nameKeeper').innerHTML
  emailOwner = document.getElementById('emailOwner').value
  dateStart= "Date Start: ".bold()+document.getElementById('dateStart').value
  dateEnd= "Date End: ".bold()+document.getElementById('dateEnd').value
  idOwner = "Owner Id: ".bold()+document.getElementById('idOwner').value
  pet= "Pet: ".bold()+document.getElementById('pet').innerHTML          
  body= bookPrice+"," +nameKeeper+"," + idOwner+"," +pet+"," +dateStart+"," +dateEnd

    
  function sendEmail(){
    Email.send({
    Host : "smtp.elasticemail.com",
    Username : "german_oyarzo@hotmail.com",
    Password : "EF462AA83096FAEFB0D13D181F2942C011CB",
    To : emailOwner,
    From : "german_oyarzo@hotmail.com",
    Subject : "Book Details",
    Body : body
    }).then(
      (message) => {alert( "The email has been sent correctly" );
    });
  }
  
</script>