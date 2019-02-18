<?php

function chargerClasse($classname)
{
    if (file_exists('../model/' . ucfirst($classname) . '.php')) {
        require '../model/' . ucfirst($classname) . '.php';
    } elseif (file_exists('../entities/' . ucfirst($classname) . '.php')) {
        require '../entities/' . ucfirst($classname) . '.php';
    } elseif (file_exists('../traits/' . ucfirst($classname) . '.php')) {
        require '../traits/' . ucfirst($classname) . '.php';
    } else {
        require '../interface/' . ucfirst($classname) . '.php';
    }
}
session_start();
spl_autoload_register('chargerClasse');
$isActive = 9;
$db = Database::BDD();
$title = 'EasyBuy - Connection / Inscription';
$description = 'EasyBuy - Accueil, site de vente immobilière entre particulier.';
$imageName = 'https://easybuy-rewrite.000webhostapp.com/assets/img/logo.jpg';

$usersManager = new UsersManager($db);

require('../controllers/connexion.php');

require('../controllers/cookies.php');

if (isset($_SESSION['mail'])) {
    header('location: http://localhost/EasyBuyRewrite/home');
}

require('../views/loginVue.php');