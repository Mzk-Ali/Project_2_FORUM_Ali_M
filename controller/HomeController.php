<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;

class HomeController extends AbstractController implements ControllerInterface {

    public function index(){
        $topicManager = new TopicManager();
        $topics = $topicManager->findTopicsAndNbrPostForHome();
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum",
            "data" => [
                "topics" => $topics
            ]
        ];
    }
        
    public function users(){
        $this->restrictTo("ROLE_USER");

        $manager = new UserManager();
        $users = $manager->findAll(['register_date', 'DESC']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ 
                "users" => $users 
            ]
        ];
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
        else{
            // Message alert: error interdiction d'acces
            $alert_statut = "error";
            $alert_message = "Impossible d'accéder à ce lien !";
            Session::addFlash($alert_statut, $alert_message);
            $this->redirectTo("forum","index");
        }
        
        return [
            "view" => VIEW_DIR."forum/listUsers.php",
            "meta_description" => "Liste des utilisateurs : ",
            "data" => [
                "users" => $users,
            ]
        ];
    }


    public function modifUser($id) {
        $userManager    = new UserManager();

        if(Session::getUser()->hasRole("admin") || Session::getUser()->hasRole("moderateur"))
        {
            if(isset($_POST['submit']) && ($_POST["user_role"] == "membre" || $_POST["user_role"] == "moderateur"))
            {
                $data_modifRoleUser["role"] = filter_input(INPUT_POST, "user_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
                $userManager->update($id, $data_modifRoleUser);

                // Message alert: succes modification user
                $alert_statut = "success";
                $alert_message = "Le rôle de l'utilisateur a bien été modifié !";
                Session::addFlash($alert_statut, $alert_message);
            }
            elseif(isset($_POST['delete']) && (Session::getUser()->hasRole("admin") || Session::getUser()->hasRole("moderateur"))){
                $user = $userManager->findOneById($id);
                $data_modifUser["mail"]     = password_hash($user->getMail(), PASSWORD_DEFAULT);
                $data_modifUser["pseudo"]   = "unknown".($id*5);
                $data_modifUser["role"]     = "delete";
                $userManager->update($id, $data_modifUser);
                // Message alert: succes suppression user
                $alert_statut = "success";
                $alert_message = "L'utilisateur a bien été banni' !";
                Session::addFlash($alert_statut, $alert_message);
            }
        }
        else{
            // Message alert: error interdiction d'acces
            $alert_statut = "error";
            $alert_message = "Impossible d'accéder à ce lien !";
            Session::addFlash($alert_statut, $alert_message);
            $this->redirectTo("forum","index");
        }

        $this->redirectTo("forum","listUsers");
    }
}
