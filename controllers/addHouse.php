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
$description = 'EasyBuy - Ajouter un biens, site de vente immobilière entre particulier.';
$imageName = 'https://easybuy-rewrite.000webhostapp.com/assets/img/logo.jpg';
$isActive = 2;
$db = Database::BDD();

$departments = new DepartmentsManager($db);
$imageManager = new ImagesManager($db);
$houseManager = new HouseManager($db);
$usersManager = new UsersManager($db);

require '../controllers/cookies.php';

if (isset($_SESSION['mail'])) {
} else {
    header('location: http://localhost/EasyBuyRewrite/home');
}

$bytes = random_bytes(10);
$token = bin2hex($bytes);

$allDepartments = $departments->getDepartments();


$allDepartmentsOnTable = [];
foreach ($allDepartments as $department) {
    array_push($allDepartmentsOnTable, $department->getDepartmentsName());
}

$errorTitle = '';
$lastTitle = '';

$errorDesc = '';
$lastDesc = '';

$errorDepartments = '';
$lastDepartments = '';

$errorCity = '';
$lastCity = '';

$errorArea = '';
$lastArea = '';

$errorBedrooms = '';
$lastBedrooms = '';

$errorBathrooms = '';
$lastBathrooms = '';

$errorRooms = '';
$lastRooms = '';

$errorOrientation = '';

$errorPrice = '';
$lastPrice = '';

$errorNumberImage = '';
$messageImage = '';
$errorImage = '';

$colorgreen = 'colorgreen';
$colorred = 'colorred';

$finish = '';
$goodFinish = '';

$error = true;

if (!empty($_POST['token'])) {
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
                            $area = (int) $_POST['area'];
                            $lastArea = $area;
                            if (!empty($_POST['bedrooms'])) {
                                $bedrooms = (int) $_POST['bedrooms'];
                                $lastBedrooms = $bedrooms;
                                if (!empty($_POST['bathrooms'])) {
                                    $bathrooms = (int) $_POST['bathrooms'];
                                    $lastBathrooms = $bathrooms;
                                    if (!empty($_POST['rooms'])) {
                                        $rooms = (int) $_POST['rooms'];
                                        $lastRooms = (int) $rooms;
                                        if (!empty($_POST['orientation']) and $_POST['orientation'] == 'Nord' or $_POST['orientation'] == 'Sud' or $_POST['orientation'] == 'Ouest' or $_POST['orientation'] == 'Est') {
                                            $orientation = htmlspecialchars($_POST['orientation']);
                                            if (!empty($_POST['price'])) {
                                                $price = (int) $_POST['price'];
                                                $lastPrice = $price;
                                                if (!empty($_POST['numberImage'])) {
                                                    $error = false;
                                                    $numberImage = (int) $_POST['numberImage'];
                                                    $tableOfImage = [];
                                                    for ($i=1; $i < $numberImage + 1; $i++) { 
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
                                                            $stringAllImages = '';
                                                            for ($i = 0; $i < $numberImage; $i++) {
                                                                $stringAllImages = $stringAllImages . ' ' . 'http://localhost/EasyBuyRewrite/assets/houseImg/' . $_SESSION['idUser'] . '/' . $tableOkImage[$i];
                                                            }
                                                            $image = new Images([
                                                                'link' => $stringAllImages,
                                                                'alt' => 'Désolé aucun titre n\'as étais ajouter à cette image'
                                                            ]);

                                                            $idImage = $imageManager->addImages($image);
                                                            $idImage = (int) $idImage;

                                                            $getDepartmentsId = $departments->getDepartmentByName($departmentsSecure);
                                                            $getDepartmentsId = (int) $getDepartmentsId[0];

                                                            $house = new House([
                                                                'tokenAppartments' => $token,
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
                                                                'imagesId' => $idImage,
                                                                'userId' => $_SESSION['idUser']
                                                            ]);
                                                            $houseManager->addHouse($house);
                                                            $goodFinish = 'Votre biens à bien étais ajouté.';
                                                            header('Refresh: 0.9; url=detail/' . $token); 
                                                        }
                                                    } else {
                                                        $finish = 'Il s\'emblerait qu\'une image ai étais oubliée.';
                                                    }
                                                } else {
                                                    $finish = 'Vous pouvez au maximum mettre 5 images.';
                                                }
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
    } else {
        $finish = 'Erreur sur le titre.';
    }
}

require "../views/addHouseVue.php";