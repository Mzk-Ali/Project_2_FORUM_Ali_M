<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Session;
use Model\Managers\UserManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register () {
        $userManager    = new UserManager();
        if(isset($_POST['submit']))
        {
            // Filtrage de la saisie des champs du formulaire
            $mail       = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $pseudo     = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $f_password = filter_input(INPUT_POST, "f_password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $s_password = filter_input(INPUT_POST, "s_password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            // Verifier si la saisie est correcte
            if($pseudo && $mail && $f_password && $s_password)
            {
                $user_mail = $userManager->listUserByMail($mail);

                if($user_mail)
                {
                    // Message alert : mail existant
                    $alert_statut = "error";
                    $alert_message = "L'email saisie existe déjà. Veuillez en choisir un autre !";
                    Session::addFlash($alert_statut, $alert_message);
                    //header register
                    $this->redirectTo("security","register");
                }
                else
                {
                    $user_pseudo = $userManager->listUserByPseudo($pseudo);

                    if($user_pseudo)
                    {
                        // Message alert : pseudo existant
                        $alert_statut = "error";
                        $alert_message = "Le pseudo saisie existe déjà. Veuillez en choisir un autre !";
                        Session::addFlash($alert_statut, $alert_message);
                        // header register
                        $this->redirectTo("security","register");
                    }
                    else
                    {
                        if($f_password == $s_password && strlen($f_password) >= 5)
                        {
                            $data_user["mail"]              = $mail;
                            $data_user["pseudo"]            = $pseudo;
                            $data_user["password"]          = password_hash($f_password, PASSWORD_DEFAULT);
                            // $data_user["dateInscription"]   = $date_create('now')->format('Y-m-d H:i:s');
                            $data_user["role"]              = "membre";
                            $data_user["avatar"]            = "./public/img/avatar_mouton.png";
                            
                            $userManager->add($data_user);

                            // Message alert : inscription validée
                            $alert_statut = "success";
                            $alert_message = "Vous êtes inscrit ! Bienvenue !";
                            Session::addFlash($alert_statut, $alert_message);

                            // header accueil
                            $this->redirectTo("forum","index");
                        }
                        else{
                            // Message alert : mot de passe pas identique ou mauvaise taille
                            $alert_statut = "error";
                            $alert_message = "Les mots de passe saisies ne correspondent pas ou la taille du mot de passe n'est pas correcte !";
                            Session::addFlash($alert_statut, $alert_message);
                            // header register
                            $this->redirectTo("security","register");
                        }
                    }
                }
            }
            else
            {
                // Message alert : saisie incorrecte
                $alert_statut = "error";
                $alert_message = "La saisie n'est pas correcte. Veuillez resaisir les champs !";
                Session::addFlash($alert_statut, $alert_message);
                // header register
                $this->redirectTo("security","register");
            }
        }

        // Session::addFlash($alert_statut, $alert_message);
        // form register
        return [
            "view" => VIEW_DIR."security/register.php",
            "meta_description" => "Inscription : ",
            "data" => []
        ];
    }


    public function login () {
        $userManager    = new UserManager();
        if(!Session::getUser()){
            $alert_statut = "";
            $alert_message = "";
            if(isset($_POST['submit']))
            {
                // Filtrage de la saisie des champs du formulaire
                $mail       = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password   = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
                // Verifier si la saisie est correcte
                if($mail && $password)
                {
                    $user = $userManager->listUserByMail($mail);
                    // Verifie si le mail existe
                    if($user)
                    {
                        $hash = $user->getPassword();
                        // Verifie si le mot de passe est correcte
                        if(password_verify($password, $hash))
                        {
                            Session::setUser($user);

                            // Message alert : connexion validée
                            $alert_statut = "success";
                            $alert_message = "Vous êtes connecté ! Bienvenue !";
                            Session::addFlash($alert_statut, $alert_message);

                            // header home
                            $this->redirectTo("forum","index");
                        }
                        else
                        {
                            // Message alert : email ou mot de passe incorrect
                            $alert_statut = "error";
                            $alert_message = "L'email ou le mot de passe est incorrect !";

                            // header login
                        }
                    }
                    else
                    {
                        // Message alert : email inexistant
                        $alert_statut = "error";
                        $alert_message = "L'email saisie n'existe pas !";
                        //header login
                    }
                }
                else
                {
                    // Message alert : saisie incorrecte
                    $alert_statut = "error";
                    $alert_message = "La saisie n'est pas correcte. Veuillez resaisir les champs !";
                    // header login
                }
            }
            Session::addFlash($alert_statut, $alert_message);
        }
        else{
            // Message alert : acces impossible
            $alert_statut = "warning";
            $alert_message = "Le chemin n'est pas possible";
            Session::addFlash($alert_statut, $alert_message);
            $this->redirectTo("forum","index");
        }

        // form login
        return [
            "view" => VIEW_DIR."security/login.php",
            "meta_description" => "Connexion : ",
            "data" => []
        ];
    }


    public function logout () {
        unset($_SESSION["user"]);
        $alert_statut = "success";
        $alert_message = "Vous êtes déconnecté. A bientôt !!!!";
        Session::addFlash($alert_statut, $alert_message);
        // header home
        $this->redirectTo("forum","index");
    }
}