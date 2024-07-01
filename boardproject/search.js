const search = document.querySelector('#search')
const search_btn = document.querySelector('#search_btn')
search_btn.addEventListener("click", ()=>{
    let wh = "<?php $wh ?>"
    wh = search.value
})