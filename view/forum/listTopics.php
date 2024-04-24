<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics : <?=$category?></h1>



<form class="form_addTopic" action="index.php?ctrl=forum&action=addTopicInCategory&id=<?= $category->getId() ?>" method="post">
    <div class="container_addTopic">
        <div class="addTopic">
            <div class="titleTopic">
                <label for="title">Titre du Topic : </label>
                <input name="title" id="title" type="text" placeholder="Insérez le titre">
            </div>
            <div class="firstMessage">
                <label for="message">Premier Message : </label>
                <textarea name="message" id="message" placeholder="Insérez le 1er message"></textarea>
            </div>
        </div>
        <div class="forumulaire_add_button">
            <input class="button_add" type="submit" name="submit" value="Ajouter">
        </div>
    </div>
</form>

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



