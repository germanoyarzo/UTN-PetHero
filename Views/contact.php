<?php
  require_once("validate-session.php");
  require_once("validate-session.php");
  if($_SESSION["loggedUser"]->getRole() === "Owner")
  {
      include('navOwner.php');
  }else{
      include('navKeeper.php');
  }

?>
<div class="mainForm fadeInDown">
  <div class="mainForm__container">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <h2 class="mainForm__form--title">CONTACT</h2>

      <div class="form-confirmBook">
        <div class="confirmBook-keeper">
          <h3 style="color:#39ace7">Developers </h3>
            <h6><a href="https://github.com/germanoyarzo/"><i class="fa fa-github" style="font-size:36px"></i>German Oyarzo</h6></a>
            <h6><a href="https://github.com/FranLongaretto/"><i class="fa fa-github" style="font-size:36px"></i>Fran Longaretto</h6>
            <h6><a href="https://github.com/tisanti147"><i class="fa fa-github" style="font-size:36px"></i>Santiago Martinez</h6>
        </div>
      </div>
    </form>
  </div>
</div>
