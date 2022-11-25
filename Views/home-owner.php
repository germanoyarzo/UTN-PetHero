<?php 
    include_once('navOwner.php');
    require_once("validate-session.php"); 
?>

<div class="homeUser"> 
  <div class="homeUser__header">
    <h1 class="homeUser__title">PET HERO</h1>
    <p class="homeUser__subtitle">welcome owner!!!</p>
  </div>

  <div class="homeUser__menu">
    <div class="homeUser__menu--item">
      <a href="<?php echo FRONT_ROOT?>Pet/SignUpPet">Add Pet</a>
    </div>
  
    <div class="homeUser__menu--item">
      <a href="<?php echo FRONT_ROOT?>Pet/ShowListView">Show Pets List</a>
    </div>

    <div class="homeUser__menu--item">
      <a href="<?php echo FRONT_ROOT?>Owner/StartBooking">Start Booking</a>
    </div>

    <div class="homeUser__menu--item">
      <a href="<?php echo FRONT_ROOT?>Book/ShowListView">Show My Books</a>
    </div>
    
    <div class="homeUser__menu--item">
      <a href="<?php echo FRONT_ROOT?>Chat/ShowKeeperList">Start new Chat</a>
    </div>
    
    <div class="homeUser__menu--item">
      <a href="<?php echo FRONT_ROOT?>Chat/ShowMyChats">Show My Chats</a>
    </div>
  
    <?php if($frontMessage){?>
      <div class="homeUser__menu--message">
        <p class="check__message" <?php if(strstr($frontMessage, 'is')){ ?> style="color:red;" <?php } ?> >
          <?php echo $frontMessage?>
        </p>
      </div>
    <?php }?>
  </div>
</div>