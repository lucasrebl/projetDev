let Work = document.querySelector('.work');
let VForm = document.querySelector('.form');
let Form = document.querySelector('.tagsM');
let name = document.querySelector('#name');
let summary = document.querySelector('#summary');
let episodes = document.querySelector('#episodes');
let status = document.querySelector('#status');
let season = document.querySelector('#season');
let category = document.querySelector('#category');
let tag = Form.querySelectorAll('.tag');
let modify = document.querySelector('.modify');
let cancel = document.querySelector('.cancel');
let del = document.querySelectorAll('.delete');
let tagN = document.querySelectorAll('.tagN');
let NewTag = document.querySelector('.NewTag');
let picture = document.querySelector('#picture');
// let buttonI = document.querySelector('#subImage');

let count = 0
let WorkID = window.location.href.split('=')[1];

for(let c = 0; c < tag.length; c++){
    let select = tag[c].querySelector('select');
    select.setAttribute("name",`tag${c + 1}`)
}

modify.addEventListener('click', function() {
    modify.remove();
    Work.style.display = "none"
    VForm.style.display = "block"
    cancel.style.visibility = "visible";
})

cancel.addEventListener('click', function() {
    location.reload()
})

for(let c = 0; c < del.length; c++){
    del[c].addEventListener('click', function() {
        tag[c].remove()
     })
}

NewTag.addEventListener('change', function(){
    if(NewTag.value != 0){
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

picture.addEventListener('change', function(){
    document.querySelector("input[type='submit']").click();
})