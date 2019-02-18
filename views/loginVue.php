<?php require('../views/template/header.php'); ?>
<?php 
if (!isset($_SESSION['nocookies'])) {
    if (!isset($_COOKIE['acceptation'])) {
        require("../views/cookiesVue.php");
    } else {
        $_SESSION['nocookies'] = 'true';
    }
} ?>
<div class="container login-container" style="margin-top: 100px;">
<h1 class="text-center colorgreen sizeh2 font-weight-bold"><?= $messageInscription ?></h1>
<h2 class="text-center colorred sizeh2 font-weight-bold"><?= $connectionMessage ?></h2>
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Connection</h3>
                    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email *" name="mail" id="mailremember" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Mot de passe *" name="password" value="" required/>
                        </div>
                        <?php if (isset($_COOKIE['acceptation'])) { ?>
                        <div class="form-group">
                            <input type="checkbox" name="rememberme" id="rememberme">
                            <label for="rememberme" class="text-white">Se souvenir de moi ?</label>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Connection" />
                        </div>
                    </form>
                </div>
                <div class="col-md-6 login-form-2">
                    <div class="login-logo d-none d-md-block">
                        <img src="assets/img/bicon.png" alt="icon easyBuy"/>
                    </div>
                    <h3>Inscription</h3>
                    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email *" name="createMail" value="" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Prénom *" name="createFirstname" value="" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nom *" name="createLastname" value="" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Mot de passe *" name="createPassword" value="" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Vérification mot de passe *" name="verifCreatePassword" value="" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Inscription" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php require('../views/template/footer.php'); ?>