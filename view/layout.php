<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" integrity="sha512-OQDNdI5rpnZ0BRhhJc+btbbtnxaj+LdQFeh0V9/igiEPDiWE2fG+ZsXl0JEH+bjXKPJ3zcXqNyP4/F/NegVdZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
        <title>FORUM</title>
    </head>
    <body>
        <div id="wrapper"> 
            <div id="mainpage">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <?php if(isset($_SESSION["success"]) || isset($_SESSION["warning"]) || isset($_SESSION["error"])) { ?>
                <div class="container_alert <?php 
                    if(isset($_SESSION["success"])){echo "alert_validate";}
                    elseif(isset($_SESSION["warning"])){echo "alert_warning";}
                    elseif(isset($_SESSION["error"])){echo "alert_error";}
                    else{echo "";}
                    ?> none">
                    <span class="logo_alert">
                        <i class="ri-error-warning-fill"></i>
                    </span>
                    <span class="message_alert">
                        <?= App\Session::getFlash("success"); ?>
                        <?= App\Session::getFlash("warning"); ?>
                        <?= App\Session::getFlash("error"); ?>
                    </span>
                    <div class="close_btn_alert">
                        <span class="close_btn">
                            <i class="ri-close-circle-fill"></i>
                        </span>
                    </div>
                </div>
                <?php  } ?>

                <header>
                    <nav>
                        <div class="nav_left">
                            <div class="nav_home">
                                <a href="index.php?ctrl=home&action=index">HOME</a>
                            </div>
                            <div class="nav_search">
                                <input type="text" name="search" id="search" placeholder=" Rechercher">
                            </div>
                        </div>
                        <div class="nav_right">
                            <div class="nav_categorie">
                                <a href="index.php?ctrl=forum&action=index">Categorie</a>
                            </div>
                        <?php
                            // si l'utilisateur est connecté 
                            if(App\Session::getUser()){
                                ?>
                                <div class="nav_mesSujets">
                                    <a href="index.php?ctrl=forum&action=myFollowUp&id=<?= App\Session::getUser()->getId() ?>">MesSujets</a>
                                </div>
                                <div class="nav_profil">
                                    <img src="<?= App\Session::getUser()->getAvatar() ?>" alt="">
                                </div>
                                <div class="menu_profil hidden">
                                    <div class="pseudo_user">
                                        <span>Bienvenue <?= App\Session::getUser() ?></span>
                                    </div>
                                    <div class="logout">
                                        <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                                    </div>
                                </div>
                                <?php
                            }
                            else{
                                ?>
                                <div class="nav_profil">
                                    <img src="./public/img/img_user.png" alt="">
                                </div>
                                <div class="menu_profil hidden">
                                    <div class="login">
                                        <a href="index.php?ctrl=security&action=login">Connexion</a>
                                    </div>
                                    <div class="signIn">
                                        <a href="index.php?ctrl=security&action=register">Inscription</a>
                                    </div>
                                </div>
                            <?php
                            }
                        ?>
                        </div>
                    </nav>
                </header>
                
                <main id="forum">
                    <?php
                    if(App\Session::isAdmin() || App\Session::isModerateur()){ ?>
                        <a href="index.php?ctrl=forum&action=listUsers">
                            <div class="listUsers">
                                <img src="./public/img/listUsers.png" alt="">
                            </div>
                        </a>
                    <?php } ?>
                    <?= $page ?>
                </main>
            </div>
            <footer>
                <p>&copy; <?= date_create("now")->format("Y") ?> - <a href="#">Règlement du forum</a> - <a href="#">Mentions légales</a></p>
            </footer>
        </div>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </body>
</html>