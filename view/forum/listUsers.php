<?php
    $users = $result["data"]['users']; 
?>


<h1>Liste des Utilisateurs</h1>


<div class="container_listUsers">
    <ul>
        <li>
            <div class="user_avatar">
                <span>Avatar</span>
            </div>
            <div class="user_mail">
                <span>Email</span>
            </div>
            <div class="user_pseudo">
                <span>Pseudo</span>
            </div>
            <div class="user_dateInscription">
                <span>Date d'Inscription</span>
            </div>
            <div class="user_role">
                <span>Role</span>
            </div>
            <div class="user_valider">
                <span>Validation</span>
            </div>
        </li>
        <?php
        foreach($users as $user ){ ?>
        <li class="user_li">
        <div class="user_avatar">
            <img src="<?= $user->getAvatar() ?>" alt="">
        </div>
        <div class="user_mail">
            <span><?= $user->getMail() ?></span>
        </div>
        <div class="user_pseudo">
            <span><?= $user->getPseudo() ?></span>
        </div>
        <div class="user_dateInscription">
            <span><?= $user->getDateInscription() ?></span>
        </div>
        <div class="user_role">
            <select name="user_role" id="user_role">
                <option value=""><?= $user->getRole() ?></option>
                <option value="membre">Membre</option>
                <option value="moderateur">Moderateur</option>
            </select>
        </div>
        <div class="user_valider">
            <input class="button_userChange" type="submit" name="submit" value="OK">
        </div>
        <?php } ?>
    </ul>
</div>