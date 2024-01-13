let container = document.querySelector('.container')
let form = document.querySelector('.form')
let filters = document.querySelector('.filters')
let tags = document.querySelector('.tagsM');
let add = container.querySelector('button')
let summary = container.querySelectorAll('.summary')
let cancel = form.querySelector('button')
let category = form.querySelector('#category')
let part2 = form.querySelector('.part2')
let part3 = form.querySelector('.part3')
let NewTag = document.querySelector('.NewTag');
let FilTag = filters.querySelectorAll('.tag')

console.log(FilTag)

summary.forEach((element) => element.textContent = element.textContent.substring(0,100) + "...")

for(let c = 0; c < FilTag.length; c++){
    FilTag[c].setAttribute("name",`tag${c + 1}`)
}

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