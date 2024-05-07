<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "ASC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }


    public function listTopicsByCategory($id) {

        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsAndNbrPostByCategory($id);

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
            ]
        ];
    }

    public function listPostsByTopic($id) {

        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);

        return [
            "view" => VIEW_DIR."forum/listPosts.php",
            "meta_description" => "Liste des posts par topic : ".$topic,
            "data" => [
                "topic" => $topic,
                "posts" => $posts
            ]
        ];
    }

    // Ajout d'un post dans le topic sélectionné
    public function addPostInTopic($id) {
        $postManager    = new PostManager();
        $topicManager   = new TopicManager();

        if(Session::getUser()){
            if(isset($_POST['submit']) && $_POST["message"] != "") {
                $data["message"]        = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // $data["creationDate"]   = date_create('now')->format('Y-m-d H:i:s');
                $data["user_id"]        = Session::getUser()->getId();
                $data["topic_id"]       = $id;
    
                $postManager->add($data);
                // Message alert: succes d'ajout post
                $alert_statut = "success";
                $alert_message = "Le post a bien été ajouté !";
                Session::addFlash($alert_statut, $alert_message);
            }
        }
        else{
            // Message alert: warning pas connecté
            $alert_statut = "warning";
            $alert_message = "Vous n'êtes pas connecté !";
            Session::addFlash($alert_statut, $alert_message);

            $this->redirectTo("forum","index");
        }

        $this->redirectTo("forum","listPostsByTopic",$id);
    }

    // Ajout d'un topic dans la catégorie sélectionné
    public function addTopicInCategory($id) {
        $topicManager   = new TopicManager();
        $postManager    = new PostManager();

        if(Session::getUser()){
            if(isset($_POST['submit']) && $_POST["title"] != "")
            {
                $dataTopic["title"]          = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // $dataTopic["creationDate"]   = date_create('now')->format('Y-m-d H:i:s');
                $dataTopic["category_id"]    = $id;
                $dataTopic["user_id"]        = Session::getUser()->getId();
                
                $id_topic = $topicManager->add($dataTopic);

                $data_firstMsg["message"]       = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // $data_firstMsg["creationDate"]  = date_create('now')->format('Y-m-d H:i:s');
                $data_firstMsg["user_id"]       = Session::getUser()->getId();
                $data_firstMsg["topic_id"]      = $id_topic;
    
                $postManager->add($data_firstMsg);

                // Message alert: succes d'ajout topic
                $alert_statut = "success";
                $alert_message = "Le topic a bien été ajouté !";
                Session::addFlash($alert_statut, $alert_message);
                
            }
        }
        else{
            // Message alert: warning pas connecté
            $alert_statut = "warning";
            $alert_message = "Vous n'êtes pas connecté !";
            Session::addFlash($alert_statut, $alert_message);

            $this->redirectTo("forum","index");
        }

        $this->redirectTo("forum","listPostsByTopic",$id_topic);
    }


    public function modifTopic($id) {
        $topicManager   = new TopicManager();
        $postManager    = new PostManager();
        $topic = $topicManager->findOneById($id);

        if(Session::getUser() == $topic->getUser() || Session::getUser()->hasRole("admin") || Session::getUser()->hasRole("moderateur")){
            if(isset($_POST['lock'])){
                if($topic->getLock() == 0){
                    $data_modifTopic["lock"] = 1;

                    // Message alert: success topic verrouillé
                    $alert_statut = "success";
                    $alert_message = "Le topic est verrouillé !!!";
                }
                elseif($topic->getLock() == 1 && Session::getUser()->hasRole("admin")){
                    $data_modifTopic["lock"] = 0;

                    // Message alert: success topic verrouillé
                    $alert_statut = "success";
                    $alert_message = "Le topic est déverrouillé !!!";
                }
                // var_dump($id); die;

                $topicManager->update($id, $data_modifTopic);

                Session::addFlash($alert_statut, $alert_message);

                $this->redirectTo("forum","listPostsByTopic", $id);
            }

            if(isset($_POST['delete'])){
                $postManager    = new PostManager();
                $posts = $postManager->findPostsByTopic($id);
                foreach($posts as $post){
                    $postManager->delete($post->getId());
                }
                $topicManager->delete($id);

                // Message alert: success topic supprimé
                $alert_statut = "success";
                $alert_message = "Le topic et ses posts sont supprimés !";
                Session::addFlash($alert_statut, $alert_message);

                $this->redirectTo("forum","listTopicsByCategory", $topic->getCategory());
            }
        }
        $this->redirectTo("forum","index");
    }

    public function modifPost($id) {
        $postManager    = new PostManager();
        $post = $postManager->findOneById($id);
        if(Session::getUser() == $post->getUser() || Session::getUser()->hasRole("admin") || Session::getUser()->hasRole("moderateur")){
            if(isset($_POST['submit']) && $_POST["postModif"] != "")
            {
                $data_modifPost["message"] = filter_input(INPUT_POST, "postModif", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
                $postManager->update($id, $data_modifPost);

                // Message alert: success post modfié
                $alert_statut = "success";
                $alert_message = "Le post a bien été modifié !";
                Session::addFlash($alert_statut, $alert_message);
                
                $this->redirectTo("forum","listPostsByTopic", $post->getTopic());
            }
        }
        else{
            $this->redirectTo("forum","index");
        }
    }


    public function myFollowUp($id){
        $postManager    = new PostManager();
        $topicManager   = new TopicManager();
        $posts  = $postManager->findPostsByUser($id);
        $topics = $topicManager->findTopicsAndNbrPostByUser($id);

        if(Session::getUser()){
            return [
                "view" => VIEW_DIR."forum/myFollowUp.php",
                "meta_description" => "Mes suivis : ",
                "data" => [
                    "topics" => $topics,
                    "posts" => $posts
                ]
            ];
        }
        else{
            // Message alert: error interdiction d'acces
            $alert_statut = "error";
            $alert_message = "Impossible d'accéder à ce lien !";
            Session::addFlash($alert_statut, $alert_message);
            $this->redirectTo("forum","index");
        }
    }
}