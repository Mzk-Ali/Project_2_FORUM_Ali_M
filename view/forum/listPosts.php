<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<h1>TOPIC : <?=$topic?></h1>

<?php if((($topic->getUser() == App\Session::getUser() || App\Session::isAdmin() || App\Session::isModerateur()) && $topic->getLock() == 0) || (App\Session::isAdmin() && $topic->getLock() == 1)) { ?>
<form class="container_button" action="index.php?ctrl=forum&action=modifTopic&id=<?= $topic->getId() ?>" method="post">
    <div class="button_lock_topic <?php if($topic->getLock() == 0) { echo "unlock";} else{ echo "lock";}?>">
        <input class="button_lock" type="submit" name="lock" value="Verrouille">
    </div>

    <div class="button_delete_topic">
        <input class="button_delete" type="submit" name="delete" value="Supprimer le topic">
    </div>
</form>
<?php } ?>

<div class="container_postsTopic">
<?php
    foreach($posts as $post ){ ?>
        
        <div class="container_info_user_and_post">
            <div class="infos_user">
                <div class="img_user"><img src="<?= $post->getUser()->getAvatar() ?>" alt=""></div>
                <div class="name_user"><span><?= $post->getUser() ?></span></div>
                <div class="role_user"><span><?= $post->getUser()->getRole() ?></span></div>
            </div>
            <div class="container_post">
                <div class="header_post">
                    <div class="modif_post">
                        <?php if($post->getUser() == App\Session::getUser() || App\Session::isAdmin() || App\Session::isModerateur()) { ?>
                        <p>Modifier Post</p>
                        <?php } ?>
                    </div>
                    <div class="share_post">
                        <a href="#"><p>Partager</p></a>
                    </div>
                </div>
                <div class="main_post">
                    <p><?= $post->getMessage() ?></p>
                </div>
                <?php if($post->getUser() == App\Session::getUser() || App\Session::isAdmin() || App\Session::isModerateur()) { ?>
                <div class="main_post hidden">
                    <form action="index.php?ctrl=forum&action=modifPost&id=<?= $post->getId() ?>" method="post">
                        <textarea name="postModif" id="postModif" cols="30" rows="5"><?= $post->getMessage() ?></textarea>
                        <input class="button_modfiPost" type="submit" name="submit" value="Modifier Post">
                    </form>
                </div>
                <?php } ?>
                <div class="footer_post">
                    <div class="date_post">
                        <span>Posté le : </span>
                        <span><?= $post->getCreationDate() ?></span>
                    </div>
                    <div class="like_post">
                        <span>22 likes</span>
                    </div>
                    <div class="answer_post">
                        <?php
                        if(App\Session::getUser() && $topic->getLock() == 0)
                        { ?>
                        <a href="#form-answer"><span>Répondre</span></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php
if(App\Session::getUser() && $topic->getLock() == 0)
{ ?>
<form id="form-answer" action="index.php?ctrl=forum&action=addPostInTopic&id=<?= $topic->getId() ?>" method="post">
    <div class="container_answer">
        <div class="info_answer">
            <p>Rejoignez le sujet en répondant au message</p>
            <p>Veillez à respecter les règles de bonnes conduites</p>
        </div>
        <div class="main_answer">
            <div class="myprofil"><img src="<?= App\Session::getUser()->getAvatar() ?>" alt=""></div>
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Répondre à ce sujet ..."></textarea>
        </div>
        <div class="button_answer">
            <input class="button_add" type="submit" name="submit" value="Répondre">
        </div>
    </div>
</form>
<?php } ?>


