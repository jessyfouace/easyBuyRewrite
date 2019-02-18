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
$title = 'EasyBuy - Plus de biens';
$isActive = 3;
$db = Database::BDD();

$departments = new DepartmentsManager($db);
$houseManager = new HouseManager($db);
$usersManager = new UsersManager($db);

$allDepartments = $departments->getDepartments();


if (!isset($_GET['page'])) {
    header('location: http://localhost/EasyBuyRewrite/biens/1');
}

if (isset($_GET['departments']) and isset($_GET['onetime'])) {
    header('location: http://localhost/EasyBuyRewrite/biens/1/' . $_GET["departments"]);
}

$arrayOfDepartments = [];
foreach ($allDepartments as $oneDepartment) {
    $arrayOfDepartments[] = $oneDepartment->getId();
}

$arrayOfDepartmentsName = [];
foreach ($allDepartments as $oneDepartment) {
    $arrayOfDepartmentsName[$oneDepartment->getId()] = $oneDepartment->getDepartmentsName();
}

if (!isset($_GET['departments'])) {
    $allCount = $houseManager->countHouse();
} else {
    $departmentsName = $_GET['departments'];
    if (is_string($_GET['departments'])) {
        if (in_array($_GET['departments'], $arrayOfDepartmentsName)) {
            foreach ($arrayOfDepartmentsName as $key => $name) {
                if ($name == $_GET['departments']) {
                    $departmentsName = (int)$key;
                    break;
                }
            }
        } else {
            $errorMessage = 'Aucun bien n\'as étais trouver sur votre recherche';
            $allCount = $houseManager->countHouse();
        }
        $allCount = $houseManager->countHouseByDepartments($departmentsName);
    } else {
        $allCount = $houseManager->countHouse();
    }
}
foreach ($allCount as $count) {
    $allCount = $count;
}
$messagePearPage = 5;


$numberOfPage = ceil($allCount / $messagePearPage);

// if ($_GET['page'] > $numberOfPage) {
//     header('location: moreHouse.php?page=1');
// }

if (isset($_GET['page'])) {
    $actualPage = intval($_GET['page']);

    if ($actualPage > $numberOfPage) {
        $actualPage = $numberOfPage;
    }
} else {
    $actualPage = 1;
}

$firstEntry = ($actualPage - 1) * $messagePearPage;
$errorMessage = '';
if (!isset($_GET['departments'])) {
    $returnMessage = $houseManager->paginationHouse($firstEntry, $messagePearPage);
} else {
    if (is_string($_GET['departments'])) {
        if (in_array($_GET['departments'], $arrayOfDepartmentsName)) {
            foreach ($arrayOfDepartmentsName as $key => $name) {
                if ($name == $_GET['departments']) {
                    $departmentsName = (int) $key;
                    break;
                }
            }
        } else {
            $errorMessage = 'Aucun bien n\'as étais trouver sur votre recherche';
            $returnMessage = $houseManager->paginationHouse($firstEntry, $messagePearPage);
        }
    }
    if (in_array($departmentsName, $arrayOfDepartments)) {
        $returnMessage = $houseManager->paginationHouseDepartments($firstEntry, $messagePearPage, $departmentsName);
        if (empty($returnMessage[0])) {
            $errorMessage = 'Aucun bien n\'as étais trouver sur votre recherche';
        }
    } else {
        $errorMessage = 'Aucun bien n\'as étais trouver sur votre recherche';
        $returnMessage = $houseManager->paginationHouse($firstEntry, $messagePearPage);
    }
}

require '../controllers/cookies.php';

require "../views/moreHouseVue.php";