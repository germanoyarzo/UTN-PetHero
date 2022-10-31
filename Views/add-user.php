

<div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->


      <!-- Login Form -->
      <form action="<?php echo FRONT_ROOT?>User/Add" method="POST">
        <h2>REGISTRATION</h2>
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
        <input type="submit" class="fadeIn fourth" value="Sign Up">
        <a href="<?php echo FRONT_ROOT ?>User/Index" class="fadeIn third">Cancel</a>
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

