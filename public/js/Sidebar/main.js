let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;
 arrowParent.classList.toggle("showMenu");
  });
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".fa-bars");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});


const currloc = location.href;
console.log(currloc.substring(25));
        const menuItem = document.querySelectorAll('.link');
        const menuLen = menuItem.length;
        for (let i = 0; i < menuLen; i++) {
            menuItem[i].classList.remove('active');
            if (menuItem[i].href.substring(22) === currloc.substring(25)) {
                menuItem[i].classList.add("active");
            }
            console.log(menuItem[i].classList.contains('active'));
            if(menuItem[i].classList.contains('active')){
                sidebar.classList.remove('close');
            }
            let show=document.querySelectorAll('.sub-menu li a');
            for(let i=0;i<show.length;i++){
                if(show[i].classList.contains('active')){

                    console.log(show[i].parentElement.parentElement.parentElement);
                    show[i].parentElement.parentElement.parentElement.classList.add('showMenu');
                }
            }
        }

