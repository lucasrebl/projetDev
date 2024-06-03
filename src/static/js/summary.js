let Work = document.querySelector('.work');
let VForm = document.querySelector('.form');
let Form = document.querySelector('.tagsM');
let name = document.querySelector('#name');
let summary = document.querySelector('#summary');
let episodes = document.querySelector('#episodes');
let status = document.querySelector('#status');
let season = document.querySelector('#season');
let category = VForm.querySelector('#category');
let tag = Form.querySelectorAll('.tag');
let modify = document.querySelector('.modify');
let cancel = document.querySelector('.cancel');
let del = document.querySelectorAll('.delete');
let tagN = document.querySelectorAll('.tagN');
let NewTag = document.querySelector('.NewTag');
let picture = document.querySelector('#picture');
let part2 = VForm.querySelector('.part2')
let part3 = VForm.querySelector('.part3')
let lists = document.querySelectorAll('.list')
let WorkID = window.location.href.split('=')[1];

function addToList(element) {
    fetch(`/myUser`).then((res) => {
        return res.json()
    }).then((user) => {
        if (user == "") {
            alert("Connectez-vous pour utiliser cette fonctionnalité")
        } else {
            let id = element.getAttribute("num")
            let type = element.id
            if (type == "no_check") {
                element.id = "check"
                element.querySelector('i').className = "fa-solid fa-check"
                element.querySelector('i').title = "Enlever de la liste ?"
                fetch(`/addToList?list=${id}&work=${WorkID}`)
            } else {
                element.id = "no_check"
                element.querySelector('i').className = "fa-solid fa-xmark"
                element.querySelector('i').title = "Ajouter à la liste ?"
                fetch(`/deleteFromList?list=${id}&work=${WorkID}`)
            }
        }
    })
}



for (let c = 0; c < tag.length; c++) {
    let select = tag[c].querySelector('select');
    select.setAttribute("name", `tag${c + 1}`)
}

modify.addEventListener('click', function () {
    modify.remove();
    Work.style.display = "none"
    VForm.style.display = "block"
    cancel.style.visibility = "visible";
})

cancel.addEventListener('click', function () {
    location.reload()
})

for (let c = 0; c < del.length; c++) {
    del[c].addEventListener('click', function () {
        tag[c].remove()
    })
}

NewTag.addEventListener('change', function () {
    if (NewTag.value != 0) {
        console.log(NewTag.value)
        let bt = document.createElement("div");
        bt.className = "tag"
        bt.innerHTML = `<select>
        <option value="${NewTag.value}">${NewTag.options[NewTag.selectedIndex].text}</option>
        </select>
        <p class="delete">supprimer</p>`
        Form.appendChild(bt)
        let del = document.querySelectorAll('.delete');
        let tag = Form.querySelectorAll('.tag');
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

picture.addEventListener('change', function () {
    document.querySelector("input[type='submit']").click();
})
lists.forEach(element => element.addEventListener('click', function () {
    addToList(element)
}))