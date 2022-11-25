<?php
    require_once("validate-session.php");
    if($_SESSION["loggedUser"]->getRole() === "Owner")
    {
        include('navOwner.php');
    }else{
        include('navKeeper.php');
    }
?>
<div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->
      <!-- Login Form -->
      <form action="<?php echo FRONT_ROOT?>User/Modify" method="POST">
        <h2 style="color:#39ace7">MODIFY</h2>
        <input type="email" id="email" class="fadeIn second" name="email" placeholder="email" required>
        <input type="password" id="password" class="fadeIn third" name="password" placeholder="password" required>
        <select id="role" class="fadeIn third" name="role" required>
            <option value="Owner">Owner</option>
            <option value="Keeper">Keeper</option>
        </select>
        <input type="text" id="firstName" class="fadeIn third" name="firstName" placeholder="first name" required>
        <input type="text" id="lastName" class="fadeIn third" name="lastName" placeholder="last name" required>
        <input type="text" id="dni" class="fadeIn third" name="dni" placeholder="dni" required>
        <input type="text" id="phoneNumber" class="fadeIn third" name="phoneNumber" placeholder="phone number" required>
        <input type="text" id="keyword" name="keyword" value="" class="form-control" placeholder="keyword" required>
        <input type="submit" class="fadeIn fourth" value="Modify">
        <?php if($_SESSION["loggedUser"]->getRole()=="Owner"){ ?>
                <a href="<?php echo FRONT_ROOT ?>Owner/HomeOwner" class="btn btn-outline-primary">Cancel</a>
            <?php }else{ ?>
                <a href="<?php echo FRONT_ROOT ?>User/HomeKeeper" class="btn btn-outline-primary">Cancel</a>
            <?php } ?>
        <div>
          <?php
              if($message != "") {
                    echo "<div class='container alert alert-danger mt-3 p-3 text-center'>
                    <p><strong>" . $message . "</strong></p>
                    </div>";
              }
          ?>
          </div>
      </form>
    </div>
</div>

