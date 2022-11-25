<?php 
    require_once("validate-session.php");
    include('navOwner.php');
?>

<div class="mainForm mainFormKeeper fadeInDown">
    <div class="mainForm__container">
        <form class="mainForm__form" action="<?php echo FRONT_ROOT?>Chat/Add" method="POST">
            <div align="center">
                <h2 class="mainForm__form--title">AVAILABLE KEEPERS</h2>
            </div>
            <hr class="separator">
            <div class="content">
                <table style="text-align:center;">
                    <thead style="color:white">
                        <tr> 
                            <th>Keeper</th>
                            <th>Email</th>
                            <th>DNI</th>
                            <th>Phone</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($keeperList as $user) { ?>
                        <tr>
                            <td><?php echo $user->getFirstName()." ".$user->getLastName() ?></td>
                            <td style="text-transform: lowercase;"><?php echo $user->getEmail() ?></td>
                            <td><?php echo $user->getDni() ?></td>
                            <td><?php echo $user->getPhoneNumber() ?></td>
                            <td>
                                <input type="number" name="keeperId" id="keeperId" value="<?php echo $user->getId() ?>" hidden>
                                <input type="submit" class="mainForm__form--submit fadeIn second" value="CHAT" style="margin: auto;">
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if($frontMessage){ ?>
                <p><?php echo $frontMessage ?></p>
            <?php } ?>
        </form>
    </div>
</div>