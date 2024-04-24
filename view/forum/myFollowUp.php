<?php
    $topics = $result["data"]['topics']; 
    $posts = $result["data"]['posts']; 
?>

<h1>Mes Suivis</h1>

<h2>Mes topics</h2>

<div class="container_infoPage_and_topic">
    <div class="infoPage">

    </div>
    <div class="topic">
        <ul>
            <?php
            foreach($topics as $topic ){ ?>
                <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                    <li>
                        <div class="statut_topic">
                            <span>STATUT</span>
                        </div>
                        <div class="sujet_topic">
                            <span><?= $topic ?></span>
                            <p>Debut du message le plus like</p>
                        </div>
                        <div class="infos_topic">
                            <span>Sujet crée par :</span>
                            <p><?= $topic->getUser() ?></p>
                            <span>Le :</span>
                            <p><?= $topic->getCreationDate() ?></p>
                        </div>
                        <div class="infos_suppl">
                            <span>Dernier Message par : </span>
                            <p></p>
                            <span>Le :</span>
                            <p></p>
                            <p>Nbr de message</p>
                        </div>
                    </li>
                </a>
            <?php } ?>
        </ul>
    </div>
</div>


<h2>Topics où j'ai posté</h2>

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

