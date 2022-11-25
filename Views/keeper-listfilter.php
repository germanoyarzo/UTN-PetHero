<?php 
    require_once("validate-session.php");
    include('navOwner.php');
    
?>

<div class="mainForm mainFormKeeper fadeInDown">
    <div class="mainForm__container">
        <div class="mainForm__form">
            <div align="center">
                <h2 class="mainForm__form--title">KEEPERS AVAILABLE</h2>
            </div>
            <?php if(!$keeperListFilter) { ?>
            <div class="warningKeeper">
                <p class="warningKeeper__info"><strong>NO </strong>Keeper's Availables</p>
                <p class="warningKeeper__info">Please select other Date</p>
                <div class="warningKeeper__back">
                    <a href="<?php echo FRONT_ROOT?>Owner/StartBooking">Back to Start Booking</a>
                </div>
            </div>
            <?php }else{?>
            <div class="content">
                <div class="scrollable">
                    <table style="text-align:center;">
                        <thead style="color:white">
                            <tr> 
                                <th>Pet</th>
                                <th>Size</th>
                                <th>Salary</th>
                                <th>Available</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th>Total Days</th>
                                <th>Total $</th>
                                <th>Book</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($keeperListFilter as $keeper) { ?>
                        <form action="<?php echo FRONT_ROOT?>Book/Reservation" method="POST">
                            <tr>
                                <td><?php echo $keeper->getTypePet() ?></td>
                                <td><?php echo $keeper->getSize() ?></td>
                                <td><?php echo $keeper->getSalary() ?></td>
                                <td><?php echo $keeper->getAvailable() ?></td>
                                <td><?php echo $dateStartFront ?></td>
                                <td><?php echo $dateEndFront ?></td>
                                <td>
                                    <?php
                                        $datetime1 = strtotime($dateStartFront);
                                        $datetime2 = strtotime($dateEndFront);
                                        $difference = $datetime2 - $datetime1;
                                        // 1 day = 24 hours
                                        // 24 * 60 * 60 = 86400 seconds
                                        $result = abs(round($difference / 86400)) + 1; //Más un dia porque si la diferencia es cero (un dia) te pone 0 y no hay costo
                                        echo $result;
                                    ?>
                                </td>    
                                <td>
                                    <?php
                                        $amount = $result * $keeper->getSalary() * $cantPets;
                                        echo $amount;
                                    ?>
                                <td>
                                    <input type="date" name="bookDateStart" id="bookDateStart" value="<?php echo $dateStartFront ?>" hidden>
                                    <input type="date" name="bookDateEnd" id="bookDateEnd" value="<?php echo $dateEndFront ?>" hidden>
                                    <input type="number" name="bookPrice" id="bookPrice" value="<?php echo $amount ?>" hidden>
                                    <input type="number" name="keeperBookId" id="keeperBookId" value="<?php echo $keeper->getId() ?>" hidden>
                                    <input type="submit" class="mainForm__form--submit fadeIn second" value="BOOK">
                                </td>
                            </tr>
                        </form>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>