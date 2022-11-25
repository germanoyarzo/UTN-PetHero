<?php 
    require_once("validate-session.php");
    include('navOwner.php');
?>

<div class="mainForm mainFormKeeper fadeInDown">
    <div class="mainForm__container">
        <form class="mainForm__form" action="<?php echo FRONT_ROOT?>Book/StartBooking" method="POST">
            <div align="center">
                <h2 class="mainForm__form--title">ADD BOOK</h2>
            </div>
            <div class="content">
                <div class="scrollable">
                    <table style="text-align:center;">
                        <thead style="color:white">
                            <tr> 
                                <th>Pet</th>
                                <th>Size</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Selected</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($petList as $pet) { 
                            if($_SESSION["loggedUser"]->id == $pet->getIdUser()){
                        ?>
                            <tr>
                                <td><?php echo $pet->getType() ?></td>
                                <td><?php echo $pet->getSize() ?></td>
                                <td><?php echo $pet->getDescription() ?></td>
                                <td><img src="<?php echo FRONT_ROOT.IMG_PATH."pets/".$pet->getImage() ?>" alt="Pet" style="max-width: 100px;max-height: 100px;"></td>
                                <td>
                                    <input type="checkbox" class="mainForm__form--submit fadeIn third" name="petsId[]" value="<?php echo $pet->getId() ?>">
                                </td>
                            </tr>
                        <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="formSend">
                <input type="submit" class="mainForm__form--submit fadeIn third" value="Star Booking">
                <a href="<?php echo FRONT_ROOT ?>User/HomeOwner" class="formSend__cancel">Cancel</a>
            </div>
            <?php if($frontMessage){?>
                <p class="error__message" style="width: 100%;margin: 15px auto"><?php echo $frontMessage?></p>
            <?php }?>
        </form>
    </div>
</div>