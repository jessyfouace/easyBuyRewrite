<?php
$colorMessage = 'colorred';
$messageConnexion = 'Vous devez être connecter';
$connectionMessage = '';
if (!empty($_POST['mail'])) {
    $mail = htmlspecialchars($_POST['mail']);
    if (!empty($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
        $getUser = $usersManager->getUserByMail($mail);
        if ($getUser) {
            if (password_verify($password, $getUser->getPassword())) {
                $colorMessage = 'colorgreen';
                $messageConnexion = 'Connection en cours';
                $_SESSION['mail'] = $mail;
                $_SESSION['password'] = $password;
                $_SESSION['role'] = $getUser->getRole();
                $_SESSION['firstname'] = $getUser->getFirstname();
                $_SESSION['lastname'] = $getUser->getLastname();
                $_SESSION['idUser'] = $getUser->getIdUser();
                if (!empty($_POST['rememberme'])) {
                    if (isset($_COOKIE['acceptation'])) {
                        setCookie('mail', $mail, (time() + 60 * 60 * 24 * 365));
                        setCookie('password', $password, (time() + 60 * 60 * 24 * 365));
                        setCookie('role', $getUser->getRole(), (time() + 60 * 60 * 24 * 365));
                        setCookie('firstname', $getUser->getFirstname(), (time() + 60 * 60 * 24 * 365));
                        setCookie('lastname', $getUser->getLastname(), (time() + 60 * 60 * 24 * 365));
                        setCookie('idUser', $getUser->getIdUser(), (time() + 60 * 60 * 24 * 365));
                    }
                }
                header('Refresh: 1; url=' . $_SERVER['REQUEST_URI'] . '');
            }
        } else {
            $connectionMessage = 'Email ou mot de passe incorrect';
        }
    }
}
$messageInscription = '';
if (!empty($_POST['createMail']) and !empty($_POST['createPassword']) and !empty($_POST['verifCreatePassword']) and !empty($_POST['createLastname']) and !empty($_POST['createFirstname'])) {
    $mail = htmlspecialchars($_POST['createMail']);
    $password = htmlspecialchars($_POST['createPassword']);
    $verifPassword = htmlspecialchars($_POST['verifCreatePassword']);
    $lastname = htmlspecialchars($_POST['createLastname']);
    $firstname = htmlspecialchars($_POST['createFirstname']);
    if ($password == $verifPassword) {
        $getUser = $usersManager->getUserByMail($mail);
        if (!$getUser) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $user = new Users([
                'mail' => $mail,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname
            ]);
            $createUser = $usersManager->addUser($user);
            $messageInscription = 'Inscription réussis';
        }    
    }
}