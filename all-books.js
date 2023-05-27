const searchInput = document.querySelector('.search-bar');
const cards = document.querySelectorAll('.card');

searchInput.addEventListener('input', (e)=>{
    document.querySelector('.cards-container-hider').classList.remove('hide');
    document.querySelector('.row-genre-hider').classList.add('hide');
    document.querySelector('.headers-search-input').classList.add('hide');
    document.querySelector('.pagination').classList.add('hide');
    const searchValue = e.target.value.toUpperCase();
    if(!searchValue){
        document.querySelector('.cards-container-hider').classList.add('hide');
    document.querySelector('.row-genre-hider').classList.remove('hide');
    document.querySelector('.pagination').classList.remove('hide');
    }
    for(var i = 0; i < cards.length; i++){
        const matchTitle = cards[i].getElementsByClassName('title')[0].innerText;
        const matchAuthor = cards[i].getElementsByClassName('author')[0].innerText;
        if(matchTitle.toUpperCase().startsWith(searchValue) || matchAuthor.toUpperCase().startsWith(searchValue)){
            cards[i].style.display = '';
        } else{
            cards[i].style.display = 'none';
    }
  }  
});

window.addEventListener("DOMContentLoaded", () => {
    var limit = 8;
    var offset = 0;
    for(var i = 0; i < 3; i++){
    const btn = document.createElement("li");
    btn.classList.add('page-item');
    btn.classList.add('page');
    btn.innerHTML = `<span class="page-link" data-id="${i}" data-offset="${offset}">${i+1}</span>`;
    document.querySelector('.pagination').appendChild(btn);
    offset += 8;
    }
    document.querySelectorAll('.page')[0].classList.add('active');
    document.querySelectorAll('.page').forEach((page)=>{
        page.addEventListener('click', ()=>{
            var id = page.firstChild.dataset.id;
            for(var i = 0; i < 3; i++){
                document.querySelectorAll('.page')[i].classList.remove('active');  
            }
            document.querySelectorAll('.page')[id].classList.add('active');
            let offset = page.firstChild.dataset.offset;
            var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   document.querySelector(".row-genre").innerHTML = this.responseText;
                }
              };
                xhttp.open("GET", `all-books-ajax.php?limit=${limit}&offset=${offset}`, true);
                xhttp.send();
        });
    });
  });



/*document.querySelector('.page-2').addEventListener('click', ()=>{
    const limit = 8;
        const offset = 8;
    var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           document.querySelector(".row-genre").innerHTML = this.responseText;
        }
      };
        xhttp.open("GET", `all-books-ajax.php?limit=${limit}&offset=${offset}`, true);
        xhttp.send();
});*/