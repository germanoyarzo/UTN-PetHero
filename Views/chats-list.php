<?php 
    require_once("validate-session.php");
    if($_SESSION["loggedUser"]->getRole() === "Owner")
    {
        include('navOwner.php');
    }else{
        include('navKeeper.php');
    }
?>

<div class="mainForm mainFormKeeper fadeInDown">
    <div class="mainForm__container">
            <div align="center">
                <h2 class="mainForm__form--title">CHAT´S LIST</h2>
            </div>
            <hr class="separator">
            <div class="content">
                <table style="text-align:center;">
                    <thead style="color:white">
                        <tr> 
                            <?php if($_SESSION["loggedUser"]->getRole() == "Owner"){ ?>
                            <th>Keeper</th>
                            <?php }else{?>
                            <th>Owner</th>
                            <?php }?>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Open</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($chatListFront as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value["user"]->getFirstName()." ".$value["user"]->getLastName() ?></td>
                            <td style="text-transform: lowercase;"><?php echo $value["user"]->getEmail() ?></td>
                            <td><?php echo $value["user"]->getPhoneNumber() ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT."Chat/ShowChatById"?>" method="POST">
                                    <input type="text" id="idChat" name="idChat" value="<?php echo $value["chat"] ?>" hidden>
                                    <input type="submit" class="mainForm__form--submit fadeIn third" value="Open">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if($frontMessage){ ?>
                <p><?php echo $frontMessage ?></p>
            <?php } ?>
    </div>
</div>
