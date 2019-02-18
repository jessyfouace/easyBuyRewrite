<?php

function chargerClasse($classname)
{
    if (file_exists('../model/'. ucfirst($classname).'.php')) {
        require '../model/'. ucfirst($classname).'.php';
    } elseif (file_exists('../entities/'. ucfirst($classname).'.php')) {
        require '../entities/'. ucfirst($classname).'.php';
    } elseif (file_exists('../traits/'. ucfirst($classname).'.php')) {
        require '../traits/'. ucfirst($classname).'.php';
    } else {
        require '../interface/'. ucfirst($classname).'.php';
    }
}
session_start();
spl_autoload_register('chargerClasse');
$title = 'EasyBuy - Accueil';
$isActive = 1;
$db = Database::BDD();

$departments = new DepartmentsManager($db);
$houseManager = new HouseManager($db);
$usersManager = new UsersManager($db);

$allDepartments = $departments->getDepartments();
$fiveLastHouse = $houseManager->getFiveLastHouse();

$allDepartmentsOnTable = [];
foreach ($allDepartments as $department) {
    array_push($allDepartmentsOnTable, $department->getDepartmentsName());
}

require '../controllers/cookies.php';

require "../views/indexVue.php";