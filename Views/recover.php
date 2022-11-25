<?php require_once('header.php'); ?>
<main class="py-5">
<div class="mainForm fadeInDown">
    <section id="listado" class="mb-5">
        <div class="mainForm__container">
            <h2 class="mb-4">Recover</h2>
            <form  action="<?php echo FRONT_ROOT ?>User/PasswordChange" method="post" class="mainForm__form">

                <input type="email" name="email" value="" class="mainForm__form--input fadeIn second" placeholder="email" required>

                <input type="password" name="password" value="" class="form-control" placeholder="password" required>
                
                <input type="text" name="keyword" value="" class="form-control" placeholder="keyword" required>

                <input type="submit" class="mainForm__form--submit fadeIn second" value="Change Pass">
                
                

                <a href="<?php echo FRONT_ROOT ?>User/Index" class="fadeIn third">Cancel</a>
            </form>
        </div>
    </section>
</div>    
</main>
<?php require_once('footer.php'); ?>
