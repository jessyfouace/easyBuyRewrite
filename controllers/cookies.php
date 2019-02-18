<?php
if (isset($_POST['acceptcookies'])) {
    setCookie('acceptation', 'Accepter', (time() + 60 * 60 * 24 * 365));
    header('location: ' . $_SERVER['REQUEST_URI']);
} elseif (isset($_POST['refusecookies'])) {
    $_SESSION['nocookies'] = 'true';
    header('location: ' . $_SERVER['REQUEST_URI']);
}

if (!isset($_SESSION['mail']) and !isset($_SESSION['password']) and !isset($_SESSION['firstname']) and !isset($_SESSION['lastname']) and !isset($_SESSION['role']) and !isset($_SESSION['idUser'])) {
    if (isset($_COOKIE['mail']) and isset($_COOKIE['password']) and isset($_COOKIE['firstname']) and isset($_COOKIE['lastname']) and isset($_COOKIE['role']) and isset($_COOKIE['idUser'])) {
        $mail = htmlspecialchars($_COOKIE['mail']);
        $password = htmlspecialchars($_COOKIE['password']);
        $checkConnexion = $usersManager->getUserByMail($mail);
        if ($checkConnexion) {
            $password = password_verify($password, $checkConnexion->getPassword());
            if ($password) {
                $_SESSION['mail'] = $_COOKIE['mail'];
                $_SESSION['password'] = $_COOKIE['password'];
                $_SESSION['firstname'] = $_COOKIE['firstname'];
                $_SESSION['lastname'] = $_COOKIE['lastname'];
                $_SESSION['role'] = $_COOKIE['role'];
                $_SESSION['idUser'] = $_COOKIE['idUser'];
                header('location: ' . $_SERVER['REQUEST_URI']);
            } else {
                setcookie("mail", "", time() - 3600, "/");
                setcookie("password", "", time() - 3600, "/");
                setcookie("lastname", "", time() - 3600, "/");
                setcookie("firstname", "", time() - 3600, "/");
                setcookie("idUser", "", time() - 3600, "/");
                setcookie("role", "", time() - 3600, "/");
                header('location: ' . $_SERVER['REQUEST_URI']);
            }
        } else {
            setcookie("mail", "", time() - 3600, "/");
            setcookie("password", "", time() - 3600, "/");
            setcookie("lastname", "", time() - 3600, "/");
            setcookie("firstname", "", time() - 3600, "/");
            setcookie("idUser", "", time() - 3600, "/");
            setcookie("role", "", time() - 3600, "/");
            header('location: ' . $_SERVER['REQUEST_URI']);
        }
    }
}