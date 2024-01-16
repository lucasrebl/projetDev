let container = document.querySelector('.container')
let form = document.querySelector('.form')
let filters = document.querySelector('.filters')
let tags = document.querySelector('.tagsM');
let add = container.querySelector('button')
let summary = container.querySelectorAll('.summary')
let cancel = form.querySelector('button')
let category = form.querySelector('#category')
let category2 = filters.querySelectorAll('.category')
let part2 = form.querySelector('.part2')
let part3 = form.querySelector('.part3')
let partie2 = filters.querySelector('.part2')
let partie3 = filters.querySelector('.part3')
let NewTag = document.querySelector('.NewTag');
let FilTag = filters.querySelectorAll('.tag')
let FilForm = filters.querySelector('#filters')
let FilClick = filters.querySelector('input[type="submit"]')

let Tags = [];

summary.forEach((element) => element.textContent = element.textContent.substring(0,100) + "...")

for(let c = 0; c < FilTag.length; c++){
    // FilTag[c].setAttribute("name",`tag${c + 1}`)
}

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

FilTag.forEach((element) => element.addEventListener('click', function(){
    if(element.checked){
        Tags.push(element.value)
    }else{
        for(let c = 0; c < Tags.length; c++){
            if(Tags[c] == element.value){
                Tags.splice(c,1)
            }
        }
    }
}))

add.addEventListener('click', function() {
    container.style.display = "none"
    form.style.display = "block"
})

cancel.addEventListener('click', function() {
    container.style.display = "block"
    form.style.display = "none"
})

category.addEventListener('change', function() {
    if(category.value == 1){
        part2.style.display = "block"
        part3.style.display = "none"
    } else if(category.value == 2){
        part2.style.display = "none"
        part3.style.display = "none"

    } else if(category.value == 3){
        part2.style.display = "none"
        part3.style.display = "block"

    }
})

NewTag.addEventListener('change', function(){
    if(NewTag.value != 0){
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
        for(let c = 0; c < del.length; c++){
            del[c].addEventListener('click', function() {
                tag[c].remove()
             })
        }
        for(let c = 0; c < tag.length; c++){
            let select = tag[c].querySelector('select');
            select.setAttribute("name",`tag${c + 1}`)
        }
    }
    
})

FilClick.addEventListener('click', function() {
    createCookie("Tags", Tags, 1)
})

category2.forEach((element) => element.addEventListener('click', function(){
    if(element.value == 1){
        partie2.style.display = "flex"
        partie3.style.display = "none"
    } else if(element.value == 2){
        partie2.style.display = "none"
        partie3.style.display = "none"

    } else if(element.value == 3){
        partie2.style.display = "none"
        partie3.style.display = "flex"

    }
}))