<?php require('../views/template/header.php') ?>

<div style="margin-top: 90px;" class="container-fluid" id="wrapper">
    <div class="row">
        <nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">                                                
            <ul class="nav nav-pills flex-column sidebar-nav">
                <li class="nav-item"><a class="nav-link <?php if (!isset($_GET['repport']) and !isset($_GET['house']) and !isset($_GET['users'])) { ?> text-white orangebg <?php } ?>" href="http://localhost/EasyBuyRewrite/admin"><em class="fa fa-dashboard"></em> Pannel<span class="sr-only">(current)</span></a></li>
                <li class="nav-item"><a class="nav-link <?php if (isset($_GET['repport']) and $_GET['repport'] == 'true') { ?> text-white orangebg <?php }?>" href="http://localhost/EasyBuyRewrite/admin/plaintes"><em class="fa fa-calendar-o"></em> Plaintes</a></li>
                <li class="nav-item"><a class="nav-link <?php if (isset($_GET['house']) and $_GET['house'] == 'true') { ?> text-white orangebg <?php }?>" href="http://localhost/EasyBuyRewrite/admin/biens"><em class="fa fa-bar-chart"></em> Biens</a></li>
                <li class="nav-item"><a class="nav-link <?php if (isset($_GET['users']) and $_GET['users'] == 'true') { ?> text-white orangebg <?php }?>" href="http://localhost/EasyBuyRewrite/admin/utilisateurs"><em class="fa fa-hand-o-up"></em> Utilisateurs</a></li>
            </ul>
        </nav>
        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
            <header class="page-header row justify-center">
                <div class="col-12" >
                    <h1 class="float-left text-center text-md-left">Pannel Administrateur</h1>
                </div>
            </header>
            <section class="row <?php if (isset($_GET['repport']) or isset($_GET['house']) or isset($_GET['users'])) { ?> d-none <?php } ?>">
                <div class="col-sm-12">
                    <section class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="card mb-4">
                                <div class="card-block">
                                    <h3 class="card-title">Ajouts récent</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Identifiant</th>
                                                    <th>Prix</th>
                                                    <th>Vendeur</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($allHouse[0] as $houseInfo) { ?>
                                                <tr>
                                                    <td class="font-weight-bold"><a href="http://localhost/EasyBuyRewrite/detail/<?= $houseInfo->getTokenAppartments(); ?>"><?= substr($houseInfo->getTitle(), 0 , 28); ?>..</a></td>
                                                    <td class="font-weight-bold"><?= $houseInfo->getTokenAppartments(); ?></td>
                                                    <td class="price font-weight-bold"><?= substr(number_format($houseInfo->getPrice(), 2, ',', '&nbsp;'), 0, -3) ?>&nbsp;€</td>
                                                        <?php foreach ($allHouse[1] as $userInfo) { 
                                                        if ($houseInfo->getUserId() == $userInfo->getIdUser()) {
                                                        ?>
                                                    <td class="colororange font-weight-bold"><a href="http://localhost/EasyBuyRewrite/profil/<?= $userInfo->getIdUser() ?>"><?= $userInfo->getFirstname() . '&nbsp;' . $userInfo->getLastname() ?></a></td>
                                                        <?php
                                                        break;
                                                        } 
                                                    } ?> 
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="card mb-4">
                                <div class="card-block">
                                    <h3 class="card-title">Derniers inscrit</h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody>
                                                <?php foreach ($allUsers as $user) { ?>
                                                <tr>
                                                    <td class="font-weight-bold"><a href="http://localhost/EasyBuyRewrite/profil/<?= $user->getIdUser() ?>"><?= $user->getFirstname() . ' ' . $user->getLastname(); ?></a></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>

            <section class="<?php if (!isset($_GET['repport']) and $_GET['repport'] != 'true') { ?> d-none <?php }?>">
                <div class="col-md-12 col-lg-8">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Numéro de ticket</th>
                                    <th>Créateur Ticket</th>
                                    <th>Appartement</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($allTickets[0] as $ticket) { ?>
                                <tr>
                                    <td><?= $ticket->getIdTicket() ?></td>
                                    <?php foreach ($allTickets[1] as $ticketCreator){ 
                                    if ($ticketCreator->getIdUser() == $ticket->getIdCreatorTicket()) { ?>
                                    <td><a href="http://localhost/EasyBuyRewrite/profil/<?= $ticketCreator->getIdUser() ?>"><?= $ticketCreator->getFirstname() . ' ' . $ticketCreator->getLastname() ?></td>
                                    <?php break; 
                                        }
                                    } ?>
                                    <?php foreach ($allTickets[2] as $houseTicket) {
                                        if ($houseTicket->getIdAppartments() == $ticket->getIdappartmentsTicket()) { ?>
                                    <td><a href="http://localhost/EasyBuyRewrite/detail/<?= $houseTicket->getTokenAppartments() ?>"><?= substr($houseTicket->getTitle(), 0, 35) ?>...</a></td>
                                    <?php break; 
                                        }
                                    } ?>
                                    <td><form action="" method="post"><input type="hidden" name="removeTicket" value="<?= $ticket->getIdTicket() ?>"><input type="submit" class="btn btn-danger" value="Supprimer"></form></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section class="<?php if (!isset($_GET['house']) and $_GET['house'] != 'true') { ?> d-none <?php }?>">
                <div class="col-md-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-block">
                            <?php foreach ($countHouse as $toString) { ?>
                            <h3 class="card-title"><?= $toString ?> Biens</h3>
                            <?php } ?>
                            <div class="table-responsive">
                            <div id="houses">
                                <div class="row col-12 m-0 p-0 mb-2">
                                    <input class="search form-control col-12 col-md-11" placeholder="Rechercher" />
                                    <button class="sort btn btn-info col-12 col-md-1" data-sort="name">Trier</button>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Identifiant</th>
                                            <th>Prix</th>
                                            <th>Vendeur</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php foreach ($allHouse[0] as $houseInfo) { ?>
                                        <tr>
                                            <td class="titleHouse font-weight-bold"><a href="http://localhost/EasyBuyRewrite/detail/<?= $houseInfo->getTokenAppartments(); ?>"><?= substr($houseInfo->getTitle(), 0, 28); ?>..</a></td>
                                            <td class="tokenHouse font-weight-bold"><?= $houseInfo->getTokenAppartments(); ?></td>
                                            <td class="price font-weight-bold"><?= substr(number_format($houseInfo->getPrice(), 2, ',', '&nbsp;'), 0, -3) ?>&nbsp;€</td>
                                                <?php foreach ($allHouse[1] as $userInfo) {
                                                    if ($houseInfo->getUserId() == $userInfo->getIdUser()) {
                                                        ?>
                                            <td class="creatorHouse colororange font-weight-bold"><a href="http://localhost/EasyBuyRewrite/profil/<?= $userInfo->getIdUser() ?>"><?= $userInfo->getFirstname() . '&nbsp;' . $userInfo->getLastname() ?></a></td>
                                                <?php
                                                break;
                                            }
                                        } ?> 
                                        </tr>
                                        <?php 
                                    } ?>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="<?php if (!isset($_GET['users']) and $_GET['users'] != 'true') { ?> d-none <?php }?>">
                <div class="col-md-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-block">
                            <?php foreach ($countUsers as $toString) { ?>
                            <h3 class="card-title"><?= $toString ?> Utilisateurs</h3>
                            <?php 
                        } ?>
                            <div class="table-responsive">
                            <div id="users">
                                <div class="row col-12 m-0 p-0 mb-2">
                                    <input class="search form-control col-12" placeholder="Rechercher" />
                                    <button class="sort btn btn-info col-12" data-sort="name">Trier</button>
                                </div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Prénom</th>
                                            <th>Prix</th>
                                            <th>Mail</th>
                                            <th>Profil</th>
                                            <th>Bannir</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php foreach ($allUsers as $userInfo) { ?>
                                        <tr>
                                            <td class="firstname"><?= $userInfo->getFirstname() ?></td>
                                            <td class="lastname"><?= $userInfo->getLastname() ?></td>
                                            <td class="mail"><?= $userInfo->getMail() ?></td>
                                            <td><a class="btn btn-info" href="http://localhost/EasyBuyRewrite/profil/<?= $userInfo->getIdUser() ?>">Profil</a></td>
                                            <td><form action="" method="post"><input class="btn btn-danger" type="submit" name="banUser" value="Bannir"><input type="hidden" name="idUser" value="<?= $userInfo->getIdUser() ?>"></form></td>
                                        </tr>
                                        <?php 
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>
<?php require('../views/template/footer.php') ?>
<script>
var options = {
  valueNames: [ 'firstname', 'lastname', 'mail' ]
};

var userList = new List('users', options);

var optionsHouse = {
  valueNames: [ 'titleHouse', 'tokenHouse', 'creatorHouse' ]
};

var houseList = new List('houses', optionsHouse);
</script>