// INFO Utilisateur
let userInfo = document.querySelector('.userinfo');
let formUser = document.querySelector('.formUser');
let mUser = userInfo.querySelector('.modify');
let picture = formUser.querySelector('#picture')
let cancel = formUser.querySelector('.cancel')
let listeDiv = document.querySelector('.listes')
let toggleButton = listeDiv.querySelector("#toggleButton");
let toggleButton2 = userInfo.querySelector("#toggleButton");
let myForm = listeDiv.querySelector("#myForm");
mUser.addEventListener('click', function () {
    userInfo.style.display = "none"
    formUser.style.display = "block"
})
cancel.addEventListener('click', function () {
    userInfo.style.display = "block"
    formUser.style.display = "none"
})
picture.addEventListener('change', function(){
    formUser.querySelector("input[type='submit']").click();
})
toggleButton.addEventListener("click", function () {
    myForm.classList.toggle("Form_hidden");
    myForm.classList.toggle("Form_visible");
    if (myForm.classList.value == "Form_visible") {
        myForm.style.maxHeight = "100px"
    } else {
        myForm.style.maxHeight = "0px"
    }
});
toggleButton2.addEventListener("click", function () {
    picture.click();
});