<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Connexion au FORUM</h1>



<form class="form_login" action="index.php?ctrl=security&action=login" method="post">
    <div class="login_mail">
        <label for="mail">Email</label>
        <input type="url" name="mail" id="mail">
    </div>
    <div class="login_password">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
    </div>
    <div class="login">
        <input class="button_login" type="submit" name="submit" value="SE CONNECTER">
    </div>
    <div class="redirection_signIn">
        <a href="#">Tu n'as pas de compte ?</a>
    </div>
</form>