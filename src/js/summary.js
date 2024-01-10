let Work = document.querySelector('.work');
let name = document.querySelector('#name');
let summary = document.querySelector('#summary');
let episodes = document.querySelector('#episodes');
let status = document.querySelector('#status');
let season = document.querySelector('#season');
let category = document.querySelector('#category');
let tag = document.querySelectorAll('.tag');
let modify = document.querySelector('.modify');
let cancel = document.querySelector('.cancel');
let del = document.querySelectorAll('.delete');
let tagN = document.querySelectorAll('.tagN');

let count = 0
let WorkID = window.location.href.split('=')[1];

console.log(tag[0])

modify.addEventListener('click', function() {
    modify.remove();
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
