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

modify.addEventListener('click', function() {
    modify.remove();
    cancel.style.visibility = "visible";
})

cancel.addEventListener('click', function() {
    location.reload()
})

del.forEach((element) => 
element.addEventListener('click', function() {
    location.reload()
})
);

