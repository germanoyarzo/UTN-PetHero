<?php 
    require_once("validate-session.php");
    include('navOwner.php');
?>

<div class="mainListPet">
    <div class="mainListPet__container" id="scrollBar">
        <table class="mainListPet__table" style="text-align:center;">
            <thead>
                <tr>
                    <th>Pet</th>
                    <th>Race</th>
                    <th>Size</th>
                    <th>Vaccination</th>
                    <th>Description</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($petList as $pet) { 
                if($_SESSION["loggedUser"]->id == $pet->getIdUser()){
            ?>
                <tr>
                    <td><?php echo $pet->getType() ?></td>
                    <td><?php echo $pet->getRace() ?></td>
                    <td><?php echo $pet->getSize() ?></td>
                    <td><img src="<?php echo FRONT_ROOT.IMG_PATH."vaccination/".$pet->getVaccination() ?>" alt="Pet Vaccination"></td>
                    <td><?php echo $pet->getDescription() ?></td>
                    <td><img src="<?php echo FRONT_ROOT.IMG_PATH."pets/".$pet->getImage() ?>" alt="Pet"></td>
                </tr>
            <?php } }?>
            </tbody>
        </table>
    </div>
</div>