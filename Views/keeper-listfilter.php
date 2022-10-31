<?php 
    require_once("validate-session.php");
    include('navOwner.php');
?>

<div class="mainForm mainFormKeeper fadeInDown">
    <div class="mainForm__container">
        <form class="mainForm__form" action="<?php echo FRONT_ROOT?>Book/Reservation" method="POST">
            <div align="center">
                <h2 class="mainForm__form--title">KEEPER´S AVAILABILITY</h2>
            </div>
            <?php if(!$keeperListFilter) { ?>
            <div class="warningKeeper">
                <p class="warningKeeper__info"><strong>NO </strong>Keeper's Availables</p>
                <p class="warningKeeper__info">Please select other Date</p>
                <div class="warningKeeper__back">
                    <a href="<?php echo FRONT_ROOT?>Owner/ShowListKeeperView">Back to Keeper's List</a>
                </div>
            </div>
            <?php }else{?>
            <div class="content">
                <div class="scrollable">
                    <table style="text-align:center;">
                        <thead style="color:white">
                            <tr> 
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
                            <tr>
                                
                                <td><?php echo $keeper->getSize() ?></td>
                                <td><?php echo $keeper->getSalary() ?></td>
                                <td><?php echo $keeper->getAvailable() ?></td>
                                <td><?php echo $keeper->getDateStart() ?></td>
                                <td><?php echo $keeper->getDateEnd() ?></td>
                                <td>
                                    <?php
                                        $datetime1 = strtotime($keeper->getDateStart());
                                        $datetime2 = strtotime($keeper->getDateEnd());
                                        $difference = $datetime2 - $datetime1;
                                        // 1 day = 24 hours
                                        // 24 * 60 * 60 = 86400 seconds
                                        $result = abs(round($difference / 86400));
                                        echo $result;
                                        
                                    ?>
                                </td>    
                                <td>
                                    <?php
                                        $amount= $result * $keeper->getSalary();
                                        echo $amount;
                                    ?>
                                <td>
                                    <!--<input type="submit" class="fadeIn fourth" value="Reservation" >-->
                                    <a id="idKeeper" href="<?php echo FRONT_ROOT."Book/Reservation/".$keeper->getId();?>" class="fadeIn fourth" value="Reservation">Reservation</a>
                                </td>
                           
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } ?>
        </form>
    </div>
</div>