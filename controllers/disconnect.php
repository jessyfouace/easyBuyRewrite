<?php
session_start();
if (isset($_SESSION['mail'])) {
    session_destroy();
    if (isset($_COOKIE['mail'])) {
        setcookie("mail", null, time() - 3600, '/');
        setcookie("firstname", null, time() - 3600, '/');
        setcookie("lastname", null, time() - 3600, '/');
        setcookie("idUser", null, time() - 3600, '/');
        setcookie("password", null, time() - 3600, '/');
        setcookie("pseudo", null, time() - 3600, '/');
        setcookie("role", null, time() - 3600, '/');
        setcookie("acceptation", null, time() - 3600, '/');
    }
    header('location: http://localhost/EasyBuyRewrite/home');
} else {
    header('location: http://localhost/EasyBuyRewrite/home');
}