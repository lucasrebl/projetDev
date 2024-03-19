function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

let content = document.querySelector("body");
let theme = getCookie("theme");
document.addEventListener('DOMContentLoaded', () => {
    if (theme == "night") {
        darkMode.classList.add('active');
        content.classList.add('night');
    }
});
window.onload = function () {
    let darkMode = document.getElementById("dark-change");
    let modeImage = document.querySelector("#modeImage");
    const actionBtn = document.querySelector('.action-btn');
    const actionBtnIcon = document.querySelector('.action-btn i');
    const dropDownMenu = document.querySelector('.dropdown_menu');

    console.log(theme)

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
        if (theme == "night") {
            setCookie("theme", "day", 5)
        } else {
            setCookie("theme", "night", 5)
        }
        theme = getCookie("theme")
        console.log(theme)
        toggleImage();
    });

    function toggleImage() {
        if (darkMode.classList.contains('active')) {
            modeImage.src = '/static/asset/darkmode.png';
        } else {
            modeImage.src = '/static/asset/lightmode.png';
        }
    }
}