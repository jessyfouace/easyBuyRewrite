<?php if (empty($_SESSION['mail'])) { ?>
<p class="<?= $colorMessage ?> font-weight-bold text-center"><?= $messageConnexion ?></p>
<form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
    <input type="hidden" name="adress" value="<?= $_SERVER['REQUEST_URI'] ?>">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="mail" class="form-control" placeholder="Email" type="email">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input name="password" class="form-control" placeholder="******" type="password">
        </div>
    </div>
    <?php if(isset($_COOKIE['acceptation'])){ ?>
    <div class="form-group">
        <input type="checkbox" name="rememberme" id="rememberme">
        <label for="rememberme">Se souvenir de moi ?</label>
    </div>
    <?php } ?>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Connection  </button>
    </div>
    <p>Pas encore inscrit ? <a class="colororange font-weight-bold" href="login.php" target="_blank">Inscrivez vous.</a></p>
</form>
<div id="result"></div>

<?php } ?>