var content = document.getElementsByTagName("body")[0];
var darkMode = document.getElementById("dark-change");
var modeImage = document.getElementById("modeImage");
darkMode.addEventListener('click', function () {
darkMode.classList.toggle('active');
content.classList.toggle('night');
toggleImage();
});

function toggleImage() {
if (darkMode.classList.contains('active')) {
modeImage.src = '/../../static/asset/darkmode.png';
} else {
modeImage.src = '/../../static/asset/lightmode.png';
}
}