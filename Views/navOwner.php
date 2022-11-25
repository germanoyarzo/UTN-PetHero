
<nav class="navbar">
  <a class="active" href="<?php echo FRONT_ROOT."User/HomeOwner" ?>"><i class="small material-icons">home</i>Home</a>
  <span style='font-size:20px;'><a href="<?php echo FRONT_ROOT."User/ShowModifyView"?>">&#9998; Edit User</a></span>
  <span style='font-size:20px;'><a href="<?php echo FRONT_ROOT."User/ShowMyListView/".$_SESSION["loggedUser"]->getId()?>">&#9776; User Info</a></span>
  <a href="<?php echo FRONT_ROOT."User/Contact"?>"><i class="small material-icons">call_end</i>Contact</a>
  <a href="<?php echo FRONT_ROOT."User/Logout" ?>"><i class="small material-icons">account_circle</i>Log Out</a>
</nav>