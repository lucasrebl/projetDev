let div_list = document.querySelector('.Solunas_list')
let Solunas = document.querySelectorAll('.soluna')
let Search = document.querySelectorAll('.input-text')
let LikeButton = document.querySelectorAll('#like')
let FavButton = document.querySelectorAll('#fav')

function JSOName(name, bar) {
    fetch(`/getJSOName?listname=${name}&bar=${bar}`).then((res) => {
        return res.json()
    }).then((data) => {
        div_list.innerHTML = ""
        data.forEach(element => {
            if (element.isPublic == 1) {
                let soluna = `
                <ul class="soluna">
                    <li id="pic"><img src="data:image/png;base64,${element.userpicture}"/></li>
                    <li id="username"><a href="/displayProfil?id=${element.userID}">${element.username}</a></li>
                    <li id="name"><a href="/viewList?list=${element.ID}">${element.name}</a></li>
                    <li id="len">${element.Works.length}</li>
                    <li>
                        <div class="heart">
                            <p>0</p>
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </li>
                    <li id="like" num="${element.ID}">
                        <i class="fa-regular fa-heart"></i>
                    </li>
                    <li id="fav" num="${element.ID}">
                        <i class="fa-regular fa-star"></i>
                    </li>
                </ul>`
                div_list.innerHTML += soluna
                likefav()
            }
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
        let id = element.getAttribute("num")
        let type = element.querySelector('i').className
        if (type == "fa-regular fa-star") {
            element.querySelector('i').className = "fa-solid fa-star"
        } else {
            element.querySelector('i').className = "fa-regular fa-star"
        }
    }))
}

likefav()