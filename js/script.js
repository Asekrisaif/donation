Array.from(document.getElementsByTagName('input')).forEach((e,i)=>{
    e.addEventListener('keyup',(e1)=>{
        if(e.value.length > 0){
            document.getElementsByClassName('bi-caret-down-fill')[i].style.transform="rotate(180deg)";
        }
        else
        {
            document.getElementsByClassName('bi-caret-down-fill')[i].style.transform="rotate(0deg)";
        }
    })
})


const header = document.querySelector('.header');
window.addEventListener("scroll", function()

{
    header.classList.toggle("sticky",window.scrollY > 0);
});