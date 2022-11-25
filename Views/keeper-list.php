<?php 
    require_once("validate-session.php");
    include('navOwner.php');
?>

<div class="mainForm mainFormKeeper fadeInDown">
    <div class="mainForm__container">
        <form class="mainForm__form" action="<?php echo FRONT_ROOT?>Keeper/CheckAvailability" method="POST">
            <div align="center">
                <h2 class="mainForm__form--title">KEEPER´S LIST</h2>
            </div>
            <h2 class="mainFormKeeper__filter--title">APPLY FILTER DATE</h2>
            <div class="mainForm__form--calendars">
                <div class="calendar__item">
                    <p>Start</p>
                    <input align="left" type="date" name="dateStart" id="dateStart" class="form-control" aria-label="..." required>
                </div>
                <div class="calendar__item">
                    <p>End</p>
                    <input align="right" type="date" name="dateEnd" id="dateEnd" class="form-control" aria-label="..." required>
                </div>
            </div>
            <hr class="separator">
            <div class="content">
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
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($keeperList as $keeper) { ?>
                        <tr>
                            <td><?php echo $keeper->getTypePet() ?></td>
                            <td><?php echo $keeper->getSize() ?></td>
                            <td><?php echo $keeper->getSalary() ?></td>
                            <td><?php echo $keeper->getAvailable() ?></td>
                            <td><?php echo $keeper->getDateStart() ?></td>
                            <td><?php echo $keeper->getDateEnd() ?></td>
                            <td>
                                <?php
                                    /* total days */
                                    $datetime1 = strtotime($keeper->getDateStart());
                                    $datetime2 = strtotime($keeper->getDateEnd());
                                    $difference = $datetime2 - $datetime1;
                                    // 1 day = 24 hours
                                    // 24 * 60 * 60 = 86400 seconds
                                    $result = abs(round($difference / 86400));
                                    echo $result;
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if($frontMessage){ ?>
                <p><?php echo $frontMessage ?></p>
            <?php } ?>

            <div align="center">
                <input type="submit" class="mainForm__form--submit fadeIn second" value="Check Availabilty Keeper">
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('dateStart').setAttribute('min', new Date().toISOString().split('T')[0])
    document.getElementById('dateEnd').setAttribute('min', new Date().toISOString().split('T')[0])    
</script>
