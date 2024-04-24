<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]['posts']; 
?>

<h1>Liste des posts : <?=$topic?></h1>



<div class="container_postsTopic">
<?php
    foreach($posts as $post ){ ?>
        <div class="container_info_user_and_post">
            <div class="infos_user">
                <div class="img_user"><img src="./public/img/avatar_mouton.png" alt=""></div>
                <div class="name_user"><span><?= $post->getUser() ?></span></div>
                <div class="role_user"><span>Modérateur</span></div>
            </div>
            <div class="container_post">
                <div class="header_post">
                    <div class="modif_post">
                        <a href="#"><p>Modifier Post</p></a>
                    </div>
                    <div class="share_post">
                        <a href="#"><p>Partager</p></a>
                    </div>
                </div>
                <div class="main_post">
                    <p><?= $post->getMessage() ?></p>
                </div>
                <div class="footer_post">
                    <div class="date_post">
                        <span>Posté le : </span>
                        <span><?= $post->getCreationDate() ?></span>
                    </div>
                    <div class="like_post">
                        <span>22 likes</span>
                    </div>
                    <div class="answer_post">
                        <a href="#"><span>Répondre</span></a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php
if(App\Session::getUser())
{ ?>
<form action="index.php?ctrl=forum&action=addPostInTopic&id=<?= $topic->getId() ?>" method="post">
    <div class="container_answer">
        <div class="info_answer">
            <p>Rejoignez le sujet en répondant au message</p>
            <p>Veillez à respecter les règles de bonnes conduites</p>
        </div>
        <div class="main_answer">
            <div class="myprofil"><img src="" alt=""></div>
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Répondre à ce sujet ..."></textarea>
        </div>
        <div class="button_answer">
            <input class="button_add" type="submit" name="submit" value="Répondre">
        </div>
    </div>
</form>
<?php } ?>


