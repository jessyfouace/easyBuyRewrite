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
$title = 'EasyBuy - Ajouter un biens';
$description = 'EasyBuy - Accueil, site de vente immobilière entre particulier.';
$imageName = 'https://easybuy-rewrite.000webhostapp.com/assets/img/logo.jpg';
$isActive = 9;
$db = Database::BDD();

$usersManager = new UsersManager($db);

require '../controllers/cookies.php';

if (isset($_SESSION['mail'])) {
} else {
    header('location: http://localhost/EasyBuyRewrite/home');
}

$departments = new DepartmentsManager($db);
$imageManager = new ImagesManager($db);
$houseManager = new HouseManager($db);

$allDepartments = $departments->getDepartments();
$houseByToken = $houseManager->getHouseByToken($_GET['houseIdentification']);

if (!empty($houseByToken[0])) {
    foreach ($houseByToken[0] as $houseInfo) {
        if ($_SESSION['idUser'] == $houseInfo->getUserId() or $_SESSION['role'] == 'is_admin') {
        } else {
            header('location: http://localhost/EasyBuyRewrite/home');
        }
    }
} else {
    header('location: http://localhost/EasyBuyRewrite/home');
}

$allDepartmentsOnTable = [];
foreach ($allDepartments as $department) {
    array_push($allDepartmentsOnTable, $department->getDepartmentsName());
}

$errorTitle = '';
$errorDesc = '';
$errorDepartments = '';
$errorCity = '';
$errorArea = '';
$errorBedrooms = '';
$errorBathrooms = '';
$errorRooms = '';
$errorOrientation = '';
$errorPrice = '';

foreach ($houseByToken[0] as $infoHouse) {
    $lastTitle = $infoHouse->getTitle();
    $lastDesc = $infoHouse->getDescription();
    foreach ($houseByToken[2] as $departmentInfo) {
        $lastDepartments = $departmentInfo->getDepartmentsName();
    }
    $lastCity = $infoHouse->getCity();
    $lastArea = $infoHouse->getArea();
    $lastBedrooms = $infoHouse->getBedroom();
    $lastBathrooms = $infoHouse->getBathroom();
    $lastRooms = $infoHouse->getRooms();
    $lastPrice = $infoHouse->getPrice();
    $idImageForRemove = $infoHouse->getImagesId();
    $tokenAppartments = $infoHouse->getTokenAppartments();
}

foreach ($houseByToken[1] as $image) {
    $nameImages = $image->getLink();
    $explode = explode(' ', $image->getLink());
}

for ($i=0; $i < 5; $i++) {
    if (isset($_POST['lastImage' . $i])) {
        $linkImage = $_POST['lastImage' . $i];
        $explodeTest = explode('/', $linkImage);
        if (isset($explodeTest[4]) and isset($explodeTest[5]) and isset($explodeTest[6]) and isset($explodeTest[7]) and !isset($explodeTest[8])) {
            if ($explodeTest[4] == 'assets' and $explodeTest[5] == 'houseImg' and $explodeTest[6] == $_SESSION['idUser'] or $_SESSION['role'] == 'is_admin') {
                unlink('../' . $explodeTest[4] . '/' . $explodeTest[5] . '/' . $explodeTest[6] . '/' . $explodeTest[7]);
                $nameImages = str_replace(' ' . $_POST['lastImage' . $i], '', $nameImages);
                $imageManager->updateImageById($idImageForRemove, $nameImages);
                header('location: ' . $_SERVER['REQUEST_URI']);
            }
        }
        print_r($explodeTest);
        break;
    }
}
    

$errorNumberImage = '';
$messageImage = '';
$errorImage = '';

$colorgreen = 'colorgreen';
$colorred = 'colorred';

$finish = '';
$goodFinish = '';

