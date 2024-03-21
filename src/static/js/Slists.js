div_list = document.querySelector('.Solunas_list')
Solunas = document.querySelectorAll('.soluna')
Search = document.querySelectorAll('.input-text')

function JSOName(name, bar) {
    fetch(`/getJSOName?listname=${name}&bar=${bar}`).then((res) => {
        return res.json()
    }).then((data) => {
        div_list.innerHTML = ""
        data.forEach(element => {
            if (element.isPublic == 1) {
                let soluna = `<ul class="soluna">
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
            </ul>`
                div_list.innerHTML += soluna
            }
        });
    })
}

Search[0].addEventListener('input', function () {
    JSOName(Search[0].value, 0)
})

Search[1].addEventListener('input', function () {
    JSOName(Search[1].value, 1)
})