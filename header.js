document.querySelector('.signupin').addEventListener('click', ()=>{
    document.querySelector('.overlay').classList.remove('hide');
});

document.querySelector('.overlay').addEventListener('click', (e)=>{
    var closeByClickingOverlay = e.target.className;
    if(closeByClickingOverlay === 'overlay'){
        document.querySelector('.overlay').classList.add('hide');
    }
})




     