
<h1>Paramètre de modification</h1>



<form class="form_register" action="index.php?ctrl=security&action=modifUser" method="post">
    <div class="register_mail">
        <label for="mail">Email</label>
        <input type="email" name="mail" id="mail">
    </div>
    <div class="register_old_password">
        <label for="old_password">Ancien Mot de passe</label>
        <input type="password" name="old_password" id="f_password">
    </div>
    <div class="register_f_password">
        <label for="new_f_password">Nouveau Mot de passe</label>
        <input type="password" name="new_f_password" id="new_f_password">
    </div>
    <div class="register_s_password">
        <label for="new_s_password">Confirmation du nouveau Mot de passe</label>
        <input type="password" name="new_s_password" id="new_s_password">
    </div>
    <div class="modif">
        <input class="button_modif" type="submit" name="submit" value="Modifier Mot de passe">
    </div>
    <div class="delete">
        <input class="button_delete" type="submit" name="delete" value="Supprimer votre Compte">
    </div>
</form>