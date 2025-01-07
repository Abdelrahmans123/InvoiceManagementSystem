setInterval(function() {
    $("#notifications_count").load(window.location.href + " #notifications_count");
    $("#unreadNotifications").load(window.location.href + " #unreadNotifications");
}, 5000);

let bell=document.querySelector('.bell_icon');
bell.addEventListener('click',show);
function show(){
    let notification=document.querySelector('.notification');
    notification.classList.toggle('show');
}
