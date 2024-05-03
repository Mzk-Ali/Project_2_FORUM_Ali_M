// bouton navbar

button_logo_nav = document.querySelector(".nav_profil");
container_logo_nav = document.querySelector(".menu_profil");
button_logo_nav.addEventListener("click", function(){
    container_logo_nav.classList.toggle("hidden");
})


// bouton modification post
container_post = document.querySelectorAll(".container_post");
button_modif_post = document.querySelectorAll(".modif_post");
for(let i = 0; i< container_post.length; i++){
    button_modif_post[i].addEventListener("click", function() {
        div_post = container_post[i].querySelectorAll(".main_post")
        for(let i = 0; i< div_post.length; i++){
            div_post[i].classList.toggle('hidden');
        }
    })
}



// alerte message
alert_btn_click = document.querySelector(".close_btn_alert")
alert_container_click = document.querySelector(".container_alert")

alert_btn_click.addEventListener("click", function(){
    alert_container_click.classList.remove("show");
    alert_container_click.classList.add("hide");
});


$(".message_alert").each(function(){
    
    if ($(this).text().length > 1){
        alert_container_click.classList.remove("none");
        alert_container_click.classList.add("show");
        setTimeout(function() {
            alert_container_click.classList.remove("show");
            alert_container_click.classList.add("hide");
        }, 3000)
    }
})
