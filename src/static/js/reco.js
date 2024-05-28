let div_list = document.querySelector('.Solunas_list')
let Solunas = div_list.querySelectorAll('.soluna')
let Search = document.querySelectorAll('.input-text')
let LikeButton = document.querySelectorAll('#like')
let FavButton = document.querySelectorAll('#fav')
//let Name = Solunas.querySelectorAll('#name')
//let Username = Solunas.querySelectorAll('#username')

let HF = `<i class="fa-solid fa-heart"></i>`
let HE = `<i class="fa-regular fa-heart"></i>`
let SF = `<i class="fa-solid fa-star"></i>`
let SE = `<i class="fa-regular fa-star"></i>`

function JSOName(name, bar) {
    fetch(`/getJSOName2?listname=${name}&bar=${bar}`).then((res) => {
        return res.json()
    }).then((data) => {
        // console.log(data)
        div_list.innerHTML = ""
        let islike = ""
        let isfav = ""
        data.forEach(list => {
            list.forEach(element => {
                if (element.isLike > 0) {
                    islike = HF
                } else {
                    islike = HE
                }
                if (element.isFav > 0) {
                    isfav = SF
                } else {
                    isfav = SE
                }
                if (element.isPublic == 1) {
                    let soluna = `
                    <ul class="soluna" num="${element.ID}">
                        <li id="pic"><img src="data:image/png;base64,${element.userpicture}"/></li>
                        <li id="username"><a href="/displayProfil?id=${element.userID}">${element.username}</a></li>
                        <li id="name"><a href="/viewList?list=${element.ID}">${element.name}</a></li>
                        <li id="len">${element.Works.length}</li>
                        <li>
                            <div class="heart">
                                <p>${element.like.length}</p>
                                ${HF}
                            </div>
                        </li>
                        <li id="like" num="${element.ID}">
                            ${islike}
                        </li>
                        <li id="fav" num="${element.ID}">
                            ${isfav}
                        </li>
                    </ul>`
                    div_list.innerHTML += soluna
                    likefav()
                }
            })

        });
    })
}

function changeLike(id, number) {
    document.querySelector(`.soluna[num="${id}"]`).querySelector('.heart').querySelector('p').textContent = number
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
            fetch(`/tlike?list=${id}`).then((res2) => {
                return res2.json()
            }).then((like) => {
                changeLike(id, like.length)
            })
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
            fetch(`/tfav?list=${id}`)
        }
    })
}

Search[0].addEventListener('input', function () {
    JSOName(Search[0].value, 0)
})

Search[1].addEventListener('input', function () {
    JSOName(Search[1].value, 1)
})

function likefav() {
    let LikeButton = document.querySelectorAll('#like')
    let FavButton = document.querySelectorAll('#fav')
    LikeButton.forEach(element => element.addEventListener('click', function () {
        toogleLike(element)
    }))

    FavButton.forEach(element => element.addEventListener('click', function () {
        toogleFav(element)
    }))
}

likefav()