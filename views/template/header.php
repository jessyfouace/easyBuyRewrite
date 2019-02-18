<!doctype html>
<html class="no-js" lang="fr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $title; ?></title>
  <meta name="description" content="easyBuy, agence de vente de maison entre particuler">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#ff5722">

  <meta name="twitter:card" content="summary_large_image"/>
  <meta name="twitter:title" content="<?= $title ?>" />
  <meta name="twitter:description" content="<?= $description ?>" />
  <meta name="twitter:image" content="<?= $imageName ?>" />

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico"/>
  <script src="http://localhost/EasyBuyRewrite/assets/js/listjs.js"></script>
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="http://localhost/EasyBuyRewrite/assets/aos-master/dist/aos.css">
  <script src="http://localhost/EasyBuyRewrite/assets/aos-master/dist/aos.js"></script>
  <script src="http://localhost/EasyBuyRewrite/assets/js/main.js"></script>

  <link rel="stylesheet" href="http://localhost/EasyBuyRewrite/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://localhost/EasyBuyRewrite/assets/css/normalize.css">
  <link rel="stylesheet" href="http://localhost/EasyBuyRewrite/assets/css/main.css">
  <link href="http://localhost/EasyBuyRewrite/assets/js/jquery-ui-1.8.23.custom/css/ui-lightness/jquery-ui-1.8.23.custom.css" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
  
<div class="col-12 col-lg-10 mx-auto">
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="col-xl-10 mx-auto row">
      <a class="navbar-brand d-flex" href="http://localhost/EasyBuyRewrite/home" style="max-height: 50px;"><img src="http://localhost/EasyBuyRewrite/assets/img/logo.jpg" class="my-auto" style="width: 100px;" alt="Logo Easy Buy"></a>
      <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if($isActive == 1){ ?> active <?php } ?>">
            <a class="nav-link" href="http://localhost/EasyBuyRewrite/home"><i class="fas fa-home"></i> Accueil</a>
          </li>
          <?php if (isset($_SESSION['mail'])) { ?>
          <li class="nav-item <?php if($isActive == 2){ ?> active <?php } ?>">
            <a class="nav-link" href="http://localhost/EasyBuyRewrite/ajouter-un-bien"><i class="fas fa-plus"></i> Déposer un bien</a>
          </li>
          <?php } ?>
          <li class="nav-item <?php if ($isActive == 3) { ?> active <?php } ?>">
            <a class="nav-link" href="http://localhost/EasyBuyRewrite/biens/1"><i class="fas fa-hotel"></i> Tous les biens</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#footer"><i class="fas fa-envelope"></i> Contact</a>
          </li>
          <?php if(isset($_SESSION['role']) and $_SESSION['role'] == 'is_admin') { ?>
          <li class="nav-item <?php if ($isActive == 4) { ?> active <?php } ?>">
            <a class="nav-link" href="admin"><i class="fas fa-user-secret"></i> Admin</a>
          </li>
          <?php } ?>
        </ul>
        <span class="navbar-text">
          <ul class="navbar-nav">
            <?php if (!isset($_SESSION['mail'])) { ?>
            <li class="nav-item">
              <a href="http://localhost/EasyBuyRewrite/connection" class="nav-link"><i class="fas fa-user"></i> Connection</a>
            </li>
            <?php } else { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i>  Profil
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="http://localhost/EasyBuyRewrite/profil/<?= $_SESSION['idUser'] ?>">Profil</a>
                <a class="dropdown-item" href="http://localhost/EasyBuyRewrite/profil/<?= $_SESSION['idUser'] ?>">Messages</a>
                <a class="dropdown-item" href="http://localhost/EasyBuyRewrite/profil/<?= $_SESSION['idUser'] ?>">Mes biens</a>
              </div>
            </li>
            <li class="nav-item">
              <a href="http://localhost/EasyBuyRewrite/deconnection" class="nav-link"><i class="fas fa-user-slash"></i> Déconnection</a>
            </li>
            <?php } ?>
          </ul>
        </span>
      </div>
    </div>
  </nav>
</div>