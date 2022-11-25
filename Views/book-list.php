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
                <h2 class="mainForm__form--title">BOOK´S LIST</h2>
            </div>
            <hr class="separator">
            <div class="content">
                <table style="text-align:center;">
                    <thead style="color:white">
                        <tr> 
                            <?php if($_SESSION["loggedUser"]->getRole() == "Owner"){ ?>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Book Price</th>
                            <th>Status</th>
                            <th>Payed</th>
                            <th>Action</th>
                            <?php }else{?>
                            <th>ID Owner</th>
                            <th>ID Keeper</th>
                            <th>Pet Type</th>
                            <th>Pet Size</th>
                            <th>Date Start</th>
                            <th>Date End</th>
                            <th>Book Price</th>
                            <th>Status</th>
                            <th>Payed</th>
                            <th>Accept Book</th>
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if($_SESSION["loggedUser"]->getRole() == "Owner"){
                        foreach($bookListFront as $book) {
                    ?>
                        <tr>
                            <td><?php echo $book->getDateStart() ?></td>
                            <td><?php echo $book->getDateEnd() ?></td>
                            <td><?php echo $book->getBookPrice() ?></td>
                            <td><?php echo $book->getStatus() ?></td>
                            <td><?php echo $book->getPayed() ?></td>
                            <?php if($book->getPayed() != "payed"){?>
                            <?php if($book->getStatus() != "pending"){?>
                            <td><a  href="<?php echo FRONT_ROOT."Book/PaymentReservation/".$book->getId() ?>">Pay</a></td>
                            <?php }else{ ?>
                            <td style="color: #ff5959;font-weight: 500;">Wait confirmation</td>
                            <?php }}else{ ?>
                                <td style="color: #0eb30e;font-weight: bold;">Confirmed</td>
                            <?php } ?>
                        </tr>
                    <?php }}else{
                        foreach($bookListFront as $book) {
                    ?>
                        <tr>
                            <td><?php echo $book->getIdOwner() ?></td>
                            <td><?php echo $book->getIdKeeperBook() ?></td>
                            <td><?php echo $book->getPetType() ?></td>
                            <td><?php echo $book->getPetSize() ?></td>
                            <td><?php echo $book->getDateStart() ?></td>
                            <td><?php echo $book->getDateEnd() ?></td>
                            <td><?php echo $book->getBookPrice() ?></td>
                            <td><?php echo $book->getStatus() ?></td>
                            <td><?php echo $book->getPayed() ?></td>
                            <?php if($book->getStatus() != "confirmed"){?>
                            <td><a  href="<?php echo FRONT_ROOT."Book/ConfirmReservation/".$book->getId() ?>">Confirm</a></td>
                            <?php }else{ ?>
                                <td style="color: #0eb30e;font-weight: bold;">Confirmed</td>
                            <?php } ?>
                        </tr>
                    <?php }}?>
                    </tbody>
                </table>
            </div>
            <?php if($frontMessage){ ?>
                <p><?php echo $frontMessage ?></p>
            <?php } ?>
    </div>
</div>
