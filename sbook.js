var i = 0;

document.querySelector('.read-more-desc').addEventListener('click', ()=>{
    document.querySelector('.desc-content').classList.remove('overflow');
    document.querySelector('.blur').style.display = 'none';
    document.querySelector('.read-more-desc').style.display = 'none';
})

document.querySelector('.read-more-author-content').addEventListener('click', ()=>{
    document.querySelector('.author-content').classList.remove('overflow');
    document.querySelector('.blur-author-content').style.display = 'none';
    document.querySelector('.read-more-author-content').style.display = 'none';
})

document.querySelectorAll('.read-more-review').forEach((btn)=>{
    btn.addEventListener('click', (e)=>{
        e.currentTarget.previousElementSibling.classList.remove('overflow');
        e.currentTarget.style.display = 'none';
        e.currentTarget.previousElementSibling.firstElementChild.style.display = 'none';
    })
})

window.addEventListener("DOMContentLoaded", () => {
    //console.log(document.querySelector('.desc-content').offsetHeight);

    if(document.querySelector('.desc-content').offsetHeight > 150){
        document.querySelector('.desc-content').classList.add('overflow');
    document.querySelector('.blur').classList.remove('hide');
    document.querySelector('.read-more-desc').classList.remove('hide');
    }

    if(document.querySelector('.author-content').offsetHeight > 150){
        document.querySelector('.author-content').classList.add('overflow');
    document.querySelector('.blur-author-content').classList.remove('hide');
    document.querySelector('.read-more-author-content').classList.remove('hide');
    }
    

   document.querySelectorAll('.review-p').forEach((reviewP)=>{
    console.log(reviewP.offsetHeight);
    if(reviewP.offsetHeight < 150){
        document.querySelectorAll('.read-more-review')[i].classList.add('hide');
    }
    ++i;
    });
  });

