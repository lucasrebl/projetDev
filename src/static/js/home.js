var content = document.getElementsByTagName("body")[0];
var darkMode = document.getElementById("dark-change");
let modeImage = document.querySelector("#modeImage");
const actionBtn = document.querySelector('.action-btn');
const actionBtnIcon = document.querySelector('.action-btn i');
const dropDownMenu = document.querySelector('.dropdown_menu');

actionBtn.onclick = function () {
    dropDownMenu.classList.toggle('open')
    const isOpen = dropDownMenu.classList.contains('open')

    actionBtnIcon.classList = isOpen
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'
}

darkMode.addEventListener('click', function () {
    darkMode.classList.toggle('active');
    content.classList.toggle('night');
    toggleImage();
});



function toggleImage() {
    if (darkMode.classList.contains('active')) {
        modeImage.src = '/static/asset/darkmode.png';
    } else {
        modeImage.src = '/static/asset/lightmode.png';
    }
}


