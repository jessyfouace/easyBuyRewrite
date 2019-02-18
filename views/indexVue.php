<?php
  include("template/header.php"); ?>

<?php 
if (!isset($_SESSION['nocookies'])) {
  if (!isset($_COOKIE['acceptation'])) {
    require("../views/cookiesVue.php");
  } else {
    $_SESSION['nocookies'] = 'true';
  }
} ?>

<div style="height: 80vh" id="carouselExampleControls" class="carousel slide w-100 responsiveimg" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 responsiveimg" style="height: 80vh; opacity: 0.3;" src="http://localhost/EasyBuyRewrite/assets/img/carousel1.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 responsiveimg" style="height: 80vh; opacity: 0.3;" src="http://localhost/EasyBuyRewrite/assets/img/carousel2.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 responsiveimg" style="height: 80vh; opacity: 0.3;" src="http://localhost/EasyBuyRewrite/assets/img/carousel3.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" style="z-index: 5;" href="#carouselExampleControls" role="button" data-slide="prev">
    <span><i style="color: black" class="fa-2x fa fa-angle-left" aria-hidden="true"></i></span>
    <span class="sr-only">Avant</span>
  </a>
  <a class="carousel-control-next" style="z-index: 5;" href="#carouselExampleControls" role="button" data-slide="next">
    <span><i style="color: black;" class="fa-2x fa fa-angle-right" aria-hidden="true"></i></span>
    <span class="sr-only">Après</span>
  </a>
</div>

<div class="col-12 d-block mx-auto m-0 p-0 searchnav" style="position: relative; top: -250px;">
  <h1 class="col-8 mx-auto pl-2 pl-md-3 pl-lg-4 font-weight-bold" style="font-size: 25px;">Trouvez votre maison</h1>
  <form class="col-8 mx-auto p-0 m-0 mb-3 center mt-2 text-center" action="http://localhost/EasyBuyRewrite/controllers/moreHouse.php" method="get">
      <input placeholder='Recherche par Départements' type="search" class="col-7 col-lg-8" name="departments" id="tags">
      <input type="hidden" name="onetime" value="yes">
      <button class="mr-2 btn btn-info col-3" type="submit"><i class="fas fa-search"></i></button>
  </form>
</div>

<div class="changemt" style="background-color: #eceff1; margin-top: -122px;">
  <div class="col-12 col-lg-10 mx-auto pt-4 pb-4">
    <h2 class="text-center">Derniers biens</h2>
    <p class="text-center">Présentation des 6 derniers biens inscrits.</p>
    <div class="col-12 row m-0 p-0">
      
      <?php
      $numberWhile = 0; 
      foreach ($fiveLastHouse[0] as $houseInfo) {
      $numberWhile++;
      ?>
        <div class="col-md-6 col-lg-5 col-xl-4 mx-auto col-12 m-0 p-0 mt-4">
        <a href="http://localhost/EasyBuyRewrite/detail/<?= $houseInfo->getTokenAppartments() ?>" class="card text-left col-md-10 col-11 p-0 cardhover mx-auto">
          <img class="card-img-top" id="images<?= $numberWhile ?>" src="" alt="Cette image ne contient pas de description.">
          <?php
            foreach ($fiveLastHouse[1] as $imageInfo) {
              if ($houseInfo->getImagesId() == $imageInfo->getIdImages()) {
                $allImages = $imageInfo->getLink();
                $explose = explode(" ", $allImages);
                $toJson = json_encode($explose);
              }
            }
          ?>
          <script>
              tableJson = '<?php echo $toJson ?>';
              imagesId = 'images' + '<?php echo $numberWhile ?>';
              exploseImage(tableJson, imagesId);
          </script>
          <div class="card-body">
            <h4 class="card-title font-weight-bold"><?= substr(ucfirst($houseInfo->getTitle()), 0, 22) ?>..</h4>
            <h4 class="card-title price font-weight-bold"><?= substr(number_format($houseInfo->getPrice(), 2, ',', ' '), 0 , -3) ?> €</h4>
            <?php foreach ($fiveLastHouse[2] as $departmentsInfo) { 
            if ($houseInfo->getDepartmentsId() == $departmentsInfo->getId()) { 
            ?>
            <p class="card-text"><?= $departmentsInfo->getDepartmentsName() ?></p>
            <?php
            break; 
              }
            } ?>
            <p class="card-text street"><i class="fas fa-map-marker-alt"></i> <?= $houseInfo->getCity() ?></p>
          </div>
          <div class="card-footer">
            <ul class="list-unstyled list-inline">
              <li class="list-inline-item mt-2"><i class="fas fa-bed"></i> Chambres: <?= $houseInfo->getBedroom() ?></li>
              <li class="list-inline-item mt-2"><i class="fas fa-bath"></i> Salle de bains: <?= $houseInfo->getBathroom() ?></li>
              <li class="list-inline-item mt-2"><i class="fab fa-laravel"></i> Surface: <?= $houseInfo->getArea() ?>m²</li>
            </ul>
          </div>
        </a>
      </div>
      <?php } ?>
    
    </div>
    <div class="col-12 text-center m-0 p-0 mt-4">
      <a class="btn orangebg text-white pl-5 pr-5 pt-3 pb-3 mx-auto font-weight-bold" style="font-size: 15px;" href="http://localhost/EasyBuyRewrite/biens/1">Tout voir</a>
    </div>
  </div>

