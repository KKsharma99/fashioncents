var userImagePath = "";

function subOutWithUpload(){
    userImagePath = document.getElementById('userPropic').src;
    document.getElementById('userPropic').src = 'img/upload.png';
}

function subOutWithOrigin(){
    document.getElementById('userPropic').src = userImagePath;
    userImagePath = "";
}

function uploadImage(){
    console.log("upload image");
}