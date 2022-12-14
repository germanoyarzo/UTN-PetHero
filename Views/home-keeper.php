<?php 
    include_once('navKeeper.php');
    require_once("validate-session.php"); 
?>

<div class="homeUser"> 
  <div class="homeUser__header">
    <h1 class="homeUser__title">PET HERO</h1>
    <p class="homeUser__subtitle">Welcome keeper!!!</p>
  </div>

  <div class="homeUser__menu">
    <div class="homeUser__menu--item">
      <a href="<?php echo FRONT_ROOT?>Keeper/RegistrationKeeper">Add availability</a>
    </div>
    <div class="homeUser__menu--item">
      <a  href="<?php echo FRONT_ROOT."Book/ShowListViewKeeper" ?>">Pending Bookings</a>
    </div>

    <div class="homeUser__menu--item">
      <a href="<?php echo FRONT_ROOT?>Book/ShowListView">Show My Bookings</a>
    </div>

    <div class="homeUser__menu--item">
      <a href="<?php echo FRONT_ROOT?>Chat/ShowMyChats">Show My Chats</a>
    </div>
  
    <?php if($frontMessage){?>
      <div class="homeUser__menu--message">
        <p class="check__message"><?php echo $frontMessage?></p>
      </div>
    <?php }?>
  </div>
</div>