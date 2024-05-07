<?php
    $topics = $result["data"]['topics'];  
?>


<h1>BIENVENUE SUR LE FORUM</h1>

<?php if($topics){ ?>
<div class="container_infoPage_and_topic">
    <div class="infoPage">
        <div class="preceding_page">
            <i class="ri-arrow-left-line"></i>
            <span>Page précedente</span>
        </div>
        <div class="main_infoPage">
            <div class="numPage">
                <div class="contain_num select">1</div>
                <div class="contain_num">2</div>
                <div class="contain_num">3</div>
                <div class="contain_num">4</div>
            </div>
            <div class="sizePage">
                <div class="numSizePage">
                    <div class="contain_num select">4</div>
                    <div class="contain_num">8</div>
                    <div class="contain_num">12</div>
                </div>
                <span> per Page</span>
            </div>
        </div>
        <div class="next_page">
            <span>Page suivante</span>
            <i class="ri-arrow-right-line"></i>
        </div>
    </div>
    <div class="topic">
        <ul>
            <?php
            foreach($topics as $topic ){ 
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
        Cette catégorie ne contient aucun topic. Soyez le premier à créer un topic dans un des catégories !!
    </p>
<?php }?>