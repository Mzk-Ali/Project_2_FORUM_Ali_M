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
                            <b><span>STATUT</span></b>
                            <div class="circle_statut_topic <?php if($topic->getLock() == 1){echo "statut_lock";} ?>"></div>
                        </div>
                        <hr>
                        <div class="sujet_topic">
                            <span><b>Titre du topic : </b><?= $topic ?></span><br><br>
                            <p><?= $topic->getLastMsg() ?></p>
                        </div>
                        <hr>
                        <div class="infos_topic">
                            <span><b>Sujet crée par :</b></span>
                            <p><?= $topic->getUser() ?></p>
                            <span><b>Le :</b></span>
                            <p><?= $topic->getCreationDate() ?></p>
                        </div>
                        <hr>
                        <div class="infos_suppl">
                            <span><b>Dernier Message par : </b></span>
                            <p><?= $topic->getUserMsg() ?></p>
                            <span><b>Le :</b></span>
                            <p><?= $topic->getDateLastMsg() ?></p><br>
                            <p><?= $topic->getNbPosts() ?> message(s)</p>
                        </div>
                    </li>
                </a>
            <?php } ?>
        </ul>
    </div>
</div>


<h2>Topics où j'ai posté</h2>


<div class="container_infoPage_and_topic">
    <div class="infoPage">

    </div>
    <div class="topic">
        <ul>
            <?php
            foreach($posts as $post ){ 
                // var_dump($post); die;
                ?>
                <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $post->getTopic()->getId() ?>">
                    <li>
                        <div class="statut_topic">
                            <b><span>STATUT</span></b>
                            <div class="circle_statut_topic <?php if($topic->getLock() == 1){echo "statut_lock";} ?>"></div>
                        </div>
                        <hr>
                        <div class="sujet_topic">
                            <span><b>Titre du topic : </b><?= $post->getTopic() ?></span><br><br>
                            <p><?= $post->getMessage() ?></p>
                        </div>
                        <hr>
                        <div class="infos_topic">
                            <span>Sujet crée par :</span>
                            <p><?= $post->getTopic()->getUser() ?></p>
                            <span>Le :</span>
                            <p><?= $post->getTopic()->getCreationDate() ?></p>
                        </div>
                        <hr>
                        <div class="infos_suppl">
                            <span><b>Date de mon dernier message :</b></span>
                            <p><?= $post->getDateLastMsg() ?></p><br>
                            <p> J'ai écrit <?= $post->getNbPosts() ?> message(s)</p>
                        </div>
                    </li>
                </a>
            <?php } ?>
        </ul>
    </div>
</div>

