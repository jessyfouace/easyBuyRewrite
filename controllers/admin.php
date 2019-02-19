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
$db = Database::BDD();
$title = 'EasyBuy - Dashboard';
$description = 'EasyBuy - Dashboard, site de vente immobilière entre particulier.';
$imageName = 'https://easybuy-rewrite.000webhostapp.com/assets/img/logo.jpg';
$isActive = 4;

$houseManager = new HouseManager($db);
$usersManager = new UsersManager($db);
$imagesManager = new ImagesManager($db);
$ticketManager = new TicketManager($db);

require '../controllers/cookies.php';

if (isset($_SESSION['role']) and $_SESSION['role'] == 'is_admin') {
} else {
    header('location: http://localhost/EasyBuyRewrite/home');
}

if (isset($_POST['removeTicket'])) {
    $removeTicket = (int) $_POST['removeTicket'];
    $ticketManager->deleteTicketById($removeTicket);
}

if (!isset($_GET['repport']) and !isset($_GET['house']) and !isset($_GET['users'])) {
    $allHouse = $houseManager->getTenLastHouse();
    $allUsers = $usersManager->getFiveLastUser();
}

if (isset($_GET['repport'])) {
    $allTickets = $ticketManager->getTicket();
}

if (isset($_GET['house'])) {
    $allHouse = $houseManager->getAllHouse();
    $countHouse = $houseManager->countHouse();
}

if (isset($_GET['users'])) {
    $allUsers = $usersManager->getAllUsers();
    $countUsers = $usersManager->countUsers();
}
    
if (isset($_POST['banUser']) and isset($_POST['idUser'])) {
    $idUser = (int) $_POST['idUser'];
    $isCreate = $usersManager->getUserById($idUser);
    if (!empty($isCreate[0])) {
        if (!empty($isCreate[1])) {
            foreach ($isCreate[0] as $infoUser) {
                $idUser = $infoUser->getIdUser();
                $roleUser = $infoUser->getRole();
            }
            if ($roleUser != 'is_admin') {
                if (file_exists('../assets/houseImg/' . $idUser)) {
                    if (!empty(scandir('../assets/houseImg/' . $idUser))) {
                        $inFolder = scandir('../assets/houseImg/' . $idUser);
                        foreach ($inFolder as $key => $image) {
                            if ($key != '0' and $key != '1') {
                                unlink('../assets/houseImg/' . $idUser . '/' . $image);
                            }
                        }
                    }
                    rmdir('../assets/houseImg/' . $idUser);
                }
                $usersManager->removeUser($idUser);
                foreach ($isCreate[1] as $houseInfo) {
                    $houseManager->removeHouseByToken($houseInfo->getTokenAppartments());   
                }
                header('location: admin.php?users=true');
            }
        }
    }
}
require '../views/adminVue.php';