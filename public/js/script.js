// bouton navbar

button_logo_nav = document.querySelector(".nav_profil");
container_logo_nav = document.querySelector(".menu_profil")
button_logo_nav.addEventListener("click", function(){
    container_logo_nav.classList.toggle("hidden");
})