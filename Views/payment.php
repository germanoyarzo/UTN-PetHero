<?php
    include_once('navOwner.php'); 
    require_once("validate-session.php");
?>

<div class="container d-flex justify-content-center mt-5 mb-5">
    <div class="row g-3">
      <div class="col-md-6">
        <span>Payment Method</span>
        <div class="card">
          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header p-0" id="headingTwo">
                <h2 class="mb-0">
                  <button class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <div class="d-flex align-items-center justify-content-between">
                        <span>Paypal</span>
                        <img src="https://i.imgur.com/7kQEsHU.png" width="30">
                    </div>
                  </button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <input type="text" class="form-control" placeholder="Paypal email">
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-header p-0">
                <h2 class="mb-0">
                  <button class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="d-flex align-items-center justify-content-between">
                      <span>Credit card</span>
                      <div class="icons">
                        <img src="https://i.imgur.com/2ISgYja.png" width="30">
                        <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                        <img src="https://i.imgur.com/35tC99g.png" width="30">
                        <img src="https://i.imgur.com/2ISgYja.png" width="30">
                      </div>
                    </div>
                  </button>
                </h2>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body payment-card-body">
                    <span class="font-weight-normal card-text">Card Number</span>

                    <div class="input">
                      <i class="fa fa-credit-card"></i>
                      <input type="text" class="form-control" placeholder="0000 0000 0000 0000" minlength="16" maxlength="16" required>
                    </div> 

                    <div class="row mt-3 mb-3">
                      <div class="col-md-6">
                        <span class="font-weight-normal card-text">Expiry Date</span>
                        <div class="input" required>
                          <i class="fa fa-calendar"></i>
                          <input type="text" class="form-control" placeholder="MM/YY"  minlength="5" maxlength="5"required>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <span class="font-weight-normal card-text">CVC/CVV</span>
                        <div class="input">
                          <i class="fa fa-lock"></i>
                          <input type="text" class="form-control" placeholder="000"  minlength="3" maxlength="4" >
                        </div>
                      </div>
                    </div>

                    <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="mainForm__container">
          <div class="mainForm fadeInDown">
            <!-- Form -->
            <script src="https://smtpjs.com/v3/smtp.js"></script>
            <form action="<?php echo FRONT_ROOT."Book/ConfirmPayment/".$book->getId()?>" method="POST" class="mainForm__form">
              <h2 class="mainForm__form--title">SUMARY</h2>

              <div class="form-confirmBook">
                <div class="confirmBook-keeper">
                  <h5 style="color:#39ace7">Keeper Name: </h5>
                  <p id="nameKeeper" name="nameKeeper" class="confirmBook-keeper-item"><?php echo $frontKeeper->getFirstName()." ". $frontKeeper->getLastName() ?></p>
                  <input type="number" name="idBook" id="idBook" value="<?php echo $book->getId() ?>" hidden>
                  <input type="number" name="idKeeper" id="idKeeper" value="<?php echo $frontKeeper->getId() ?>" hidden>
                  <input type="number" name="idOwner" id="idOwner" value="<?php echo $frontOwnerBook ?>" hidden>
                  <input type="number" name="idKeeperBook" id="idKeeperBook" value="<?php echo $frontIdKeeperBook  ?>" hidden>
                </div>
                
                <div class="confirmBook-pets">
                  <h5 style="color:#39ace7">Pet: </h5>
                  <p id="pet" name="pet" class="confirmBook-pets-item"><?php echo $petType ?> / <?php echo $petSize ?></p>
                </div>

                <div class="confirmBook-book">
                  <input type="text" name="petType" id="petType" value="<?php echo $petType ?>" hidden>
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

              <input type="submit" class="mainForm__form--submit fadeIn second" value="Confirm Pay">

              <a href="<?php echo FRONT_ROOT ?>Owner/HomeOwner" class="btn btn-outline-primary">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>