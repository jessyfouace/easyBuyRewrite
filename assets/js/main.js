function addInput() {
    let divNewInput = document.getElementById('newInput');
    let numberImage = document.getElementById("addImage").value;
    numberImage = parseInt(numberImage);
    if (numberImage <= 5) {
        let formAlreadyCreated = document.getElementsByClassName('selectOption');
        let tableInput = [];
        for (let index = 0; index < formAlreadyCreated.length; index++) {
            tableInput.push(formAlreadyCreated[index])
        }
        if (tableInput.length > 0) {
            for (let index = 0; index < tableInput.length; index++) {
                divNewInput.removeChild(tableInput[index]);
            }
        }
        for (let index = 1; index < numberImage + 1; index++) {
            let div = document.createElement('div');
            div.classList.add('selectOption');
            div.classList.add('mx-auto');
            div.classList.add('mt-3')

            let input = document.createElement("INPUT");
            input.setAttribute("type", "file");
            input.setAttribute("accept", "image/*");
            input.setAttribute("onchange", 'loadFile(this, ' + index + ')');
            input.setAttribute("name", "image" + index);
            input.setAttribute('id', 'image' + index);
            input.setAttribute('required', 'required');
            input.classList.add('d-none');

            let label = document.createElement('label');
            label.setAttribute('for', 'image' + index);

            let Image = document.createElement("img");
            Image.setAttribute('id', 'imgsrc' + index);
            Image.setAttribute('src', 'http://localhost/EasyBuyRewrite/assets/img/loadImage.png');
            Image.classList.add('hoverandsize')

            label.appendChild(Image);
            divNewInput.appendChild(div);
            div.appendChild(input);
            div.appendChild(label);

        }
    }
}

function loadFile(input, idImage) {
    var files = input.files;
    var theimage = 'imgsrc' + idImage;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            continue;
        }
        var img = document.getElementById(theimage);
        img.file = file;
        var reader = new FileReader();
        reader.onload = (function (aImg) {
            return function (e) {
                aImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
    }    
}

function exploseImage(tableJson, idImages) {
    table = JSON.parse(tableJson);
    tableImagesOnJS = []
    for (let index = 1; index < 2; index++) {
        tableImagesOnJS.push(table[index]);
    }
    let imgId = document.getElementById(idImages);
    imgId.src = tableImagesOnJS[0];
}

function houseInfoCreateCarousel(jsonTable) {
    let table = JSON.parse(jsonTable);
    let momDiv = document.getElementById('createImgDiv');
    let countLength = 0;
    for (let index = 1; index < table.length; index++) {
        countLength++;
    }
    if (countLength <= 5) {
        let momDivAlreadyCreate = document.getElementsByClassName('divCheck');
        let tableInput = [];
        for (let index = 0; index < momDivAlreadyCreate.length; index++) {
            tableInput.push(momDivAlreadyCreate[index])
        }
        if (tableInput.length > 0) {
            for (let index = 0; index < tableInput.length; index++) {
                momDiv.removeChild(tableInput[index]);
            }
        }
        let createActive = -1;
        for (let index = 1; index < countLength + 1; index++) {
            createActive++;
            let div = document.createElement('div');
            div.classList.add('divCheck');
            if (createActive == 0) {
                div.classList.add('active');
            }
            div.classList.add('carousel-item');

            let imageCreate = document.createElement("img");
            imageCreate.setAttribute("src", table[index]);
            imageCreate.setAttribute('alt', 'Aucune description n\'existe pour cette image');
            imageCreate.classList.add('height250');
            imageCreate.classList.add('w-75');
            imageCreate.classList.add('mx-auto');
            imageCreate.classList.add('d-block');

            momDiv.appendChild(div);
            div.appendChild(imageCreate);
        }
    }
}

function dflexmodal() {
    let modal = document.getElementById('modal');
    modal.classList.toggle('d-none')
}