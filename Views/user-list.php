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
                <h2 class="mainForm__form--title">USER INFORMATION</h2>
            </div>
            <div class="content">
                <table style="text-align:center;">
                    <thead style="color:white">
                        <tr> 
                            <th>Email</th>
                            <th>Role</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Dni</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-transform: lowercase;" ><?php echo strtolower($user->getEmail()) ?></td>
                            <td><?php echo $user->getRole() ?></td>
                            <td><?php echo $user->getFirstName() ?></td>
                            <td><?php echo $user->getLastName() ?></td>
                            <td><?php echo $user->getDni() ?></td>
                            <td><?php echo $user->getPhoneNumber() ?></td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
       
    </div>
</div>