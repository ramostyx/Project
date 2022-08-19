let menuToggle = document.querySelector('.toggle');
let sidenav = document.querySelector('.side-nav');
let main = document.querySelector('.main');
let body = document.querySelector('.body');

menuToggle.onclick = function(){
    sidenav.classList.toggle('active');
    main.classList.toggle('translate');
    body.classList.toggle('body-pd');
}

// add active class in selected list item
let list2 = document.querySelectorAll('.second-list');
for (let i = 0; i < list2.length; i++) {
    list2[i].onclick = function() {
        let j = 0;
        while(j < list2.length) {
            list2[j++].className = 'list';
        }
        list2[i].className = 'list active';
    }
}





