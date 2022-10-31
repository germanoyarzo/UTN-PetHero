<?php 
    require_once("validate-session.php");
    if($_SESSION["loggedUser"]->getRole() === "Owner")
    {
        include('navOwner.php');
    }else{
        include('navKeeper.php');
    }
    use DAO\UserDAOBD as UserDAOBD;
    use DAO\KeeperDAOBD as KeeperDAOBD;
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
                            <th>ID BOOK</th>
                            <th>SIZE PET</th>
                            <th>DATE START</th>
                            <th>DATE END</th>
                            <th>OWNER NAME</th>
                            <th>OWNER LAST NAME</th>
                            <th>Total Days</th>
                            <th>Total $</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach($bookList as $book) {
                        $userDAOBD= new UserDAOBD();
                        $userId=$userDAOBD->GetById($book->getIdUser());

                        $keeperDAOBD= new KeeperDAOBD();
                        $keeperId=$keeperDAOBD->GetById($book->getIdKeeper());

                        ?>
                        <tr>
                            <td><?php echo $book->getId() ?></td>
                            <td><?php echo $keeperId->getSize() ?></td>
                            <td><?php echo $keeperId->getDateStart() ?></td>
                            <td><?php echo $keeperId->getDateEnd() ?></td>
                            <td><?php echo $userId->getFirstName()?></td>
                            <td><?php echo $userId->getLastName() ?></td>
                            <td>
                                <?php
                                    //***total days */
                                    $datetime1 = strtotime($keeperId->getDateStart());
                                    $datetime2 = strtotime($keeperId->getDateEnd());
                                    $difference = $datetime2 - $datetime1;
                                    // 1 day = 24 hours
                                    // 24 * 60 * 60 = 86400 seconds
                                    $result = abs(round($difference / 86400));
                                    echo $result;
                                    
                                ?>
                            </td>   
                            <td>
                                <?php
                                    $amount= $result * $keeperId->getSalary();
                                    echo $amount;
                                ?>
                            </td> 
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if($message){ ?>
                <p><?php echo $message ?></p>
            <?php } ?>
    </div>
</div>
