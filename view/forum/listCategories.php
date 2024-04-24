<?php
    $categories = $result["data"]['categories']; 
?>

<h1>Catégorie</h1>


<div class="container_card">
<?php
foreach($categories as $category ){ ?>
    <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
        <div class="card">
            <div class="img_category">
                <img src="https://img.freepik.com/premium-photo/cyberpunk-gaming-controller-gamepad-joystick-illustration_691560-5812.jpg" alt="">
            </div>
            <div class="nom_category">
                <span><?= $category->getName() ?></span>
            </div>
        </div>
    </a>
<?php } ?>
</div>


  