</div>
<div class="col-12 col-lg-10 mx-auto pt-4 pb-4">
  <h2 class="text-center">Par Départements</h2>
  <p class="text-center">Choisissez plus simplement dans les grands départements.</p>

  <div class="col-12 m-0 p-0" style="overflow-x: hidden; overflow-y: hidden">
    <div class="row col-12 m-0 p-0 mt-5" data-aos="fade-right" data-aos-duration="1500">
      <a href="http://localhost/EasyBuyRewrite/biens/1/Pas-de-Calais" style="height: 300px;" class="mx-auto col-11 col-md-5 col-lg-3 m-0 p-0 cardhover">
        <div style="opacity: 0.6; height: 300px; background-repeat: round; background-image: url('http://localhost/EasyBuyRewrite/assets/img/pas-de-calais.png')">
        </div>
        <div style="top: -85px; position: relative;">
            <h3 class="text-black font-weight-bold text-center">Pas-De-Calais</h3>
            <h4 class="colororange font-weight-bold text-center">128 Biens</h4>
        </div>
      </a>
      <a href="http://localhost/EasyBuyRewrite/biens/1/Nord" style="height: 300px;" class="mx-auto col-11 col-md-5 col-lg-8 m-0 p-0 mt-5 mt-md-0 cardhover">
        <div style="opacity: 0.6; width: 100% !important; height: 300px; background-repeat: round; background-image: url('http://localhost/EasyBuyRewrite/assets/img/lille.png')">
        </div>
        <div style="top: -85px; position: relative;">
            <h3 class="text-black font-weight-bold text-center">Nord</h3>
            <h4 class="colororange font-weight-bold text-center">458 Biens</h4>
        </div>
      </a>
    </div>
  </div>

  <div class="col-12 m-0 p-0" style="overflow-x: hidden; overflow-y: hidden">
    <div class="row col-12 m-0 p-0 mt-5" data-aos="fade-left" data-aos-duration="1500">
      <a href="http://localhost/EasyBuyRewrite/biens/1/Rhone" style="height: 300px;" class="mx-auto col-11 col-md-5 col-lg-8 m-0 p-0 cardhover">
        <div style="opacity: 0.6; width: 100% !important; height: 300px; background-repeat: round; background-image: url('http://localhost/EasyBuyRewrite/assets/img/lyon.png')">
        </div>
        <div style="top: -85px; position: relative;">
            <h3 class="text-black font-weight-bold text-center">Rhône</h3>
            <h4 class="colororange font-weight-bold text-center">852 Biens</h4>
        </div>
      </a>
      <a href="http://localhost/EasyBuyRewrite/biens/1/Paris" style="height: 300px;" class="mx-auto col-11 col-md-5 col-lg-3 m-0 p-0 mt-5 mt-md-0 cardhover">
        <div style="opacity: 0.6; height: 300px; background-repeat: round; background-image: url('http://localhost/EasyBuyRewrite/assets/img/paris.png')">
        </div>
        <div style="top: -85px; position: relative;">
          <h3 class="text-black font-weight-bold text-center">Paris</h3>
          <h4 class="colororange font-weight-bold text-center">2425 Biens</h4>
        </div>
      </a>
    </div>
  </div>

</div>

<?php
  include("template/footer.php"); ?>

<script>
    $(function() {
      var scriptData = '<?= json_encode($allDepartmentsOnTable) ?>';
      var parseTable = JSON.parse(scriptData);
      var availableTags = [];
        for (let i = 0; i < parseTable.length; i++) {
            availableTags.push(parseTable[i])
        }
        $("#tags").autocomplete({
            source: availableTags,
            minLength:2
        });
      });
</script>

