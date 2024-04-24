<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

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
                    // email existe dejà
                    //header register
                }
                else
                {
                    $user_pseudo = $userManager->listUserByPseudo($pseudo);

                    if($user_pseudo)
                    {
                        // pseudo existe déjà
                        // header register
                    }
                    else
                    {
                        if($f_password == $s_password && strlen($f_password) >= 5)
                        {
                            $data_user["mail"]              = $mail;
                            $data_user["pseudo"]            = $pseudo;
                            $data_user["password"]          = password_hash($f_password, PASSWORD_DEFAULT);
                            $data_user["dateInscription"]   = $date_create('now')->format('Y-m-d H:i:s');
                            $data_user["role"]              = "membre";
                            $data_user["avatar"]            = "./public/img/avatar_mouton.png";
                            
                            $userManager->add($data_user);

                            // header accueil
                        }
                        else{
                            // mot de passe pas identique ou mauvaise taille
                            // header register
                        }
                    }
                }
            }
            else
            {
                // problème de saisies
                // header register
            }
        }
    }


    public function login () {
        $userManager    = new UserManager();
        if(isset($_POST['submit']))
        {
            // Filtrage de la saisie des champs du formulaire
            $mail       = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password   = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            // Verifier si la saisie est correcte
            if($mail && $password)
            {
                $user = $userManager->listUserByMail($mail);
                // verifie si le mail existe
                if($user_mail)
                {
                    $hash = $user["password"];
                    // Verifie si le mot de passe est correcte
                    if(password_verify($password, $hash))
                    {
                        // $_SESSION["user"] = $user;
                        App\Session::setUser($user)
                        // header home
                    }
                    else
                    {
                        // email ou mot de passe incorrect
                        // header login
                    }
                }
                else
                {
                    // email existe pas
                    //header login
                }
            }
            else
            {
                // problème de saisies
                // header login
            }
        }
    }


    public function logout () {
        unset($_SESSION["user"]);
        // header home
    }
}