
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
let mSub = userInfo.querySelector('.Sub');
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
let my_TL = listeDiv.querySelectorAll('.mtl')
let my_TF = listeDiv.querySelectorAll('.mtf')
let pen = listeDiv.querySelectorAll('.pen')
let FW1 = FollowersDiv.querySelectorAll('.abo')
let FW2 = FollowingDiv.querySelectorAll('.abo')


function refreshMessage() {
    nul.innerHTML = ""
    let paragraph = document.createElement('p')
    paragraph.textContent = "Rafaichissez la page pour appliquer les changements"
    nul.appendChild(paragraph)
}

function modifName(element) {
    let id = element.getAttribute("num")
    let name = prompt('Tapez le nouveau nom de la liste')
    if (name != null) {
        fetch(`/newlistname?list=${id}&name=${name}`)
        window.location.replace(`/newlistname?list=${id}&name=${name}`)
    }
}

function toogleLike(element) {
    fetch(`/myUser`).then((res) => {
        return res.json()
    }).then((user) => {
        if (user == "") {
            alert("Connectez-vous pour utiliser cette fonctionnalité")
        } else {
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
    })
}

function toogleFav(element) {
    fetch(`/myUser`).then((res) => {
        return res.json()
    }).then((user) => {
        if (user == "") {
            alert("Connectez-vous pour utiliser cette fonctionnalité")
        } else {
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
    })
}

function toogleSub(element) {
    fetch(`/myUser`).then((res) => {
        return res.json()
    }).then((user) => {
        if (user == "") {
            alert("Connectez-vous pour utiliser cette fonctionnalité")
        } else {
            if (element.querySelector('t').textContent == "S'abonner") {
                element.innerHTML = `<i class="fa-solid fa-heart"></i>
                <t>Se désabonner</t>`
            } else {
                element.innerHTML = `<i class="fa-regular fa-heart"></i>
                <t>S'abonner</t>`
            }
            let id = element.getAttribute("num")
            fetch(`/TS?user=${user.ID}&sub=${id}`)
        }
    })
}

function toogleSub2(element) {
    fetch(`/myUser`).then((res) => {
        return res.json()
    }).then((user) => {
        if (user == "") {
            alert("Connectez-vous pour utiliser cette fonctionnalité")
        } else {
            if (element.querySelector("button") != null) {
                if (element.querySelector('button').textContent == "Suivre") {
                    element.querySelector('button').textContent = "Ne Plus Suivre"
                } else {
                    element.querySelector('button').textContent = "Suivre"
                }
                let id = element.getAttribute("num")
                fetch(`/TS?user=${user.ID}&sub=${id}`)
                refreshMessage()
            }
        }
    })
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
if (mUser != null && toggleButton2 != null) {
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

if (my_TL != null) {
    my_TL.forEach(element => {
        element.addEventListener('click', function () {
            toogleLike(element)
        })
    })
}

if (my_TF != null) {
    my_TF.forEach(element => {
        element.addEventListener('click', function () {
            toogleFav(element)
        })
    })
}

if (pen != null) {
    pen.forEach(element => {
        element.addEventListener('click', function () {
            modifName(element)
        })
    })
}

if (mSub != null) {
    mSub.addEventListener('click', function () {
        toogleSub(mSub)
    })
}

if (FW1 != null) {
    FW1.forEach(element => {
        element.addEventListener('click', function () {
            toogleSub2(element)
        })
    })
}

if (FW2 != null) {
    FW2.forEach(element => {
        element.addEventListener('click', function () {
            toogleSub2(element)
        })
    })
}