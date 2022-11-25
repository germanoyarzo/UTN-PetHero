<div class="mainForm fadeInDown">
  <div class="mainForm__container">
    <!-- Icon -->
    <div class="mainForm__header fadeIn first">
      <img class="mainForm__header--img" src="<?php echo FRONT_ROOT.VIEWS_PATH?>img/dogIcon.png" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form action="<?php echo FRONT_ROOT?>User/Login" method="POST" class="mainForm__form">
      <input type="email" id="email" class="mainForm__form--input fadeIn second" name="email" placeholder="Email">
      <input type="password" id="password" class="mainForm__form--input fadeIn second" name="password" placeholder="Password">
      <input type="submit" class="mainForm__form--submit fadeIn second" value="Log In">
      <?php if($frontMessage){?>
        <p class="error__message"><?php echo $frontMessage?></p>
      <?php }?>
    </form>

    <!-- Sing Up -->
    <div class="mainForm__SignUp">
      <a class="mainForm__SignUp--item" href="<?php echo FRONT_ROOT?>User/SignUp">Sign Up</a>
    </div>

    <!-- Remind Passowrd -->
    <div class="mainForm__Forgot">
      <a class="mainForm__Forgot--item" href="<?php echo FRONT_ROOT ?>User/ShowUserRecovery"><h6>Forgot Password?</h6></a>
    </div>
    
  </div>
</div>