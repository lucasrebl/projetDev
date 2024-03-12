// INFO Utilisateur
let userInfo = document.querySelector('.userinfo');
let formUser = document.querySelector('.formUser');
let listeDiv = document.querySelector('.Mylist')
let listeLDiv = document.querySelector('.MyLike')
let listeFDiv = document.querySelector('.MyFavorites')
let FollowersDiv = document.querySelector('.Myfollowers')
let FollowingDiv = document.querySelector('.Myfollowing')
let Selection = document.querySelector(".selection")
let mUser = userInfo.querySelector('.modify');
let toggleButton2 = userInfo.querySelector("#toggleButton");
let picture = formUser.querySelector('#picture')
let cancel = formUser.querySelector('.cancel')
let toggleButton = listeDiv.querySelector("#toggleButton");
let myForm = listeDiv.querySelector("#myForm");
let infos = Selection.querySelector("#infos")
let listM = Selection.querySelector("#listM")
let listL = Selection.querySelector("#listL")
let listF = Selection.querySelector("#listF")
let follow = Selection.querySelector("#follow")
let followi = Selection.querySelector("#followi")

document.addEventListener("DOMContentLoaded", (event) => {
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
});

mUser.addEventListener('click', function () {
    userInfo.style.display = "none"
    Selection.style.display = "none"
    formUser.style.display = "block"
})
cancel.addEventListener('click', function () {
    userInfo.style.display = "block"
    Selection.style.display = "block"
    formUser.style.display = "none"
})
picture.addEventListener('change', function () {
    formUser.querySelector("input[type='submit']").click();
})
toggleButton.addEventListener("click", function () {
    myForm.classList.toggle("Form_hidden");
    myForm.classList.toggle("Form_visible");
    if (myForm.classList.value == "Form_visible") {
        myForm.style.maxHeight = "200px"
    } else {
        myForm.style.maxHeight = "0px"
    }
});
toggleButton2.addEventListener("click", function () {
    picture.click();
});

infos.addEventListener('click', function () {
    userInfo.style.display = "block"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
})

listM.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "block"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
})

listL.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "block"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
})

listF.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "block"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
})

follow.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "block"
    FollowingDiv.style.display = "none"
})

followi.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "block"
})