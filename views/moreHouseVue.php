<?php require('../views/template/header.php'); ?>
<?php 
if (!isset($_SESSION['nocookies'])) {
    if (!isset($_COOKIE['acceptation'])) {
        require("../views/cookiesVue.php");
    } else {
        $_SESSION['nocookies'] = 'true';
    }
} ?> 
<div class="col-12 m-0 p-0" style="background-color: #eceff1">
    <div style="margin-top: 70px;">
        <p class="pt-5 colorred sizeh2 text-center font-weight-bold"><?= $errorMessage; ?></p>
    </div>
    <div class="col-lg-10 col-12 m-0 p-0 mx-auto">
        <div class="breadcrumb flat">
                <a href="http://localhost/EasyBuyRewrite/home">Accueil</a>
                <a href="#" class="active">Tous les biens</a>
        </div>
    </div>
    <div class="col-lg-10 row mx-auto pt-4 mt-4">
        <div class="col-12 col-lg-2 col-lg-3 pb-5">
            <form class="bg-white w-100 p-2" action="http://localhost/EasyBuyRewrite/controllers/moreHouse.php" method="get">
                <h1 class="text-center">Trier</h1>
                <p class="pb-0">Département:</p>
                <input type="hidden" name="onetime" value="yes">
                <input type="hidden" name="page" value='1'>
                <div class="form-group">
                    <select class="form-control" name="departments" id="" required>
                        <option value="" selected hidden>Département</option>
                        <?php foreach ($allDepartments as $departments) { ?>
                            <option value="<?= $departments->getDepartmentsName() ?>"><?= $departments->getDepartmentsName() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="minprice">Prix Min: </label>
                    <input type="number" class="form-control" name="" min="80000" max="2000000" placeholder="100000" id="minprice">
                </div>
                <div class="form-group">
                    <label for="maxprice">Prix Max: </label>
                    <input type="number" name="" class="form-control" id="maxprice" min="80000" placeholder="200000" max="2000000">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Filtrer">
                </div>
                <a href="http://localhost/EasyBuyRewrite/biens/1" class="btn btn-danger btn-block">Annuler</a>
            </form>
        </div>
        <div class="col-12 col-lg-9 mx-auto">
    <?php 
    $numberWhile = 0;
    foreach ($returnMessage[0] as $house) { 
    $numberWhile++;
    ?>
        <a href="http://localhost/EasyBuyRewrite/detail/<?= $house->getTokenAppartments(); ?>" class="col-12 m-0 p-0" style="border-radius: 10px">
            <div class="row col-12 m-0 p-0 bg-white mb-5">
                <div class="col-sm-5 col-12 m-0 p-0">
                    <img id="images<?= $numberWhile ?>" style="width: 100%; height: 190px; border-radius: 5px" src="../assets/houseImg/maison1.png" alt="">
                    <?php
                        foreach ($returnMessage[1] as $imageInfo) {
                            if ($house->getImagesId() == $imageInfo->getIdImages()) {
                                $allImages = $imageInfo->getLink();
                                $explose = explode(" ", $allImages);
                                $toJson = json_encode($explose);
                            }
                        }
                    ?>
                </div>
                <script>
                    tableJson = '<?php echo $toJson ?>';
                    imagesId = 'images' + '<?php echo $numberWhile ?>';
                    exploseImage(tableJson, imagesId);
                </script>
                <div class="col-12 col-sm-7">
                    <p class="pt-2"><?= substr(ucfirst($house->getTitle()), 0, 75) ?>..</p>
                    <p class="card-text street"><i class="fas fa-map-marker-alt"></i> <?= $house->getCity(); ?></p>
                    <h1 class="sizeh2 price font-weight-bold"><?= substr(number_format($house->getPrice(), 2, ',', ' '), 0, -3) ?>€</h1>
                    <hr>
                    <p><span><i class="fas fa-bath"></i> <?= $house->getBathroom(); ?> sdb </span><span><i class="fas fa-bed"></i> <?= $house->getBedroom(); ?>ch </span><span><i class="fab fa-laravel"></i> <?= $house->getArea(); ?>m²</span></p>
                </div>
            </div>
        </a>
    <?php } ?>
        </div>
    </div>
    <div class="mt-2 pb-4 mb-0">
        <nav class="mb-0 pb-0" aria-label="Page navigation example">
          <ul class="justify-content-center pagination mb-0 pb-0">
        <?php if ($_GET['page'] > 1) { 
            $getPage = (int) $_GET['page'] - 1;        
            ?>
            <li class="page-item"><a class="page-link" href='http://localhost/EasyBuyRewrite/biens/1<?php if(isset($urlLink)){ echo '/' . $urlLink; } ?>'><i class="text-black fas fa-angle-double-left"></i></a></li>
            <li class="page-item"><a class="page-link" href='http://localhost/EasyBuyRewrite/biens/<?= $getPage ?><?php if(isset($urlLink)){ echo '/' . $urlLink; } ?>'><i class="text-black fas fa-angle-left"></i></a></li>
        <?php } ?>

        <?php
            $explodeUrl = explode('/', $_SERVER['REQUEST_URI']);
            if (isset($explodeUrl[4])) {
                $urlLink = $explodeUrl[4];
            }
            $max = 3;
            if ($_GET['page'] < $max) {
                $sp = 1;
            } elseif ($_GET['page'] >= ($numberOfPage - floor($max / 2))) {
                $sp = $numberOfPage - $max + 1;
            } elseif ($_GET['page'] >= $max) {
                $sp = $_GET['page'] - floor($max / 2);
            }
        ?>

        <?php if ($_GET['page'] >= $max) { ?>

            <li class="page-item"><a href='http://localhost/EasyBuyRewrite/biens/1<?php if(isset($urlLink)){ echo '/' . $urlLink; } ?>' class="page-link text-black font-weight-bold">1</a></li>
            <span class="p-2">...</span>

        <?php } ?>

        <?php for ($i = $sp; $i <= ($sp + $max - 1); $i++) { ?>

            <?php
            if ($i > $numberOfPage) {
                continue;
            }
            ?>

            <?php if ($_GET['page'] == $i) { ?>

                <li class="page-item active"><span class='page-link font-weight-bold'><?php echo $i; ?></span></li>

            <?php } else { ?>
                    
                    <?php if ($i < $numberOfPage + 1) : ?>
                <li class="page-item"><a class="page-link text-black font-weight-bold" href='http://localhost/EasyBuyRewrite/biens/<?= $i ?><?php if(isset($urlLink)){ echo '/' . $urlLink; } ?>'><?php echo $i; ?></a></li>
                    <?php endif; ?>

            <?php } ?>

        <?php } ?>

        <?php if ($_GET['page'] < ($numberOfPage - floor($max / 2))) { ?>

            <span class="p-2">...</span>
            <li class="page-item"><a class="page-link text-black font-weight-bold" href='http://localhost/EasyBuyRewrite/biens/<?= $numberOfPage ?><?php if(isset($urlLink)){ echo '/' . $urlLink; } ?>'><?php echo $numberOfPage; ?></a></li>

        <?php } ?>

        <?php if ($_GET['page'] < $numberOfPage) {
            $getPage = (int) $_GET['page'] + 1;
            ?>
            <li class="page-item"><a class="page-link" href='<?php echo 'http://localhost/EasyBuyRewrite/biens/' . $getPage; ?><?php if(isset($urlLink)){ echo '/' . $urlLink; } ?>'><i class="text-black fas fa-angle-right"></i></a></li>

            <li class="page-item"><a class="page-link" href='<?php echo 'http://localhost/EasyBuyRewrite/biens/' . $numberOfPage; ?><?php if(isset($urlLink)){ echo '/' . $urlLink; } ?>'><i class="text-black fas fa-angle-double-right"></i></a></li>

        <?php } ?>
            </ul>
        </nav>
    </div>
</div>

<?php
require('../views/template/footer.php'); ?>