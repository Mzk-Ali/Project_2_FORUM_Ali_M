<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics'];  
?>

<h1>Liste des topics de la catégorie : <?=$category?></h1>


<?php
if(App\Session::getUser())
{ ?>
    <form class="form_addTopic" action="index.php?ctrl=forum&action=addTopicInCategory&id=<?= $category->getId() ?>" method="post">
        <div class="container_addTopic">
            <div class="addTopic">
                <div class="titleTopic">
                    <label for="title"><b>Titre du Topic : </b></label>
                    <input name="title" id="title" type="text" placeholder="Insérez le titre">
                </div><br>
                <div class="firstMessage">
                    <label for="message"><b>Premier Message : </b></label>
                    <textarea name="message" id="message" placeholder="Insérez le 1er message"></textarea>
                </div>
            </div>
            <div class="forumulaire_add_button">
                <input class="button_add" type="submit" name="submit" value="Ajouter">
            </div>
        </div>
    </form>
<?php } ?>

<?php if($topics){ ?>
<div class="container_infoPage_and_topic">
    <div class="infoPage">

    </div>
    <div class="topic">
        <ul>
            <?php
            // foreach ($topics as $topic) {
            //     var_dump($topic);
            // } die;

            foreach($topics as $topic ){ 
                // var_dump($topic->getNbPosts()); die;
                ?>
                <a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                    <li>
                        <div class="statut_topic">
                            <b><span>STATUT</span></b>
                            <div class="circle_statut_topic <?php if($topic->getLock() == 1){echo "statut_lock";} ?>"></div>
                        </div>
                        <hr>
                        <div class="sujet_topic">
                            <b><span><?= $topic ?></span></b><br><br>
                            <p><?= $topic->getLastMsg() ?></p>
                        </div>
                        <hr>
                        <div class="infos_topic">
                            <b><span>Sujet crée par :</span></b>
                            <p><?= $topic->getUser() ?></p>
                            <b><span>Le :</span></b>
                            <p><?= $topic->getCreationDate() ?></p>
                        </div>
                        <hr>
                        <div class="infos_suppl">
                            <b><span>Dernier Message par : </span></b>
                            <p><?= $topic->getUserMsg() ?></p>
                            <b><span>Le :</span></b>
                            <p><?= $topic->getDateLastMsg() ?></p><br>
                            <p><?= $topic->getNbPosts() ?> message(s)</p>
                        </div>
                    </li>
                </a>
            <?php } ?>
        </ul>
    </div>
</div>
<?php } 
else{ ?>
    <p class="info_topic_empty">
        Cette catégorie ne contient aucun topic. Soyez le premier à créer un topic dans cette catégorie !!
    </p>
<?php }?>



