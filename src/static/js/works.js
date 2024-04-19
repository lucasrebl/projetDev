let container = document.querySelector('.container')
let form = document.querySelector('.form')
let filters = document.querySelector('.filters')
let tags = document.querySelector('.tagsM');
let add = container.querySelector('button')
let summary = container.querySelectorAll('.summary')
let cancel = form.querySelector('#cancel')
let category = form.querySelector('#category')
let category2 = filters.querySelectorAll('.category')
let tag2 = filters.querySelectorAll('.tag')
let part2 = form.querySelector('.part2')
let part3 = form.querySelector('.part3')
let partie2 = filters.querySelector('.part2')
let partie3 = filters.querySelector('.part3')
let NewTag = document.querySelector('.NewTag');
let FilTag = filters.querySelectorAll('.tag')
let FilForm = filters.querySelector('#filters')
let FilClick = filters.querySelector('input[type="submit"]')
let myFilter = document.querySelectorAll('.myFilter')
let id = 1
let Tags = [];

console.log(cancel)

summary.forEach((element) => element.textContent = element.textContent.substring(0, 100))

myFilter.forEach((element) => {
    element.id = id
    id++
})

function createCookie(name, value, days) {
    let expires;

    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }

    document.cookie = escape(name) + "=" +
        escape(value) + expires + "; path=/oeuvres";
}

function JSOName(name) {
    fetch(`/getJSOName?listname=${name}`).then((res) => {
        return res.json()
    }).then((data) => {
        div_list.innerHTML = ""
        let islike = ""
        let isfav = ""
        data.forEach(element => {
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
        });
    })
}

add.addEventListener('click', function () {
    container.style.display = "none"
    form.style.display = "flex"
})

cancel.addEventListener('click', function () {
    container.style.display = "flex"
    form.style.display = "none"
})

category.addEventListener('change', function () {
    if (category.value == 1) {
        part2.style.display = "block"
        part3.style.display = "none"
    } else if (category.value == 2) {
        part2.style.display = "none"
        part3.style.display = "none"

    } else if (category.value == 3) {
        part2.style.display = "none"
        part3.style.display = "block"

    }
})

NewTag.addEventListener('change', function () {
    if (NewTag.value != 0) {
        console.log(NewTag.value)
        let bt = document.createElement("div");
        bt.className = "tag"
        bt.innerHTML = `<select>
        <option value="${NewTag.value}">${NewTag.options[NewTag.selectedIndex].text}</option>
        </select>
        <p class="delete">supprimer</p>`
        tags.appendChild(bt)
        let del = document.querySelectorAll('.delete');
        let tag = tags.querySelectorAll('.tag');
        for (let c = 0; c < del.length; c++) {
            del[c].addEventListener('click', function () {
                tag[c].remove()
            })
        }
        for (let c = 0; c < tag.length; c++) {
            let select = tag[c].querySelector('select');
            select.setAttribute("name", `tag${c + 1}`)
        }
    }

})

FilClick.addEventListener('click', function () {
    createCookie("Tags", Tags, 1)
})

category2.forEach((element) => element.addEventListener('click', function () {
    if (element.value == 1) {
        partie2.style.display = "flex"
        partie3.style.display = "none"
    } else if (element.value == 2) {
        partie2.style.display = "none"
        partie3.style.display = "none"
    } else if (element.value == 3) {
        partie2.style.display = "none"
        partie3.style.display = "flex"
    }

}))

myFilter.forEach((element) => element.addEventListener('click', function () {
    if (element.id == 1) {
        partie2.style.display = "flex"
        partie3.style.display = "none"
        if (myFilter[1].hasAttribute("checked") || myFilter[2].hasAttribute("checked")) {
            myFilter[1].removeAttribute("checked")
            myFilter[2].removeAttribute("checked")
        }
        category2[element.id - 1].checked = true
    } else if (element.id == 2) {
        partie2.style.display = "none"
        partie3.style.display = "none"
        if (myFilter[0].hasAttribute("checked") || myFilter[2].hasAttribute("checked")) {
            myFilter[0].removeAttribute("checked")
            myFilter[2].removeAttribute("checked")
        }
        category2[element.id - 1].checked = true
    } else if (element.id == 3) {
        partie2.style.display = "none"
        partie3.style.display = "flex"
        if (myFilter[0].hasAttribute("checked") || myFilter[1].hasAttribute("checked")) {
            myFilter[0].removeAttribute("checked")
            myFilter[1].removeAttribute("checked")
        }
        category2[element.id - 1].checked = true
    } else if (element.id >= 4) {
        if (tag2[element.id - 4].checked) {
            tag2[element.id - 4].checked = false
        } else {
            tag2[element.id - 4].checked = true
        }
        if (tag2[element.id - 4].checked) {
            Tags.push(tag2[element.id - 4].value)
        } else {
            for (let c = 0; c < Tags.length; c++) {
                if (Tags[c] == tag2[element.id - 4].value) {
                    Tags.splice(c, 1)
                }
            }
        }
    }
    element.toggleAttribute("checked")
}))