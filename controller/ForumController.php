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

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);

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

        if(isset($_POST['submit']) && $_POST["message"] != "") {
            $data["message"]        = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $data["creationDate"]   = date_create('now')->format('Y-m-d H:i:s');
            $data["user_id"]        = 3;
            $data["topic_id"]       = $id;

            $postManager->add($data);
        }
        $this->redirectTo("forum","listPostsByTopic",$id);
    }

    // Ajout d'un topic dans la catégorie sélectionné
    public function addTopicInCategory($id) {
        $topicManager   = new TopicManager();
        $postManager    = new PostManager();

        if(isset($_POST['submit']) && $_POST["title"] != "")
        {
            $dataTopic["title"]          = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $dataTopic["creationDate"]   = date_create('now')->format('Y-m-d H:i:s');
            $dataTopic["category_id"]    = $id;
            $dataTopic["user_id"]        = 3;

            $id_topic = $topicManager->add($dataTopic);

            $data_firstMsg["message"]       = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $data_firstMsg["creationDate"]  = date_create('now')->format('Y-m-d H:i:s');
            $data_firstMsg["user_id"]       = 3;
            $data_firstMsg["topic_id"]      = $id_topic;

            $postManager->add($data_firstMsg);

        }
        $this->redirectTo("forum","listPostsByTopic",$id_topic);
    }


    public function listUsers() {

        $userManager    = new UserManager();
        if(Session::getUser() && Session::getUser()->hasRole("admin"))
        {
            $users = $userManager->listUsersForAdmin();
            // var_dump($users); die;
        }
        elseif(Session::getUser() && Session::getUser()->hasRole("moderateur"))
        {
            $users = $userManager->listUsersForModerateur();
        }
        
        return [
            "view" => VIEW_DIR."forum/listUsers.php",
            "meta_description" => "Liste des utilisateurs : ",
            "data" => [
                "users" => $users,
            ]
        ];
    }


    public function myFollowUp($id){
        $postManager    = new PostManager();
        $topicManager   = new TopicManager();
        $posts  = $postManager->findPostsByUser($id);
        $topics = $topicManager->findTopicsByUser($id);


        return [
            "view" => VIEW_DIR."forum/myFollowUp.php",
            "meta_description" => "Mes suivis : ",
            "data" => [
                "topics" => $topics,
                "posts" => $posts
            ]
        ];
    }
}