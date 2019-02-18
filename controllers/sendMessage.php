<?php
if (!empty($_POST['object']) and !empty($_POST['text']) and !empty($_POST['userIdTaker']) and !empty($_SESSION['idUser'])) {
    $text = nl2br($_POST['text']);
    $text = htmlspecialchars($text);

    $object = htmlspecialchars($_POST['object']);

    $userIdTaker = (int) $_POST['userIdTaker'];
    if ($userIdTaker != $_SESSION['idUser']) {
        $message = new Message([
            'object' => $object,
            'text' => $text,
            'userIdTaker' => $userIdTaker,
            'userIdSender' => $_SESSION['idUser']
        ]);
        $messageManager->addMessage($message);
        $messageOk = 'Message envoyer';
        header('Refresh: 1; url=' . $_SERVER['REQUEST_URI'] . '');
    }
}