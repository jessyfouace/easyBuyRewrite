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
$title = 'EasyBuy - Détail utilisateur';
$isActive = 9;
$db = Database::BDD();

$usersManager = new UsersManager($db);
$messageManager = new MessageManager($db);

require '../controllers/cookies.php';

if (isset($_GET['idUserProfil'])) {
    $id = (int) $_GET['idUserProfil'];
    $infoUser = $usersManager->getUserById($id);
    $infoMessage = $messageManager->getMessageById($id);
    if (empty($infoUser[0])) {
        header('location: http://localhost/EasyBuyRewrite/home');
    } else {
        foreach ($infoUser[0] as $infoUserTwitter) {
            $description = 'EasyBuy - Profil, visitez le profil de ' . ucfirst($infoUserTwitter->getFirstname()) . ' ' . ucfirst($infoUserTwitter->getLastname()) .'.';
            $imageName = 'https://easybuy-rewrite.000webhostapp.com/assets/img/logo.jpg';
        }
    }
} else {
    header('location: http://localhost/EasyBuyRewrite/home');
}

$messageNo = '';
$messageOk = '';

if(isset($_POST['edit'])) {
    if (!empty($_POST['firstname']) and !empty($_POST['lastname']) and !empty($_POST['mail'])) {
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $mail = htmlspecialchars($_POST['mail']);
        if (!empty($_POST['lastpassword']) and !empty($_POST['newpassword']) and !empty($_POST['confirmnewpassword'])) {
            if ($_POST['newpassword'] == $_POST['confirmnewpassword']) {
                $lastpassword = htmlspecialchars($_POST['lastpassword']);
                $newpassword = htmlspecialchars($_POST['newpassword']);
                foreach ($infoUser[0] as $user) {
                    if (password_verify($lastpassword, $user->getPassword())) {
                        $password = password_hash($newpassword, PASSWORD_DEFAULT);
                        $updateUser = new Users([
                            'idUser' => $_SESSION['idUser'],
                            'firstname' => $firstname,
                            'lastname' => $lastname,
                            'mail' => $mail,
                            'password' => $password,
                            'role' => $_SESSION['role']
                        ]);
                        $usersManager->updateUserPassword($updateUser);
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastname;
                        $_SESSION['mail'] = $mail;
                        $_SESSION['password'] = $password;
                        if (isset($_COOKIE['acceptation'])) {
                            setCookie('firstname', $firstname, (time() + 60 * 60 * 24 * 365));
                            setCookie('lastname', $lastname, (time() + 60 * 60 * 24 * 365));
                            setCookie('mail', $mail, (time() + 60 * 60 * 24 * 365));
                            setCookie('password', $password, (time() + 60 * 60 * 24 * 365));
                        }
                        $messageOk = 'Profil Modifié';
                    } else {
                        $messageNo = 'Erreur dans la modification';
                    }
                }
            } else {
                $messageNo = 'Erreur dans la modification';
            }
        } else {
            $password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);
            $updateUser = new Users([
                'idUser' => $_SESSION['idUser'],
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mail' => $mail,
                'password' => $password,
                'role' => $_SESSION['role']
            ]);
            $usersManager->updateUser($updateUser);
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['mail'] = $mail;
            setCookie('firstname', $firstname, (time() + 60 * 60 * 24 * 365));
            setCookie('lastname', $lastname, (time() + 60 * 60 * 24 * 365));
            setCookie('mail', $mail, (time() + 60 * 60 * 24 * 365));
            $messageOk = 'Profil Modifié';
        }
        header('Refresh: 1; url=http://localhost/EasyBuyRewrite/profil/' . $_SESSION['idUser']);
    }
}

if (isset($_POST['removeMessage']) and isset($_POST['messageId'])) {
    $idMessage = (int) $_POST['messageId'];
    foreach ($infoMessage[0] as $message) {
        if ($message->getIdMessage() == $idMessage) {
            if ($message->getUserIdTaker() == $_SESSION['idUser']) {
                $messageManager->removeMessage($idMessage);
                $messageOk = 'Message Supprimé';
                header('refresh: 1; url=http://localhost/EasyBuyRewrite/profil/' . $_GET['idUserProfil']);
                break;
            }
        }
    }
}

require '../controllers/sendMessage.php';

require "../views/detailUserVue.php";