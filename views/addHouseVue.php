<?php
include("template/header.php"); ?>

<div style="margin-top: 100px;">
    <div class="col-lg-10 col-12 m-0 p-0 mx-auto">
        <div class="breadcrumb flat">
                <a href="http://localhost/EasyBuyRewrite/home">Accueil</a>
                <a href="#" class="active">Ajouter un biens</a>
        </div>
    </div>
    <h1 style="font-size: 30px;" class="text-center">Ajouter un biens</h1>
    <div class="col-12 col-md-10 mx-auto">
        <h2 class="colorgreen text-center sizeh2 font-weight-bold"><?= $goodFinish ?></h2>
        <h2 class="colorred text-center sizeh2 font-weight-bold"><?= $finish ?></h2>
        <p>* est un champ obligatoire</p>
        <form action="http://localhost/EasyBuyRewrite/ajouter-un-bien" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="token" value="<?= $token ?>" required>
                <div class="input-group">
                    <label for="title" class="col-12 m-0 p-0 pb-2">Titre: *</label>
                    <input name="title" id="title" class="form-control" placeholder="Titre" type="text" value="<?= $lastTitle ?>" required>
                </div>
                <div class="input-group pt-3">
                    <label for="desc" class="col-12 m-0 p-0 pb-2">Description: *</label>
                    <textarea name="desc" class="form-control" rows="6" id="desc" placeholder="..." required><?= $lastDesc ?></textarea>
                </div>
                <div class="input-group pt-3">
                    <label for="departments" class="col-12 m-0 p-0 pb-2">Département: *</label>
                    <input name="departments" id="departments" class="form-control" placeholder="Département (Ex: Nord)" type="text" value="<?= $lastDepartments ?>" required>
                </div>
                <div class="input-group pt-3">
                    <label for="city" class="col-12 m-0 p-0 pb-2">Ville: *</label>
                    <input name="city" id="city" class="form-control" placeholder="Ville (Ex: Lille)" type="text" value="<?= $lastCity ?>" required>
                </div>
                <div class="input-group pt-3">
                    <label for="area" class="col-12 m-0 p-0 pb-2">Surface: *</label>
                    <input name="area" id="area" class="form-control" placeholder="Surface (Ex: 180)" type="number" min=0 value="<?= $lastArea ?>" required>
                </div>
                <div class="input-group pt-3">
                    <label for="bedrooms" class="col-12 m-0 p-0 pb-2">Chambres: *</label>
                    <input name="bedrooms" id="bedrooms" class="form-control" placeholder="Chambres (Ex: 2)" type="number" min=0 value="<?= $lastBedrooms ?>" required>
                </div>
                <div class="input-group pt-3">
                    <label for="bathrooms" class="col-12 m-0 p-0 pb-2">Salle de bain: *</label>
                    <input name="bathrooms" id="bathrooms" class="form-control" placeholder="Salle de bain (Ex: 1)" type="number" min=0 value="<?= $lastBathrooms ?>" required>
                </div>
                <div class="input-group pt-3">
                    <label for="rooms" class="col-12 m-0 p-0 pb-2">Pièces: *</label>
                    <input name="rooms" id="rooms" class="form-control" placeholder="Pièces (Ex: 3)" type="number" min=0 value="<?= $lastRooms ?>" required>
                </div>
                <div class="input-group pt-3">
                    <label for="orientation" class="col-12 m-0 p-0 pb-2">Orientation: *</label>
                    <select class="form-control" name="orientation" id="orientation" required>
                        <option value="Nord">Nord</option>
                        <option value="Sud">Sud</option>
                        <option value="Ouest">Ouest</option>
                        <option value="Est">Est</option>
                    </select>
                </div>
                <div class="input-group pt-3">
                    <label for="price" class="col-12 m-0 p-0 pb-2">Prix: *</label>
                    <input name="price" id="price" class="form-control" placeholder="Prix (Ex: 180 000)" value="<?= $lastPrice ?>" type="number">
                </div>
                <div class="input-group pt-3">
                    <label for="addImage" class="col-12 m-0 p-0 pb-2">Ajouter des Images: *</label>
                    <select class="form-control" name="numberImage" id="addImage" onchange='addInput()' required>
                        <option value="" selected disabled>Ajouter des Images</option>
                        <?php for ($i = 1; $i < 6; $i++) { ?>
                            <option value="<?= $i ?>"><?= $i ?> Images</option>
                        <?php } ?>
                    </select>
                </div>
                <div id="newInput" class="col-12 m-0 p-0 row">
                </div>
                <div class="col-12 text-center">
                    <input type="submit" class="btn orangebg text-white mt-4" value="Envoyer">
                </div>
            </div>
        </form>
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
    $("#departments").autocomplete({
        source: availableTags,
        minLength:2
    }); 
    });
</script>