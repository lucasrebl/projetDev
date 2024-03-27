
let nul = document.querySelector('.nul')
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
let view = document.querySelectorAll(".View")
let like_TL = listeLDiv.querySelectorAll('.ltl')
let like_TF = listeLDiv.querySelectorAll('.ltf')
let fav_TL = listeFDiv.querySelectorAll('.ftl')
let fav_TF = listeFDiv.querySelectorAll('.ftf')


function refreshMessage() {
    nul.innerHTML = ""
    let paragraph = document.createElement('p')
    paragraph.textContent = "Rafaichissez la page pour appliquer les changements"
    nul.appendChild(paragraph)
}


function toogleLike(element) {
    let id = element.getAttribute("num")
    let type = element.querySelector('i').className
    if (type == "fa-regular fa-heart") {
        element.querySelector('i').className = "fa-solid fa-heart"
    } else {
        element.querySelector('i').className = "fa-regular fa-heart"
    }
    refreshMessage()
    fetch(`/tlike?list=${id}`)
}

function toogleFav(element) {
    let id = element.getAttribute("num")
    let type = element.querySelector('i').className
    if (type == "fa-regular fa-star") {
        element.querySelector('i').className = "fa-solid fa-star"
    } else {
        element.querySelector('i').className = "fa-regular fa-star"
    }
    refreshMessage()
    fetch(`/tfav?list=${id}`)
}


document.addEventListener("DOMContentLoaded", (event) => {
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
});

if (mUser != null) {
    mUser.addEventListener('click', function () {
        userInfo.style.display = "none"
        Selection.style.display = "none"
        formUser.style.display = "block"
    })
}
cancel.addEventListener('click', function () {
    userInfo.style.display = "flex"
    Selection.style.display = "block"
    formUser.style.display = "none"
})
if (mUser != null) {
    picture.addEventListener('change', function () {
        formUser.querySelector("input[type='submit']").click();
    })
}
toggleButton.addEventListener("click", function () {
    myForm.classList.toggle("Form_hidden");
    myForm.classList.toggle("Form_visible");
    if (myForm.classList.value == "Form_visible") {
        myForm.style.maxHeight = "200px"
    } else {
        myForm.style.maxHeight = "0px"
    }
});
if (mUser != null) {
    toggleButton2.addEventListener("click", function () {
        picture.click();
    });
}
infos.addEventListener('click', function () {
    userInfo.style.display = "flex"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
})

listM.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "flex"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
})

listL.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "flex"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
})

listF.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "flex"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "none"
})

follow.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "flex"
    FollowingDiv.style.display = "none"
})

followi.addEventListener('click', function () {
    userInfo.style.display = "none"
    listeDiv.style.display = "none"
    listeLDiv.style.display = "none"
    listeFDiv.style.display = "none"
    FollowersDiv.style.display = "none"
    FollowingDiv.style.display = "flex"
})


if (view != null) {
    view.forEach(element => {
        element.addEventListener('click', function () {
            r = element.getAttribute('num')
            fetch(`/tview?list=${r}`)
            r2 = element.querySelector("i").className
            if (r2 == "fa-solid fa-eye") {
                element.querySelector("i").className = "fa-solid fa-eye-slash"
            } else {
                element.querySelector("i").className = "fa-solid fa-eye"
            }
        })
    }
    )
}

if (like_TL != null) {
    like_TL.forEach(element => {
        element.addEventListener('click', function () {
            toogleLike(element)
        })
    })
}

if (like_TF != null) {
    like_TF.forEach(element => {
        element.addEventListener('click', function () {
            toogleFav(element)
        })
    })
}

if (fav_TL != null) {
    fav_TL.forEach(element => {
        element.addEventListener('click', function () {
            toogleLike(element)
        })
    })
}

if (fav_TF != null) {
    fav_TF.forEach(element => {
        element.addEventListener('click', function () {
            toogleFav(element)
        })
    })
}