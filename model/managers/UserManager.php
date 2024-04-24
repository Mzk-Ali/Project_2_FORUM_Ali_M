<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }


    // récupérer l'utilisateur avec l'email
    public function listUserByMail($mail) {

        $sql = "SELECT * 
                FROM ".$this->tableName." u 
                WHERE u.mail = :mail";
        
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['mail' => $mail]), 
            $this->className
        );
    }

    // récupérer l'utilisateur avec l'email
    public function listUserByPseudo($pseudo) {

        $sql = "SELECT * 
                FROM ".$this->tableName." u 
                WHERE u.pseudo = :pseudo";
        
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo]), 
            $this->className
        );
    }
}