$error = true;

    if (!empty($_POST['title'])) {
        $titles = htmlspecialchars($_POST['title']);
        $lastTitle = $titles;
        if (!empty($_POST['desc'])) {
            $desc = nl2br($_POST['desc']);
            $desc = htmlspecialchars($_POST['desc']);
            $lastDesc = $desc;
            if (!empty($_POST['departments'])) {
                $departmentsSecure = $_POST['departments'];
                $lastDepartments = $departmentsSecure;
                if (in_array($_POST['departments'], $allDepartmentsOnTable)) {
                    $departmentsSecure = $_POST['departments'];
                    $lastDepartments = $departmentsSecure;
                    if (!empty($_POST['city'])) {
                        $city = htmlspecialchars($_POST['city']);
                        $lastCity = $city;
                        if (!empty($_POST['area'])) {
                            $area = (int)$_POST['area'];
                            $lastArea = $area;
                            if (!empty($_POST['bedrooms'])) {
                                $bedrooms = (int)$_POST['bedrooms'];
                                $lastBedrooms = $bedrooms;
                                if (!empty($_POST['bathrooms'])) {
                                    $bathrooms = (int)$_POST['bathrooms'];
                                    $lastBathrooms = $bathrooms;
                                    if (!empty($_POST['rooms'])) {
                                        $rooms = (int)$_POST['rooms'];
                                        $lastRooms = (int)$rooms;
                                        if (!empty($_POST['orientation']) and $_POST['orientation'] == 'Nord' or $_POST['orientation'] == 'Sud' or $_POST['orientation'] == 'Ouest' or $_POST['orientation'] == 'Est') {
                                            $orientation = htmlspecialchars($_POST['orientation']);
                                            if (!empty($_POST['price'])) {
                                                $price = (int)$_POST['price'];
                                                $lastPrice = $price;
                                                if (!empty($_POST['numberImage'])) {
                                                    $error = false;
                                                    $numberImage = (int)$_POST['numberImage'];
                                                    $tableOfImage = [];
                                                    for ($i = 1; $i < $numberImage + 1; $i++) {
                                                        $tableOfImage[] = 'image' . $i;
                                                    }
                                                    $newTableOfImage = [];
                                                    foreach ($tableOfImage as $image) {
                                                        if (!empty($_FILES[$image]['name'])) {
                                                            $newTableOfImage[] = $_FILES[$image];
                                                        } else {
                                                            $error = true;
                                                            break;
                                                        }
                                                    }
                                                    if ($error == false) {
                                                        if (is_dir('../assets/houseImg/' . $_SESSION['idUser'])) {
                                                        } else {
                                                            mkdir('../assets/houseImg/' . $_SESSION['idUser'], 0777, true);
                                                        }
                                                        $tableOkImage = [];
                                                        foreach ($newTableOfImage as $image) {
                                                            $fileName = str_replace(' ', '', $image["name"]);
                                                            $target_dir = '../assets/houseImg/' . $_SESSION['idUser'] . '/';
                                                            $target_file = $target_dir . basename(str_replace(' ', '', $image["name"]));
                                                            $uploadOk = 1;
                                                            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                                            $addImage = new AddImages([
                                                                'target_dir' => $target_dir,
                                                                'target_file' => $target_file,
                                                                'uploadOk' => $uploadOk,
                                                                'imageFileType' => $imageFileType,
                                                                'tmpname' => $image["tmp_name"],
                                                                'fileName' => $fileName
                                                            ]);
                                                            $message = $addImage->checkImage($addImage);
                                                            if ($addImage->getUploadOk() == 1) {
                                                                $uploadOk = $addImage->getUploadOk();
                                                                $tableOkImage[] = str_replace(' ', '', $image["name"]);
                                                                $colorMessageImage = $colorgreen;
                                                            } else {
                                                                $uploadOk = $addImage->getUploadOk();
                                                                $finish = $addImage->getError();
                                                            }
                                                        }
                                                        $countTable = count($tableOkImage);
                                                        if ($countTable >= 1 and $uploadOk = 1) {
                                                            foreach ($houseByToken[1] as $image) {
                                                                $stringAllImages = $image->getLink();
                                                            }
                                                            for ($i = 0; $i < $numberImage; $i++) {
                                                                $stringAllImages = $stringAllImages . ' ' . 'http://localhost/EasyBuyRewrite/assets/houseImg/' . $_SESSION['idUser'] . '/' . $tableOkImage[$i];
                                                            }

                                                            $idImage = $imageManager->updateImageById($idImageForRemove, $stringAllImages);
                                                        }
                                                    } else {
                                                        $finish = 'Il s\'emblerait qu\'une image ai étais oubliée.';
                                                    }
                                                }
                                                $getDepartmentsId = $departments->getDepartmentByName($departmentsSecure);
                                                $getDepartmentsId = (int)$getDepartmentsId[0];
                                                $house = new House([
                                                    'departmentsId' => $getDepartmentsId,
                                                    'city' => $city,
                                                    'title' => $titles,
                                                    'description' => $desc,
                                                    'area' => $area,
                                                    'bedroom' => $bedrooms,
                                                    'bathroom' => $bathrooms,
                                                    'rooms' => $rooms,
                                                    'orientation' => $orientation,
                                                    'price' => $price,
                                                    'tokenAppartments' => $tokenAppartments,
                                                ]);
                                                $houseManager->updateHouse($house);
                                                $goodFinish = 'Votre biens à bien étais modifié.';
                                                header('Refresh: 0.9; url=http://localhost/EasyBuyRewrite/detail/' . $_GET['houseIdentification']);
                                            } else {
                                                $finish = 'Erreur sur le prix.';
                                            }
                                        } else {
                                            $finish = 'Erreur sur l\'orientation.';
                                        }
                                    } else {
                                        $finish = 'Erreur sur les pièces.';
                                    }
                                } else {
                                    $finish = 'Erreur sur les salles de bains.';
                                }
                            } else {
                                $finish = 'Erreur sur les chambres.';
                            }
                        } else {
                            $finish = 'Erreur sur la surface.';
                        }
                    } else {
                        $finish = 'Erreur sur la ville.';
                    }
                } else {
                    $finish = 'Ce département n\'est pas sur notre liste.';
                }
            } else {
                $finish = 'Erreur sur le département.';
            }
        } else {
            $finish = 'Erreur sur la description';
        }
    }

require "../views/updateHouseVue.php";