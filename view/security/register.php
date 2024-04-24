
<h1>Inscription au FORUM</h1>



<form class="form_register" action="index.php?ctrl=security&action=register" method="post">
    <div class="register_mail">
        <label for="mail">Email</label>
        <input type="email" name="mail" id="mail">
    </div>
    <div class="register_pseudo">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo">
    </div>
    <div class="register_f_password">
        <label for="f_password">Mot de passe</label>
        <input type="password" name="f_password" id="f_password">
    </div>
    <div class="register_s_password">
        <label for="s_password">Mot de passe</label>
        <input type="password" name="s_password" id="s_password">
    </div>
    <div class="sign_in">
        <input class="button_signIn" type="submit" name="submit" value="S'INSCRIRE">
    </div>
    <div class="redirection_login">
        <a href="index.php?ctrl=security&action=login">As-tu déjà un compte ?</a>
    </div>
</form>