<?php
include("template/header.php"); ?>
<?php 
if (!isset($_SESSION['nocookies'])) {
    if (!isset($_COOKIE['acceptation'])) {
        require("../views/cookiesVue.php");
    } else {
        $_SESSION['nocookies'] = 'true';
    }
} ?>

<div style="margin-top: 100px;">
    <div class="container">
        <div class="row my-2">
            <div class="col-lg-8 order-lg-2 mx-auto">
                <p class="colorgreen sizeh2 text-center font-weight-bold"><?= $messageOk ?></p>
                <p class="colorred sizeh2 text-center font-weight-bold"><?= $messageNo ?></p>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Profil</a>
                    </li>
                    <?php if (isset($_SESSION['idUser'])) {
                        if ($_SESSION['idUser'] == $_GET['idUserProfil']) { ?>
                    <li class="nav-item">
                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Messages</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Modifier</a>
                    </li>
                    <?php }
                    } ?>
                    <?php if (isset($_SESSION['idUser'])) {
                        if ($_SESSION['idUser'] != $_GET['idUserProfil']) { ?>
                    <li class="nav-item">
                        <a href="" data-target="#contactUser" data-toggle="tab" class="nav-link">Contacter</a>
                    </li>
                    <?php }
                    } ?>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                    <?php foreach ($infoUser[0] as $user) { ?>
                        <h1 class="sizeh2 mb-3"><?= $user->getFirstname() . ' ' . $user->getLastname() ?></h1>
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="sizeh2 font-weight-bold">Rôle</h2>
                                <?php if ($user->getRole() == 'is_admin') { ?>
                                    <p>Administrateur</p>
                                <?php } else { ?>
                                    <p>Utilisateur</p>
                                <?php } ?>
                                <h2 class="sizeh2 font-weight-bold">Contacter</h2>
                                <p><?= $user->getMail() ?></p>

                            </div>
                            <div class="col-md-12">
                                <h5 class="mt-2"><span class="font-weight-bold"> Ajouts récent</span></h5>
                                <table class="table table-sm table-hover table-striped">
                                    <tbody>    
                                    <?php foreach ($infoUser[1] as $house) { ?>                                
                                        <tr>
                                            <td>
                                                <a href="http://localhost/EasyBuyRewrite/detail/<?= $house->getTokenAppartments() ?>"><?= $house->getTitle(); ?></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="nohover">
                                                <p class="price font-weight-bold"><?= substr(number_format($house->getPrice(), 2, ',', ' '), 0, -3) ?> €</p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane" id="messages">
                    <?php foreach ($infoMessage[0] as $text) { ?>
                        <?php foreach ($infoMessage[1] as $message) { ?>
                            <div>
                                <p style="border-radius: 0px; border-bottom: 0px;" class="alert alert-info sizeh2 mt-2 mb-0">En provenance de: <a class="colororange" href="http://localhost/EasyBuyRewrite/profil/<?= $message->getIdUser() ?>"><?= $message->getFirstname() . ' ' . $message->getLastname() ?></a></p>
                                <p style="border-radius: 0px; border-top: 0px;" class="alert alert-info mt-0 mb-0">Mail: <?= $message->getMail(); ?></p>
                                <?php if ($text->getUserIdSender() == $message->getIdUser()) { ?> 
                                <p style="border-radius: 0px; border-bottom: 0px;" class="alert alert-secondary mt-0 mb-0">Objet: <?= $text->getObject(); ?></p>
                                <p style="border-radius: 0px; border-top: 0px;" class="alert alert-secondary mt-0 mb-0"><?= $text->getText(); ?></p>
                                <form class="mt-0 mb-4" action="" method="post">
                                    <input type="hidden" name="messageId" value="<?= $text->getIdMessage() ?>">
                                    <input type="submit" class="btn btn-danger col-12" name="removeMessage" value="Supprimer le message">
                                </form>  
                                <?php
                                } ?>
                            </div>
                            <?php break; ?> 
                        <?php }
                    } ?>
                    </div>
                    <?php if (isset($_SESSION['idUser'])) {
                        if ($_SESSION['idUser'] == $_GET['idUserProfil']) { ?>
                    <div class="tab-pane" id="edit">
                        <form role="form" method="post">
                            <?php foreach ($infoUser[0] as $user) { ?>
                            <div class="form-group">
                                <label class="col-form-label form-control-label">Prénom</label>
                                <div class="col-12 m-0 p-0">
                                    <input class="form-control" type="text" name="firstname" value="<?= $user->getFirstname() ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label form-control-label">Nom</label>
                                <div class="col-12 m-0 p-0">
                                    <input class="form-control" type="text" name="lastname" value="<?= $user->getLastname() ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label form-control-label">Email</label>
                                <div class="col-12 m-0 p-0">
                                    <input class="form-control" type="email" name="mail" value="<?= $user->getMail() ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label form-control-label">Ancien mot de passe</label>
                                <div class="col-12 m-0 p-0">
                                    <input class="form-control" type="password" name="lastpassword" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label form-control-label">Nouveau mot de passe</label>
                                <div class="col-12 m-0 p-0">
                                    <input class="form-control" type="password" name="newpassword" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label form-control-label">Confirmation mot de passe</label>
                                <div class="col-12 m-0 p-0">
                                    <input class="form-control" type="password" name="confirmnewpassword" value="">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                                <label class="col-form-label form-control-label"></label>
                                <div class="col-12 text-center">
                                    <input type="reset" class="btn btn-secondary" value="Annuler">
                                    <input type="submit" class="btn btn-primary" name="edit" value="Sauvegarder">
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php }
                    } ?>
                    <?php if (isset($_SESSION['idUser'])) {
                        if ($_SESSION['idUser'] != $_GET['idUserProfil']) { ?>
                    <div class="tab-pane" id="contactUser">
                            <div class="col-md-10 col-12 mx-auto m-0 p-0">
                                <div class="col-md-11 col-12 mx-auto">
                                    <div class="card">
                                        <article class="card-body">
                                            <?php if (!isset($_SESSION['mail'])) {
                                                require('../views/connexionVue.php');
                                            } else { ?>
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
                                                        </div>
                                                        <input name="" class="form-control" value="<?= $_SESSION['mail'] ?>" type="email" disabled>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="userIdTaker" value="<?= $_GET['idUserProfil']; ?>">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label class="w-100" for="object">Objet:</label>
                                                        <input type="text" name="object" id="object" class="form-control" placeholder='Objet' rows="5"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label class="w-100" for="text">Message:</label>
                                                        <textarea name="text" id="text" class="form-control" placeholder="..." rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn orangebg text-white btn-block"> Envoyer  </button>
                                                </div>
                                            </form>
                                            <?php 
                                        } ?>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            <?php 
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("template/footer.php"); ?>